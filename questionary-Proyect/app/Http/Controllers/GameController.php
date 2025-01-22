<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use App\Models\Ranking;
use App\Models\vidaModel;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $vidas = vidaModel::where('user_id', $user->id)->first();
        return view('game-layouts.home', ['user' => $user, 'vidas' => $vidas]);
    }

    public function play()
    {
        $random = Question::inRandomOrder()
        ->leftjoin('generos','generos.id','=','questions.genero_id')
        ->first();
        $respuestas = Response::where('question_id', $random->id)
        ->select('id', 'response', 'question_id', 'is_correct')->get();
        $user = Auth::user();
        $vidas = vidaModel::where('user_id', $user->id)->first();
        return view('game-layouts.play', [
            'question' => $random,
            'respuestas' => $respuestas,
            'vidas' => $vidas
        ]);
    }
    public function submitAnswer(Request $request)
    {
 
        $request->validate([
            'respuestas' => 'required|array',
            'respuestas.*.id' => 'required|integer|exists:responses,id',
            'respuestas.*.isCorrect' => 'required|boolean'
        ]);

 
        $respuestas = $request->input('respuestas');


        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Usuario no autenticado'], 401);
        }

       
        $ranking = Ranking::firstOrCreate(
            ['id_user' => $user->id],
            ['points' => 0]
        );

       
        $correctas = 0;
        $incorrectas = 0;

        foreach ($respuestas as $respuestaData) {
            $respuesta = Response::find($respuestaData['id']);

            if (!$respuesta) {
                continue; 
            }

   
            if ($respuestaData['isCorrect']) {
                $correctas++; 
                $ranking->points += 1; 
            } else {
                $incorrectas++; 
                $ranking->points = max($ranking->points - 1, 0); 
            }
        }
        $vidas = vidaModel::where('user_id', '=', $user->id)->first();

        if (!$vidas) {

            $vidas = vidaModel::firstOrCreate(
                ['user_id' => $user->id],
                ['vidas' => 5]
            );
        }
        

        $vidaActual = $vidas->vidas;

        $vidas->vidas = $vidaActual - 1;

        $vidas->save();
        
        $ranking->save();


        return response()->json([
            'correctas' => $correctas,
            'incorrectas' => $incorrectas,
            'user_id' => $user->id,
            'ranking_points' => $ranking->points,
            'message' => 'Respuestas procesadas correctamente',
        ], 200);
    }


    public function getQuestion()
    {
        $random = Question::inRandomOrder()->first();

        if (!$random) {
            return response()->json(['error' => 'No hay más preguntas disponibles.'], 404);
        }

        $respuestas = Response::where('question_id', $random->id)
            ->select('id', 'response', 'is_correct')
            ->get();

        // Mezclar aleatoriamente las respuestas
        $respuestas = $respuestas->shuffle();

        return response()->json([
            'question' => $random->question,
            'respuestas' => $respuestas
        ]);
    }
    public function ranking(){
        $user = Auth::user();
        $vidas = vidaModel::where('user_id', $user->id)->first();
        return view('game-layouts.ranking', ['vidas' => $vidas]);

    }
    public function rankingDatos(Request $request)
    {
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $search = $request->input('search.value', '');
    
        $query = User::leftJoin('ranking', 'users.id', '=', 'ranking.id_user')
            ->select('users.username', 'users.name', 'ranking.points')
            ->orderBy('ranking.points','desc');
    
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'like', '%' . $search . '%')
                  ->orWhere('users.username', 'like', '%' . $search . '%');
            });
        }
    
        $filteredCount = $query->count();
    
        $datos = $query->orderBy('ranking.points', 'ASC')
            ->skip($start)
            ->take($length)
            ->get();
    
        $totalRecords = User::count();
    
        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredCount,
            'data' => $datos,
        ]);
    }
    
    
}
