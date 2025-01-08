@push('styles')
<link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
@endpush

    <div class="sidebar bg-dark text-white p-4 d-flex flex-column">
        <h4 class="text-center mb-4">Menu</h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-3">
                <a href="/listQuestions" class="nav-link text-white d-flex align-items-center py-3 px-3 rounded">
                    <i class="bi bi-list-task me-3 fs-4"></i> Lista Preguntas
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="/addQuestion" class="nav-link text-white d-flex align-items-center py-3 px-3 rounded">
                    <i class="bi bi-plus-square-dotted me-3 fs-4"></i> Pregunta / Genero
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="#" class="nav-link text-white d-flex align-items-center py-3 px-3 rounded">
                    <i class="bi bi-people me-3 fs-4"></i> Lista Usuarios
                </a>
            </li>
        </ul>
    </div>
