<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class generosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generos=[
            ['name' => 'Pelicula'],
            ['name' => 'Geografia'],
            ['name' => 'Historia'],
            ['name' => 'Matematica'],
            ['name' => 'Literatura'],
            ['name' => 'Medicina'],
            ['name' => 'Politica'],
            ['name' => 'nexGenero'],
        ];

        DB::table('generos')->insert($generos);
    }
}
