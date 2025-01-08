<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Questions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        $questions = [
            ['question' => '¿Quién pintó la Mona Lisa?', 'genero_id' => 2],
            ['question' => '¿En qué año terminó la Segunda Guerra Mundial?', 'genero_id' => 3],
            ['question' => '¿Cuál es el resultado de 8 x 7?', 'genero_id' => 4],
            ['question' => '¿Quién escribió Don Quijote de la Mancha?', 'genero_id' => 5],
            ['question' => '¿Qué órgano del cuerpo humano produce insulina?', 'genero_id' => 6],
            ['question' => '¿Quién fue el primer presidente de los Estados Unidos?', 'genero_id' => 7],
            ['question' => '¿Cuál es la capital de Japón?', 'genero_id' => 8],
            ['question' => '¿Qué pintor es conocido por sus Guernica" y "Las Meninas?', 'genero_id' => 2],
            ['question' => '¿Quién fue el líder del Imperio Romano durante su expansión más grande?', 'genero_id' => 3],
            ['question' => '¿Qué fórmula matemática representa el área de un círculo?', 'genero_id' => 4],
            ['question' => '¿Quién escribió Cien años de soledad?', 'genero_id' => 5],
            ['question' => '¿En qué país nació el escritor Franz Kafka?', 'genero_id' => 5],
            ['question' => '¿Cuál es la capital de Argentina?', 'genero_id' => 8],
            ['question' => '¿Quién pintó El Guernica?', 'genero_id' => 2],
            ['question' => '¿En qué año se lanzó la primera película de Star Wars?', 'genero_id' => 2],
            ['question' => '¿Cuál es la capital de Canadá?', 'genero_id' => 8],
            ['question' => '¿Qué instrumento se utiliza para medir la temperatura?', 'genero_id' => 6],
            ['question' => '¿Quién pintó la Noche Estrellada?', 'genero_id' => 2],
            ['question' => '¿Quién fue el último emperador romano?', 'genero_id' => 3],
            ['question' => '¿Qué elemento químico tiene el símbolo O?', 'genero_id' => 4],
        ];

        foreach ($questions as $question) {
            DB::table('questions')->insert([
                'question' => $question['question'],
                'genero_id' => $question['genero_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

    }
}
