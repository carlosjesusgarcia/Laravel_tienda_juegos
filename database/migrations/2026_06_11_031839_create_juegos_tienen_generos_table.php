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
        Schema::create('juegos_tienen_generos', function (Blueprint $table) {
            $table->unsignedBigInteger('juego_fk');
            $table->unsignedSmallInteger('genero_fk');
            $table->timestamps();

            $table->foreign('juego_fk')->references('juego_id')->on('juegos');
            $table->foreign('genero_fk')->references('genero_id')->on('generos');

            $table->primary(['juego_fk', 'genero_fk']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juegos_tienen_generos');
    }
};
