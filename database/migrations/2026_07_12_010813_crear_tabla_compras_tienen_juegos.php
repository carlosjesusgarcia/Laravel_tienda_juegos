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
        Schema::create('compras_tienen_juegos', function (Blueprint $table) {
            $table->id('compra_juego_id');
            $table->unsignedBigInteger('compra_fk');
            $table->unsignedBigInteger('juego_fk');
            $table->unsignedSmallInteger('cantidad');
            $table->unsignedInteger('precio_unitario');
            $table->string('descripcion', 255);
            $table->timestamps();

            $table->foreign('compra_fk')
                ->references('compra_id')
                ->on('compras');

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
        Schema::dropIfExists('compras_tienen_juegos');
    }
};