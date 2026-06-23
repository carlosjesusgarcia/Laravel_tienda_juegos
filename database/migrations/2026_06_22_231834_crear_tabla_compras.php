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
        Schema::create('compras', function (Blueprint $table) {
            $table->id('compra_id');
            $table->unsignedBigInteger('user_fk');
            $table->unsignedBigInteger('juego_fk');
            $table->date('fecha_compra');
            $table->unsignedInteger('precio');
            $table->string('estado', 30);
            $table->timestamps();

            $table->foreign('user_fk')
                ->references('id')
                ->on('users');

            $table->foreign('juego_fk')
                ->references('juego_id')
                ->on('juegos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
