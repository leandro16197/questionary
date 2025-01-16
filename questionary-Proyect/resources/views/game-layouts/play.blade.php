@extends('questionary.game-index')

@section('title', 'Play')

@section('content')
<div class="container style-container-play">
    <form id="answerForm" action="{{ route('submit.answer') }}" method="POST">
        @csrf
        <div class="question text-center">
            <h2>{{ $question->question }}</h2>
        </div>
        <div class="answers mt-4">
            @foreach ($respuestas as $respuesta)
            <div class="form-check">
                <input class="form-check-input" type="radio" name="respuesta" id="respuesta{{ $respuesta->id }}" value="{{ $respuesta->id }}" required style="display: none;">
                <label class="form-check-label answer-option" for="respuesta{{ $respuesta->id }}" data-id="{{ $respuesta->id }}" data-correct="{{ $respuesta->is_correct ? '1' : '0' }}">
                    {{ $respuesta->response }}
                </label>
            </div>
            @endforeach
        </div>
    </form>
</div>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const answerLabels = document.querySelectorAll('.answer-option');

        answerLabels.forEach(label => {
            label.addEventListener('click', function () {
                const selectedAnswerId = label.getAttribute('data-id');
                const isCorrect = label.getAttribute('data-correct') === '1';  // Cambié 'true' por '1'
                const correctAnswerLabel = document.querySelector('.answer-option[data-correct="1"]');

                console.log('ID de respuesta seleccionada:', selectedAnswerId);
                console.log('¿Es correcta?', isCorrect);

                // Restablecer los colores antes de aplicar nuevos estilos
                answerLabels.forEach(l => {
                    l.style.backgroundColor = '';
                    l.style.color = '';
                });

                if (!selectedAnswerId) {
                    alert('No se seleccionó una respuesta válida.');
                    return;
                }

                if (!isCorrect) {
                    label.style.backgroundColor = 'red';  // Fondo rojo para respuesta incorrecta
                    label.style.color = 'white';  // Color de texto blanco
                } else {
                    label.style.backgroundColor = 'green';  // Fondo verde para respuesta correcta
                    label.style.color = 'white';  // Color de texto blanco
                }

                if (correctAnswerLabel) {
                    correctAnswerLabel.style.backgroundColor = 'green';  // Fondo verde para respuesta correcta
                    correctAnswerLabel.style.color = 'white';  // Color de texto blanco
                }

                // Ahora envía la respuesta al servidor
                fetch("{{ route('submit.answer') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        respuesta: selectedAnswerId
                    })
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`Error: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Respuesta del servidor:', data);
                    })
                    .catch(error => {
                        console.error('Error al enviar la respuesta:', error);
                        alert('Hubo un problema al procesar tu respuesta.');
                    });
            });
        });
    });
</script>


@push('scripts')
<script src="{{ asset('/js/game.js') }}"></script>
@endpush
