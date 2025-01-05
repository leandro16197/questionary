<!-- resources/views/questionary/form-add-questionary.blade.php -->
<style>
/* Estilos generales para los labels */
label {
    font-weight: bold;
    color: #444; /* Color gris oscuro para los textos del label */
    margin-bottom: 8px;
}

/* Estilos para los inputs */
input.form-control, select.form-control {
    border-radius: 8px;
    border: 1px solid #ccc;
    padding: 12px;
    font-size: 1rem;
    width: 100%;
    margin-top: 5px;
    background-color:rgb(252, 252, 252);
    color: #333;
    transition: border 0.3s ease, background-color 0.3s ease;
}

/* Estilo cuando el input está enfocado */
input.form-control:focus, select.form-control:focus {
    border-color:rgba(231, 233, 231, 0.57);
    background-color:rgb(185, 185, 185);
    outline: none;
}

/* Estilo para los botones */
button.btn-primary {
    background-color: #007bff; /* Azul suave */
    border-color: #0056b3; /* Azul más oscuro para el borde */
    color: white;
    padding: 12px 24px;
    font-size: 1.1rem;
    border-radius: 8px;
    cursor: pointer;
    width: 100%;
    margin-top: 20px;
    transition: background-color 0.3s ease, border-color 0.3s ease;
}

/* Cambio de color cuando el botón se pasa el mouse */
button.btn-primary:hover {
    background-color:rgb(1, 66, 136); 
    border-color:rgb(15, 31, 46); 
}

/* Estilos del formulario */
form {
    background-color:rgb(212, 212, 212);
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 700px;
    margin: 30px auto;
    transition: box-shadow 0.3s ease;
}

/* Cambiar sombra al pasar el mouse por encima del formulario */
form:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
}

/* Adaptaciones para pantallas más pequeñas */
@media (max-width: 768px) {
    .form-group {
        margin-bottom: 25px;
    }

    input.form-control, select.form-control {
        font-size: 1.1rem;
        padding: 14px;
    }

    button.btn-primary {
        font-size: 1.2rem;
        padding: 14px 28px;
    }

    select.form-control {
        background-color: #f8f9fa;
        color: #333;
        border: 1px solid #ccc;
    }
}

</style>

<form action="{{ route('questionary.store') }}" method="POST">
    @csrf 

    <div class="container mt-5">
        <div class="form-container p-4">

            <div class="form-group">
                <label for="question">Pregunta</label>
                <input type="text" name="question" id="question" class="form-control" value="{{ old('question') }}" required>
            </div>

            <div class="form-group">
                <label for="genero_id">Género</label>
                <select name="genero_id" id="genero_id" class="form-control" required>
                    @foreach($generos as $genero)
                        <option class="opciones-form" value="{{ $genero->id }}">{{ $genero->name }}</option>
                    @endforeach
                </select>
            </div>

            @foreach(range(1, 5) as $i)
            <div class="form-group">
                <label for="response_{{ $i }}">Respuesta {{ $i }}</label>
                <input type="text" name="responses[]" id="response_{{ $i }}" class="form-control" value="{{ old('responses.' . ($i - 1)) }}" required>
                <label for="response_{{ $i }}_correct">Verdadero</label>
                <input type="checkbox" name="correct_answers[]" value="{{ $i - 1 }}" id="response_{{ $i }}_correct">
            </div>
            @endforeach

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Agregar Pregunta</button>
            </div>
        </div>
    </div>
</form>

