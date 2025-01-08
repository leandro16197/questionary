<div class="general">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch"> <!-- Cambié align-items-start a align-items-stretch -->
        <!-- Formulario de agregar pregunta -->
        <div class="form-preguntas order-2 order-md-1">
            <h1 class="addPreguntas">Agregar Pregunta</h1>
            <form class="form-questionary" action="{{ route('questionary.store') }}" method="POST">
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
                                <option value="">Seleccionar género</option> <!-- Opción por defecto -->
                            </select>
                        </div>

                        <!-- Contenedor para las respuestas -->
                        <div class="form-group">
                            <label>Respuestas</label>
                            <div class="responses-container">
                                <div class="row mb-3">
                                    @foreach(range(1, 5) as $i)
                                    <!-- Respuesta -->
                                    <div class="col-md-6 d-flex align-items-center">
                                        <input type="text" name="responses[]" id="response_{{ $i }}" class="form-control me-2" placeholder="Respuesta {{ $i }}" value="{{ old('responses.' . ($i - 1)) }}" required>
                                    </div>

                                    <!-- Checkbox -->
                                    <div class="col-md-6 d-flex align-items-center">
                                        <label for="response_{{ $i }}_correct" class="me-2">Verdadero</label>
                                        <input type="checkbox" name="correct_answers[]" value="{{ $i - 1 }}" id="response_{{ $i }}_correct">
                                    </div>

                                    <!-- Cerrar la fila después de cada dos respuestas -->
                                    @if($i % 2 == 0 && $i < 5)
                                        </div>
                                        <div class="row mb-3">
                                            @endif
                                            @endforeach
                                        </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Agregar Pregunta</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>

        <!-- Formulario de agregar género -->
        <div class="addGenero order-1 order-md-2 mt-0"> <!-- Cambié mt-4 a mt-0 para evitar el desplazamiento -->
            <h1 class="addPreguntas">Agregar Género</h1>
            <form class="form-questionary questionary_genero" id="addGeneroForm">
                <div class="mb-3">
                    <label class="addGenero-nombre" for="name">Nombre del Género:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Agregar Género</button>
            </form>
        </div>
    </div>
</div>


<script>
    document.getElementById('addGeneroForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        const name = formData.get('name');

        fetch('api/generos', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    name: name
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                if (data.status == 201) {


                    if (data.genero && data.genero.id && data.genero.name) {
                        const select = document.getElementById('genero_id');
                        const newOption = document.createElement('option');
                        newOption.value = data.genero.id;
                        newOption.textContent = data.genero.name;
                        select.appendChild(newOption);
                    } else {
                        console.log('Error: Los datos del género no están completos', data);
                    }
                } else {
                    console.log('Error al agregar género');
                }
            })
            .catch(error => console.error('Error:', error));
    });


    document.addEventListener('DOMContentLoaded', function() {
        fetch('api/generos')
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const select = document.getElementById('genero_id');
                select.innerHTML = '<option value="">Seleccionar género</option>';

                if (Array.isArray(data)) {
                    data.forEach(genero => {
                        const option = document.createElement('option');
                        option.value = genero.id;
                        option.textContent = genero.name;
                        select.appendChild(option);
                    });
                } else {
                    console.log('Error: La respuesta no contiene una lista de géneros', data);
                }
            })
            .catch(error => console.error('Error al cargar los géneros:', error));
    });
</script>