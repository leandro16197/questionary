<div class="form-preguntas">
    <h1 class="addPreguntas">Agregar Pregunta</h1>
    <form action="{{ route('questionary.store') }}" method="POST">
        @csrf

        <div class="container mt-5">
            <div class="form-container p-4">

                <!-- Campo de pregunta -->
                <div class="form-group">
                    <label for="question">Pregunta</label>
                    <input type="text" name="question" id="question" class="form-control" value="{{ old('question') }}" required>
                </div>

                <!-- Selección de género -->
                <div class="form-group">
                    <label for="genero_id">Género</label>
                    <select name="genero_id" id="genero_id" class="form-control" required>
                        @foreach($generos as $genero)
                        <option class="opciones-form" value="{{ $genero->id }}">{{ $genero->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Contenedor para las respuestas en pares -->
                <div class="form-group">
                    <label>Respuestas</label>
                    <div class="responses-container">
                        <div class="row mb-3">
                            @foreach(range(1, 5) as $i)
                            <div class="col-md-6 d-flex align-items-center">
                                <input type="text" name="responses[]" id="response_{{ $i }}" class="form-control me-2" placeholder="Respuesta {{ $i }}" value="{{ old('responses.' . ($i - 1)) }}" required>
                                <label for="response_{{ $i }}_correct" class="me-2">Verdadero</label>
                                <input type="checkbox" name="correct_answers[]" value="{{ $i - 1 }}" id="response_{{ $i }}_correct">
                            </div>
                            @if($i % 2 == 0 && $i < 5)
                                </div>
                                <div class="row mb-3">
                                    @endif
                                    @endforeach
                                </div>
                        </div>
                    </div>


                    <!-- Botón para enviar el formulario -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Agregar Pregunta</button>
                    </div>
                </div>
            </div>
    </form>
</div>
<div class="addGenero">
    
</div>

<style>
    /* Estilo general para labels */
    label {
        font-weight: bold;
        color: #444;
        margin-bottom: 8px;
    }

    /* Estilo para inputs y select */
    input.form-control,
    select.form-control {
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 12px;
        font-size: 1rem;
        width: 100%;
        margin-top: 5px;
        background-color: rgb(252, 252, 252);
        color: #333;
        transition: border 0.3s ease, background-color 0.3s ease;
    }

    input.form-control:focus,
    select.form-control:focus {
        border-color: rgba(231, 233, 231, 0.57);
        background-color: rgb(185, 185, 185);
        outline: none;
    }

    /* Estilo para botones */
    button.btn-primary {
        background-color: #007bff;
        border-color: #0056b3;
        color: white;
        padding: 12px 24px;
        font-size: 1.1rem;
        border-radius: 8px;
        cursor: pointer;
        width: 100%;
        margin-top: 20px;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    button.btn-primary:hover {
        background-color: rgb(1, 66, 136);
        border-color: rgb(15, 31, 46);
    }

    /* Estilo del formulario */
    form {
        background-color: rgb(212, 212, 212);
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 700px;
        transition: box-shadow 0.3s ease;
    }

    form:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    /* Estilo del contenedor de respuestas */
    .responses-container .row {
        margin-bottom: 15px;
    }

    .responses-container .col-md-6 {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Títulos estilizados */
    .addPreguntas {
        font-family: 'Arial', sans-serif;
        font-size: 2rem;
        font-weight: bold;
        color: rgb(146, 190, 233);
        text-align: center;
        text-transform: uppercase;
        margin: 20px 0;
        position: relative;
    }

    .addPreguntas::after {
        content: "";
        display: block;
        width: 80px;
        height: 4px;
        background-color: #0d6efd;
        margin: 10px auto 0;
        border-radius: 2px;
    }

    /* Adaptaciones responsivas */
    @media (max-width: 768px) {
        .responses-container .col-md-6 {
            flex-direction: column;
            align-items: flex-start;
        }

        input.form-control,
        select.form-control {
            font-size: 1.1rem;
            padding: 14px;
        }

        button.btn-primary {
            font-size: 1.2rem;
            padding: 14px 28px;
        }
    }
</style>