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
        Schema::table('juegos', function (Blueprint $table) {
            // Definimos la FK para ratings.
            // Primero, creamos el campo. Como sabemos, debe tener el mismo dominio que la PK que referencia.
            $table->unsignedTinyInteger('rating_fk');

            // La declaramos como FK.
            $table->foreign('rating_fk')->references('rating_id')->on('ratings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('juegos', function (Blueprint $table) {
            $table->dropForeign(['rating_fk']);
            $table->dropColumn('rating_fk');
        });
    }
};