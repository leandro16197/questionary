@extends('questionary.game-index')

@section('title', 'Play')

@section('content')
<div class="container style-container-play" id="question-container">
    <form id="answerForm" action="{{ route('submit.answers') }}" method="POST">
        @csrf

        <!-- Pregunta -->
        <div class="question text-center mb-4">
            <h2>{{ $question->question }}</h2>
        </div>

        <!-- Respuestas -->
        <div class="answers">
            @foreach ($respuestas as $respuesta)
            <div class="form-check">
                <input
                    class="form-check-input"
                    type="radio"
                    name="respuesta"
                    id="respuesta{{ $respuesta->id }}"
                    value="{{ $respuesta->id }}"
                    required
                    style="display: none;">
                <label
                    class="form-check-label answer-option"
                    for="respuesta{{ $respuesta->id }}"
                    data-id="{{ $respuesta->id }}"
                    data-correct="{{ $respuesta->is_correct ? '1' : '0' }}">
                    {{ $respuesta->response }}
                </label>
            </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary mt-4" id="submitAnswerBtn" style="display: none;">Enviar respuesta</button>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="resultModalLabel">Resultado del Quiz</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center" id="modal-results">
                <!-- Los resultados se insertarán aquí -->
                <p class="fs-4">¡Excelente trabajo!</p>
                <p class="fs-5">Respuestas correctas: <span id="correctas-count">0</span></p>
                <p class="fs-5">Respuestas incorrectas: <span id="incorrectas-count">0</span></p>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-outline-success" id="replayBtn">Volver a jugar</button>
                <button type="button" class="btn btn-outline-info" id="rankingBtn">Ir al Ranking</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let answerLabels = document.querySelectorAll('.answer-option');
        let respuestas = [];
        let respuestaCount = 0;

        function resetQuestionState() {
            answerLabels.forEach(label => {
                label.style.backgroundColor = '';
                label.style.color = '';
                label.style.pointerEvents = 'auto';
            });

            const inputs = document.querySelectorAll('.form-check-input');
            inputs.forEach(input => {
                input.disabled = false;
            });
        }

        function assignAnswerEvents() {
            answerLabels.forEach(label => {
                label.addEventListener('click', function() {
                    const selectedAnswerId = label.getAttribute('data-id');
                    const isCorrect = label.getAttribute('data-correct') === '1';

                    // Restablecer colores antes de aplicar nuevos estilos
                    answerLabels.forEach(l => {
                        l.style.backgroundColor = '';
                        l.style.color = '';
                    });

                    // Aplicar estilos según la respuesta seleccionada
                    if (!isCorrect) {
                        label.style.backgroundColor = 'red';
                        label.style.color = 'white';
                    } else {
                        label.style.backgroundColor = 'green';
                        label.style.color = 'white';
                    }

                    // Bloquear la selección de otras opciones
                    answerLabels.forEach(l => {
                        l.style.pointerEvents = 'none';
                    });

                    const inputs = document.querySelectorAll('.form-check-input');
                    inputs.forEach(input => {
                        input.disabled = true;
                    });

                    // Almacenar la respuesta seleccionada
                    respuestas.push({
                        id: selectedAnswerId,
                        isCorrect: isCorrect
                    });
                    respuestaCount++;

                    // Verificar si ya se respondieron 5 preguntas
                    if (respuestaCount >= 5) {
                        console.log("Enviando respuestas...", respuestas);
                        sendAllAnswers(respuestas);
                    } else {
                        console.log("Respuestas pendientes:", respuestaCount);
                        // Esperar 3 segundos y obtener otra pregunta aleatoria
                        setTimeout(() => {
                            fetchNewQuestion();
                        }, 1000);
                    }
                });
            });
        }

        // Función para enviar todas las respuestas al servidor
        function sendAllAnswers(respuestas) {
            fetch("{{ route('submit.answers') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        respuestas: respuestas
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Error: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Respuestas del servidor:', data);

                    // Mostrar los resultados en el modal
                    if (data.correctas !== undefined && data.incorrectas !== undefined) {
                        // Actualizar el contenido del modal
                        document.getElementById('modal-results').innerHTML = `
                        <p>Respuestas correctas: ${data.correctas}</p>
                        <p>Respuestas incorrectas: ${data.incorrectas}</p>
                    `;

                        // Inicializar el modal y mostrarlo
                        const myModal = new bootstrap.Modal(document.getElementById('resultModal'), {
                            keyboard: false // Esto es opcional, para desactivar el cierre al presionar ESC
                        });
                        myModal.show();
                    }
                })
                .catch(error => {
                    console.error('Error al enviar las respuestas:', error);
                    alert('Hubo un problema al procesar tus respuestas.');
                });
        }

        // Función para obtener una nueva pregunta
        function fetchNewQuestion() {
            fetch("{{ route('getQuestion') }}", {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    // Actualizar la pregunta y respuestas en el frontend
                    const questionContainer = document.getElementById('question-container');
                    const questionElement = questionContainer.querySelector('.question h2');
                    const answersContainer = questionContainer.querySelector('.answers');
                    answersContainer.innerHTML = '';

                    // Actualizar la pregunta
                    questionElement.textContent = data.question;

                    // Agregar nuevas respuestas
                    data.respuestas.forEach(respuesta => {
                        const answerLabel = document.createElement('label');
                        answerLabel.classList.add('form-check-label', 'answer-option');
                        answerLabel.setAttribute('data-id', respuesta.id);
                        answerLabel.setAttribute('data-correct', respuesta.is_correct ? '1' : '0');
                        answerLabel.textContent = respuesta.response;
                        answersContainer.appendChild(answerLabel);
                    });

                    // Restablecer estado y habilitar la selección
                    resetQuestionState();

                    // Reasignar los eventos de selección para las nuevas respuestas
                    answerLabels = document.querySelectorAll('.answer-option');
                    assignAnswerEvents();
                })
                .catch(error => {
                    console.error('Error al obtener la nueva pregunta:', error);
                });
        }

        // Llamar a la función para cargar la primera pregunta
        fetchNewQuestion();
        document.getElementById('replayBtn').addEventListener('click', function() {
            // Aquí puedes agregar la lógica para reiniciar el quiz
            location.reload(); 
        });

        // Manejar el botón "Ir al Ranking"
        document.getElementById('rankingBtn').addEventListener('click', function() {
            window.location.href = '/ranking';
        });
    });
</script>

@push('scripts')
@endpush