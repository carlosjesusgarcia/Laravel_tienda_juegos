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
        /*
            Schema::table() permite modificar una tabla existente.
            En SQL, esta operación equivale a ALTER TABLE.
        */
        Schema::table('juegos', function (Blueprint $table) {
            $table->string('portada')->nullable();
            $table->string('portada_descripcion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('juegos', function (Blueprint $table) {
            $table->dropColumn(['portada', 'portada_descripcion']);
        });
    }
};