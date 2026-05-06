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
        // Creamos el slug, lo hacemos único y lo ponemos después del título
        $table->string('slug')->unique()->after('titulo')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('juegos', function (Blueprint $table) {
            //
        });
    }
};
