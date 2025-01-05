<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;

class QuestionaryController extends Controller
{
   public function store(Request $request){
      
      $request->validate([
         'question' => 'required|string|max:100',
         'genero_id' => 'required|exists:generos,id',
         'responses' => 'required|array|min:1|max:5',
         'correct_answers' => 'required|array|min:1|max:5',
      ]);

      $question = Question::create([
         'question' => $request->question,
         'genero_id' => $request->genero_id,
      ]);

      foreach ($request->input('responses') as $index => $response) {
         Response::create([
               'question_id' => $question->id,
               'response' => $response,
               'is_correct' => in_array($index, $request->input('correct_answers')), // Verifica si es correcta
         ]);
      }

      return redirect()->back()->with('success', 'Pregunta agregada correctamente');
   }
}
