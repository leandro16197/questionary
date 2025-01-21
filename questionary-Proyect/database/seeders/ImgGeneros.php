<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImgGeneros extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generos = [
            'Pelicula' => 'img/pelicula.png',
            'Geografia' => 'img/geografia.png',
            'Historia' => 'img/historia.png',
            'Matematica' => 'img/matematica.png',
            'Literatura' => 'img/literatura.png',
            'Medicina' => 'img/medicina.png',
            'Politica' => 'img/politica.png',
        ];

        foreach ($generos as $name => $image) {
            DB::table('generos')
                ->where('name', $name)  
                ->update(['image' => $image]); 
        }
    }
}
