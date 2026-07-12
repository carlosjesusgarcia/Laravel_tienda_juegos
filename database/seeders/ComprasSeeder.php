<?php
/**
 * Archivo: ComprasSeeder.php
 * Función: Poblador de base de datos para registrar compras iniciales realizadas por usuarios del sistema.
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Compra;
use App\Models\CompraTieneJuego;
use App\Models\User;
use App\Models\Juego;

/**
 * Clase ComprasSeeder
 *
 * Inserta una compra de prueba asociada a un usuario existente
 * y registra los juegos incluidos mediante el modelo del detalle.
 */
class ComprasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $luigi = User::where('email', 'luigi@nintendo.com')->first();

        $pacMan = Juego::where('slug', 'pac-man')->first();
        $superMarioBros = Juego::where('slug', 'super-mario-bros')->first();
        $zelda = Juego::where('slug', 'the-legend-of-zelda')->first();

        // Creamos la cabecera de la compra
        $compra = Compra::create([
            'user_fk' => $luigi->id,
            'fecha_compra' => '2026-06-15',
            'total' => $pacMan->precio
                + $superMarioBros->precio
                + $zelda->precio,
            'estado' => 'completada',
        ]);

        // Registramos los juegos incluidos en la compra
        CompraTieneJuego::create([
            'compra_fk' => $compra->compra_id,
            'juego_fk' => $pacMan->juego_id,
            'cantidad' => 1,
            'precio_unitario' => $pacMan->precio,
            'descripcion' => $pacMan->titulo,
        ]);

        CompraTieneJuego::create([
            'compra_fk' => $compra->compra_id,
            'juego_fk' => $superMarioBros->juego_id,
            'cantidad' => 1,
            'precio_unitario' => $superMarioBros->precio,
            'descripcion' => $superMarioBros->titulo,
        ]);

        CompraTieneJuego::create([
            'compra_fk' => $compra->compra_id,
            'juego_fk' => $zelda->juego_id,
            'cantidad' => 1,
            'precio_unitario' => $zelda->precio,
            'descripcion' => $zelda->titulo,
        ]);
    }
}