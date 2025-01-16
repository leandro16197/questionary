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
        $request->validate([
            'respuesta' => 'required|integer|exists:responses,id'
        ]);

        $respuestaId = $request->input('respuesta');
        $respuesta = Response::find($respuestaId);

        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['message' => 'Usuario no autenticado'], 401);
        }

        $usuario = User::find($userId);

        if (!$respuesta) {
            return response()->json(['message' => 'Respuesta no válida'], 400);
        }

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 400);
        }

        $ranking = Ranking::where('users', $userId)->first();

        if (!$ranking) {
            $ranking = new Ranking();
            $ranking->users = $userId;
            $ranking->points = 0;
            $ranking->save();
        }

        $puntos = $ranking->points;
        $ranking->points = $respuesta->is_correct ? $puntos + 1 : $puntos - 1;

        if ($ranking->points < 0) {
            $ranking->points = 0;
        }

        $ranking->save();

        return response()->json([
            'message' => $respuesta->is_correct ? '¡Respuesta correcta!' : '¡Respuesta incorrecta!',
            'user_id' => $userId,
            'ranking_points' => $ranking->points
        ], 200);
    }
}
