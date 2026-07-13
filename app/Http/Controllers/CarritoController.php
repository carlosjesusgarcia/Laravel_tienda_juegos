<?php

/**
 * Archivo: CarritoController.php
 * Función: Administra el carrito de compras almacenado en la sesión.
 */

namespace App\Http\Controllers;

use App\Models\Juego;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    /**
     * Muestra los juegos almacenados en el carrito.
     */
    public function index(Request $request)
    {
        $carrito = $request->session()->get('carrito', []);

        if(empty($carrito)) {
            return view('carrito.index', [
                'productosCarrito' => [],
                'total' => 0,
            ]);
        }

        $juegos = Juego::whereIn(
            'juego_id',
            array_keys($carrito)
        )
            ->orderBy('titulo')
            ->get();

        /*
         * Elimina de la sesión posibles juegos que ya no existan
         * en la base de datos.
         */
        $identificadoresExistentes = $juegos
            ->pluck('juego_id')
            ->all();

        $carrito = array_intersect_key(
            $carrito,
            array_flip($identificadoresExistentes)
        );

        $request->session()->put('carrito', $carrito);

        $productosCarrito = [];
        $total = 0;

        foreach($juegos as $juego) {
            $cantidad = (int) $carrito[$juego->juego_id];
            $subtotal = $juego->precio * $cantidad;

            $productosCarrito[] = [
                'juego' => $juego,
                'cantidad' => $cantidad,
                'subtotal' => $subtotal,
            ];

            $total += $subtotal;
        }

        return view('carrito.index', [
            'productosCarrito' => $productosCarrito,
            'total' => $total,
        ]);
    }

    /**
     * Agrega una unidad de un juego al carrito.
     */
    public function agregar(Request $request, string $id)
    {
        $juego = Juego::where('slug', $id)
            ->firstOrFail();

        $carrito = $request->session()->get('carrito', []);

        if(isset($carrito[$juego->juego_id])) {
            $carrito[$juego->juego_id]++;
        } else {
            $carrito[$juego->juego_id] = 1;
        }

        $request->session()->put('carrito', $carrito);

        return redirect()
            ->route('carrito.index')
            ->with(
                'feedback.message',
                'El juego <b>' . e($juego->titulo) . '</b> se agregó al carrito.'
            );
    }

    /**
     * Actualiza la cantidad de un juego almacenado en el carrito.
     */
    public function actualizar(Request $request, string $id)
    {
        $juego = Juego::where('slug', $id)
            ->firstOrFail();

        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $carrito = $request->session()->get('carrito', []);

        if(!isset($carrito[$juego->juego_id])) {
            return redirect()
                ->route('carrito.index')
                ->with(
                    'feedback.message',
                    'El juego seleccionado no se encuentra en el carrito.'
                );
        }

        $carrito[$juego->juego_id] = (int) $request->input('cantidad');

        $request->session()->put('carrito', $carrito);

        return redirect()
            ->route('carrito.index')
            ->with(
                'feedback.message',
                'La cantidad de <b>' . e($juego->titulo) . '</b> se actualizó correctamente.'
            );
    }

    /**
     * Elimina un juego del carrito.
     */
    public function eliminar(Request $request, string $id)
    {
        $juego = Juego::where('slug', $id)
            ->firstOrFail();

        $carrito = $request->session()->get('carrito', []);

        if(isset($carrito[$juego->juego_id])) {
            unset($carrito[$juego->juego_id]);

            $request->session()->put('carrito', $carrito);
        }

        return redirect()
            ->route('carrito.index')
            ->with(
                'feedback.message',
                'El juego <b>' . e($juego->titulo) . '</b> se eliminó del carrito.'
            );
    }

    /**
     * Elimina todos los juegos almacenados en el carrito.
     */
    public function vaciar(Request $request)
    {
        $request->session()->forget('carrito');

        return redirect()
            ->route('carrito.index')
            ->with(
                'feedback.message',
                'El carrito se vació correctamente.'
            );
    }
}