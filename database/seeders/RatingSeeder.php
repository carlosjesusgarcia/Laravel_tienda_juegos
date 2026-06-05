<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ratings')->insert([
            [
                'rating_id'    => 1,
                'nombre'       => 'Apto para todo público',
                'abreviatura'  => 'ATP',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'rating_id'    => 2,
                'nombre'       => 'Mayores de 7 años',
                'abreviatura'  => '+7',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'rating_id'    => 3,
                'nombre'       => 'Mayores de 13 años',
                'abreviatura'  => '+13',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'rating_id'    => 4,
                'nombre'       => 'Mayores de 16 años',
                'abreviatura'  => '+16',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'rating_id'    => 5,
                'nombre'       => 'Mayores de 18 años',
                'abreviatura'  => '+18',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}