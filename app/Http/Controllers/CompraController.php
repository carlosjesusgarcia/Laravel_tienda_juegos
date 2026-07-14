<?php

/**
 * Archivo: CompraController.php
 * Función: Confirma, registra y procesa las compras realizadas
 * por los usuarios mediante Mercado Pago Sandbox.
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
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

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
     * Registra la compra y sus juegos con estado pendiente.
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

        return redirect()
            ->route('compras.pago', $compra->compra_id);
    }

    /**
     * Crea la preferencia de pago y muestra el botón de Mercado Pago.
     */
    public function pago(Request $request, int $compra)
    {
        $compra = Compra::with([
            'usuario',
            'detalles.juego',
        ])
            ->where('compra_id', $compra)
            ->where('user_fk', Auth::id())
            ->firstOrFail();

        if($compra->estado === 'completada') {
            return redirect()
                ->route('compras.detalles', $compra->compra_id);
        }

        $items = [];

        foreach($compra->detalles as $detalle) {
            $items[] = [
                'title' => $detalle->descripcion,
                'quantity' => (int) $detalle->cantidad,
                'unit_price' => (float) $detalle->precio_unitario,
            ];
        }

        MercadoPagoConfig::setAccessToken(
            config('mercadopago.access_token')
        );

        $mercadopagoPublicKey = config(
            'mercadopago.public_key'
        );

        try {
            $preferenceFactory = new PreferenceClient();

            /*
             * Esta URL debe coincidir con la URL HTTPS que muestra
             * la terminal donde se ejecuta: ngrok http 8000
             */
            $urlNgrok = 'https://washday-visitor-gills.ngrok-free.dev';

            $preference = $preferenceFactory->create([
                'items' => $items,
                'back_urls' => [
                    'success' => $urlNgrok . '/compras/pago/exito',
                    'pending' => $urlNgrok . '/compras/pago/pendiente',
                    'failure' => $urlNgrok . '/compras/pago/fallido',
                ],
                'auto_return' => 'approved',
                'external_reference' => (string) $compra->compra_id,
            ]);

            /*
             * El carrito se vacía después de que Mercado Pago
             * creó correctamente la preferencia.
             */
            $request->session()->forget('carrito');

            return view('compras.pago', [
                'compra' => $compra,
                'preference' => $preference,
                'mercadopagoPublicKey' => $mercadopagoPublicKey,
            ]);
        } catch(\MercadoPago\Exceptions\MPApiException $excepcion) {
            return redirect()
                ->route('compras.detalles', $compra->compra_id)
                ->with(
                    'feedback.message',
                    'Mercado Pago rechazó la creación de la preferencia.'
                );
        } catch(\Exception $excepcion) {
            return redirect()
                ->route('compras.detalles', $compra->compra_id)
                ->with(
                    'feedback.message',
                    'No se pudo conectar con Mercado Pago.'
                );
        }
    }

    /**
     * Procesa el retorno cuando el pago fue aprobado.
     */
    public function pagoExito(Request $request)
    {
        $compraId = (int) $request->query('external_reference');
        $estadoPago = $request->query('status');

        $compra = Compra::with([
            'usuario',
            'detalles.juego',
        ])
            ->where('compra_id', $compraId)
            ->firstOrFail();

        if(
            $estadoPago === 'approved' &&
            $compra->estado !== 'completada'
        ) {
            $compra->estado = 'completada';
            $compra->save();

            Mail::to($compra->usuario->email)
                ->send(new JuegoComprado($compra));
        }

        /*
         * Ngrok recibe el retorno público de Mercado Pago.
         * Después volvemos a 127.0.0.1 para recuperar la sesión,
         * los estilos y las rutas normales del proyecto local.
         */
        return redirect()->away(
            'http://127.0.0.1:8000/compras/' . $compra->compra_id
        );
    }

    /**
     * Procesa el retorno cuando el pago queda pendiente.
     */
    public function pagoPendiente(Request $request)
    {
        $compraId = (int) $request->query('external_reference');

        $compra = Compra::with([
            'detalles.juego',
        ])
            ->where('compra_id', $compraId)
            ->firstOrFail();

        if($compra->estado !== 'completada') {
            $compra->estado = 'pendiente';
            $compra->save();
        }

        return redirect()->away(
            'http://127.0.0.1:8000/compras/' . $compra->compra_id
        );
    }

    /**
     * Procesa el retorno cuando el pago falla o es rechazado.
     */
    public function pagoFallido(Request $request)
    {
        $compraId = (int) $request->query('external_reference');

        $compra = Compra::with([
            'detalles.juego',
        ])
            ->where('compra_id', $compraId)
            ->firstOrFail();

        if($compra->estado !== 'completada') {
            $compra->estado = 'fallida';
            $compra->save();
        }

        return redirect()->away(
            'http://127.0.0.1:8000/compras/' . $compra->compra_id
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