<?php
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\generosController;
use App\Http\Controllers\QuestionaryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::group(['middleware' => function ($request, $next) {
        if (Auth::check() && Auth::user()->rol == 1) {
            return $next($request);
        }
        return redirect('/')->with('error', 'No tienes permisos para acceder a esta página.');
    }], function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::post('/questionary', [QuestionaryController::class, 'store'])->name('questionary.store');
        Route::get('/addQuestion', [generosController::class, 'getGeneros'])->name('addQuestion');
        Route::get('/questions/data', [QuestionaryController::class, 'getQuestionsData'])->name('questions.data');
        Route::get('/dato/{id}', [QuestionaryController::class, 'datoById']);
        Route::get('/listQuestions', [QuestionaryController::class, 'index'])->name('listQuestions');
        Route::post('/modificar', [QuestionaryController::class, 'update']);
        Route::delete('/eliminar-questionary/{id}', [QuestionaryController::class, 'destroy'])->name('questionary.destroy');
    });

    // Rutas accesibles para todos los usuarios autenticados
    Route::get('/home', [GameController::class, 'index']);
    Route::get('/play', [GameController::class, 'play'])->name('play');
    Route::post('/submit-answer', [GameController::class, 'submitAnswer'])->name('submit.answers');
    Route::get('/ranking', [GameController::class, 'ranking']);
    Route::get('/ranking/datos', [GameController::class, 'rankingDatos']);
});

require __DIR__ . '/auth.php';
