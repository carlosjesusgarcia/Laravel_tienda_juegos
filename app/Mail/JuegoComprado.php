<?php

/**
 * Archivo: JuegoComprado.php
 * Función: Construye el correo de confirmación de compra y adjunta
 * el comprobante correspondiente al pedido registrado.
 */

namespace App\Mail;

use App\Models\Compra;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JuegoComprado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Crea una nueva instancia del correo.
     */
    public function __construct(public Compra $compra)
    {
        $this->compra->loadMissing([
            'usuario',
            'detalles.juego',
        ]);
    }

    /**
     * Define el asunto del correo electrónico.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmación de compra #' . $this->compra->compra_id,
        );
    }

    /**
     * Define la vista HTML utilizada como cuerpo del correo.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.juego-comprado',
        );
    }

    /**
     * Adjunta el comprobante de compra generado mediante una vista Blade.
     *
     * @return array<int, \Illuminate\Mail\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(
                fn () => view(
                    'emails.comprobante-compra',
                    [
                        'compra' => $this->compra,
                    ]
                )->render(),
                'comprobante-compra-' . $this->compra->compra_id . '.html'
            )->withMime('text/html'),
        ];
    }
}