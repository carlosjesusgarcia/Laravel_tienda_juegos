<?php
/**
 * Archivo: ComprasSeeder.php
 * Función: Poblador de base de datos para registrar compras iniciales realizadas por usuarios del sistema.
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Compra;
use App\Models\User;
use App\Models\Juego;

/**
 * Clase ComprasSeeder
 *
 * Inserta compras de prueba asociadas a usuarios y juegos existentes.
 * Permite cumplir el requisito de visualizar productos o servicios contratados
 * dentro del detalle de usuario del panel administrador.
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

        Compra::create([
            'user_fk' => $luigi->id,
            'juego_fk' => $pacMan->juego_id,
            'fecha_compra' => '2026-06-15',
            'precio' => $pacMan->precio,
            'estado' => 'completada',
        ]);

        Compra::create([
            'user_fk' => $luigi->id,
            'juego_fk' => $superMarioBros->juego_id,
            'fecha_compra' => '2026-06-16',
            'precio' => $superMarioBros->precio,
            'estado' => 'completada',
        ]);

        Compra::create([
            'user_fk' => $luigi->id,
            'juego_fk' => $zelda->juego_id,
            'fecha_compra' => '2026-06-17',
            'precio' => $zelda->precio,
            'estado' => 'completada',
        ]);
    }
}
