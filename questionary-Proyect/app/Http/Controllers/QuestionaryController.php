<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;

class QuestionaryController extends Controller
{
   public function index()
   {

      $questions = Question::all(['id', 'question']);

      return view('questionary.questionList', [
         'question' => $questions,
      ]);
   }
   public function getQuestionsData(Request $request)
   {
       $start = $request->input('start', 0);
       $length = $request->input('length', 10);
       $search = $request->input('search.value', '');
   
       $query = Question::select('questions.id', 'questions.question', 'generos.name as genero_name')
           ->leftJoin('generos', 'generos.id', '=', 'questions.genero_id');
       $filteredCountQuery = clone $query;
       if ($search) {
           $query->where('questions.question', 'like', '%' . $search . '%')
               ->orWhere('generos.name', 'like', '%' . $search . '%');
           $filteredCountQuery->where('questions.question', 'like', '%' . $search . '%')
               ->orWhere('generos.name', 'like', '%' . $search . '%');
       }
   
       $recordsFiltered = $filteredCountQuery->count();
       $data = $query->skip($start)->take($length)->get();     
       return response()->json([
           'draw' => $request->input('draw'),
           'recordsTotal' => Question::count(), 
           'recordsFiltered' => $recordsFiltered,
           'data' => $data, 
       ]);
   }
   
   public function datoById($id)
   {
      $questions = Question::leftJoin('generos', 'generos.id', '=', 'questions.genero_id')
         ->select(
            'questions.id as question_id',
            'questions.question as pregunta',
            'generos.id as genero_id',
            'generos.name as genero_name',
         )
         ->where('questions.id', $id)
         ->first();
      $respuestas = Response::select('response as respuest', 'id', 'is_correct')
         ->where('question_id', $questions->question_id)
         ->get();
      $data = [
         'question' => $questions,
         'respuestas' => $respuestas
      ];
      return response()->json([
         'data' => $data
      ]);
   }


   public function store(Request $request)
   {

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
            'is_correct' => in_array($index, $request->input('correct_answers')),
         ]);
      }

      return redirect()->back()->with('success', 'Pregunta agregada correctamente');
   }
   


   public function update(Request $request)
   {
       $request->validate([
           'question_id' => 'required|exists:questions,id',
           'question' => 'required|string|max:100',
           'genero_id' => 'required|exists:generos,id',
           'responses' => 'required|array|min:1|max:5',
           'correct_answers' => 'required|array|min:1|max:5',
       ]);
   
       $question = Question::find($request->question_id);
       if ($question) {
           $question->question = $request->question;
           $question->genero_id = $request->genero_id;
           $question->save();
   
           foreach ($request->responses as $responseData) {
               $response = Response::find($responseData['id']);
               if ($response) {
                   $response->is_correct = in_array($responseData['id'], $request->correct_answers);
                   $response->response = $responseData['text'];
                   $response->save();
               }
           }
   

           return redirect()->back()->with('message', 'Datos Actualizados correctamente.');
       } else {
           return redirect()->back()->with('error', 'Pregunta no encontrada.');
       }
   }
   
   public function destroy($id)
   {
       $question = Question::findOrFail($id);
       if ($question) {
           $question->delete();
           return response()->json([
               'status' => 'success',
               'message' => 'Pregunta eliminada correctamente.'
           ]);
       } else {
           return response()->json([
               'status' => 'error',
               'message' => 'Pregunta no encontrada.'
           ]);
       }
   }
   
   
   
   
}
