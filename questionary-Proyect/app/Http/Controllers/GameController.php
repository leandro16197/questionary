<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use App\Models\Ranking;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        return view('game-layouts.home');
    }

    public function play()
    {
        $random = Question::inRandomOrder()->first();
        $respuestas = Response::where('question_id', $random->id)->select('id', 'response', 'question_id', 'is_correct')->get();

        return view('game-layouts.play', [
            'question' => $random,
            'respuestas' => $respuestas
        ]);
    }
    public function submitAnswer(Request $request)
    {
        // Validación de las respuestas
        $request->validate([
            'respuestas' => 'required|array',
            'respuestas.*.id' => 'required|integer|exists:responses,id', 
            'respuestas.*.isCorrect' => 'required|boolean'
        ]);
    
        // Obtener las respuestas enviadas
        $respuestas = $request->input('respuestas');
    
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        if (!$user) {
            return response()->json(['message' => 'Usuario no autenticado'], 401);
        }
    
        // Verificar o crear el ranking del usuario
        $ranking = Ranking::firstOrCreate(
            ['users' => $user->id],
            ['points' => 0]
        );
    
        // Inicializar los contadores de respuestas correctas e incorrectas
        $correctas = 0;
        $incorrectas = 0;
    
        foreach ($respuestas as $respuestaData) {
            $respuesta = Response::find($respuestaData['id']);
    
            if (!$respuesta) {
                continue; // Si la respuesta no existe, se ignora
            }
    
            // Actualizar los puntos del ranking según la respuesta
            if ($respuestaData['isCorrect']) {
                $correctas++; // Incrementar respuestas correctas
                $ranking->points += 1; // Sumar 1 punto por respuesta correcta
            } else {
                $incorrectas++; // Incrementar respuestas incorrectas
                $ranking->points = max($ranking->points - 1, 0); // Restar 1 punto por respuesta incorrecta, sin dejar que sea negativo
            }
        }
    
        $ranking->save();
    
        // Devolver la respuesta con el conteo de respuestas correctas e incorrectas
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
    
}
