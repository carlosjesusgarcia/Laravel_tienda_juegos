<?php

/**
 * Archivo: CompraController.php
 * Función: Confirma y registra las compras realizadas por los usuarios autenticados.
 */

namespace App\Http\Controllers;

use App\Mail\JuegoComprado;
use App\Models\Compra;
use App\Models\CompraTieneJuego;
use App\Models\Juego;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CompraController extends Controller
{
    /**
     * Muestra la pantalla de confirmación antes de registrar la compra.
     */
    public function confirmar(Request $request)
    {
        $carrito = $request->session()->get('carrito', []);

        if(empty($carrito)) {
            return redirect()
                ->route('carrito.index')
                ->with(
                    'feedback.message',
                    'El carrito está vacío.'
                );
        }

        $juegos = Juego::whereIn(
            'juego_id',
            array_keys($carrito)
        )
            ->orderBy('titulo')
            ->get();

        $productosCarrito = [];
        $total = 0;

        foreach($juegos as $juego) {
            $cantidad = (int) $carrito[$juego->juego_id];

            if($cantidad < 1) {
                $cantidad = 1;
            }

            $subtotal = $juego->precio * $cantidad;

            $productosCarrito[] = [
                'juego' => $juego,
                'cantidad' => $cantidad,
                'subtotal' => $subtotal,
            ];

            $total += $subtotal;
        }

        if(empty($productosCarrito)) {
            $request->session()->forget('carrito');

            return redirect()
                ->route('carrito.index')
                ->with(
                    'feedback.message',
                    'Los juegos del carrito ya no están disponibles.'
                );
        }

        return view('compras.confirmar', [
            'productosCarrito' => $productosCarrito,
            'total' => $total,
        ]);
    }

    /**
     * Registra la compra y sus juegos en la base de datos.
     */
    public function guardar(Request $request)
    {
        $carrito = $request->session()->get('carrito', []);

        if(empty($carrito)) {
            return redirect()
                ->route('carrito.index')
                ->with(
                    'feedback.message',
                    'El carrito está vacío.'
                );
        }

        /*
         * Los juegos y sus precios se consultan nuevamente
         * desde la base de datos antes de registrar la compra.
         */
        $juegos = Juego::whereIn(
            'juego_id',
            array_keys($carrito)
        )
            ->orderBy('titulo')
            ->get();

        if($juegos->isEmpty()) {
            $request->session()->forget('carrito');

            return redirect()
                ->route('carrito.index')
                ->with(
                    'feedback.message',
                    'Los juegos del carrito ya no están disponibles.'
                );
        }

        $compra = DB::transaction(function () use ($carrito, $juegos) {
            $total = 0;

            foreach($juegos as $juego) {
                $cantidad = (int) $carrito[$juego->juego_id];

                if($cantidad < 1) {
                    $cantidad = 1;
                }

                $total += $juego->precio * $cantidad;
            }

            $compra = Compra::create([
                'user_fk' => Auth::id(),
                'fecha_compra' => date('Y-m-d'),
                'total' => $total,
                'estado' => 'pendiente',
            ]);

            foreach($juegos as $juego) {
                $cantidad = (int) $carrito[$juego->juego_id];

                if($cantidad < 1) {
                    $cantidad = 1;
                }

                CompraTieneJuego::create([
                    'compra_fk' => $compra->compra_id,
                    'juego_fk' => $juego->juego_id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $juego->precio,
                    'descripcion' => $juego->titulo,
                ]);
            }

            return $compra;
        });

        /*
         * El carrito se vacía únicamente después de que la compra
         * y todos sus detalles fueron registrados correctamente.
         */
        $request->session()->forget('carrito');

        $compra->load([
            'usuario',
            'detalles.juego',
        ]);

        Mail::to($compra->usuario->email)
            ->send(new JuegoComprado($compra));

        return redirect()
            ->route('compras.detalles', $compra->compra_id)
            ->with(
                'feedback.message',
                'La compra se registró correctamente y se envió el comprobante por correo electrónico.'
            );
    }

    /**
     * Muestra el historial de compras del usuario autenticado.
     */
    public function index()
    {
        $compras = Compra::with([
            'detalles.juego',
        ])
            ->where('user_fk', Auth::id())
            ->orderByDesc('fecha_compra')
            ->orderByDesc('compra_id')
            ->get();

        return view('compras.index', [
            'compras' => $compras,
        ]);
    }

    /**
     * Muestra el detalle de una compra del usuario autenticado.
     */
    public function detalles(int $id)
    {
        $compra = Compra::with([
            'usuario',
            'detalles.juego',
        ])
            ->where('compra_id', $id)
            ->where('user_fk', Auth::id())
            ->firstOrFail();

        return view('compras.detalles', [
            'compra' => $compra,
        ]);
    }
}