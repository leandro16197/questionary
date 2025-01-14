<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ClearQuestionsResponsesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Deshabilitar las restricciones de claves foráneas temporalmente
         DB::statement('SET FOREIGN_KEY_CHECKS=0;');

         // Borrar los registros de la tabla responses
         DB::table('responses')->truncate();
 
         // Borrar los registros de la tabla questions
         DB::table('questions')->truncate();
          // Borrar los registros de la tabla generos
         DB::table('generos')->truncate();
         // Habilitar nuevamente las restricciones de claves foráneas
         DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
