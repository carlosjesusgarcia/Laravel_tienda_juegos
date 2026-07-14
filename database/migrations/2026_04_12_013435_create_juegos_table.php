<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('juegos', function (Blueprint $table) {
            // Definimos el ID personalizado para la tabla juegos
            $table->id('juego_id');

            // Campo VARCHAR de hasta 100 caracteres para el título
            $table->string('titulo', 100);

            // Campo INT UNSIGNED para el precio (sin signo, no puede ser negativo)
            $table->unsignedInteger('precio');

            // Campo DATE para la fecha de lanzamiento
            $table->date('fecha_lanzamiento');

            // Campo TEXT para una descripción larga o sinopsis
            $table->text('sinopsis');

            // Crea las columnas created_at y updated_at automáticamente
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juegos');
    }
};