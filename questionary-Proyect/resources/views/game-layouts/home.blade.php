@extends('questionary.game-index')

@section('title', 'Inicio')

@section('content')
<div class="container mt-5">
    <h1 class="titulo-home text-center">¡Bienvenido a Quiz!</h1>
    <p class="text-muted text-center">
        Pon a prueba tus conocimientos con preguntas desafiantes y opciones múltiples. 
        Cada respuesta correcta te llevará un paso más cerca de la victoria. ¿Estás listo para el desafío?
    </p>

    <div class="text-center mt-4">
        <img src="{{ asset('img/logo.png') }}" alt="Questionary Logo" class="img-fluid" style="max-width: 200px;">
    </div>

    <div class="text-center mt-5">
        <a href="/play" class="btn btn-primary btn-lg" style="background-color: #6d90a0; border: none; font-size: 1.5rem;">
            <i class="fa-solid fa-play me-2"></i> Comenzar a Jugar
        </a>
    </div>
</div>
@endsection

@section('scripts')
@endsection
