@push('styles')
<link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
@endpush

<div class="sidebar bg-dark text-white p-4">
    <!-- Sidebar -->
    <div class="sidebar bg-dark text-white p-4 d-flex flex-column" style="width: 260px; height: 100vh;">
        <h4 class="text-center mb-4">Dashboard</h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-3">
                <a href="#" class="nav-link text-white d-flex align-items-center py-3 px-3 rounded">
                    <i class="bi bi-list-task me-3 fs-4"></i> Lista Preguntas
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="#" class="nav-link text-white d-flex align-items-center py-3 px-3 rounded">
                    <i class="bi bi-plus-square-dotted me-3 fs-4"></i> Crear Questionary
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="#" class="nav-link text-white d-flex align-items-center py-3 px-3 rounded">
                    <i class="bi bi-people me-3 fs-4"></i> Lista Usuarios
                </a>
            </li>
        </ul>
    </div>

</div>

<style>
    .sidebar {
        background-color: #212529; /* Fondo oscuro */
        border-right: 1px solid #444;
        box-shadow: 4px 0 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .sidebar h4 {
        font-size: 1.5rem;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 30px;
        border-bottom: 2px solid #444;
        padding-bottom: 10px;
    }

    .nav-link {
        color: #ffffff;
        font-size: 1.2rem;
        padding: 12px 20px;
        border-radius: 8px;
        margin-bottom: 15px;
        transition: all 0.3s ease-in-out;
        display: flex;
        align-items: center;
    }

    .nav-link:hover {
        background-color: #343a40;
        color: #f8f9fa;
        transform: translateX(5px);
        box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
    }

    .nav-item {
        margin-bottom: 20px;
    }

    .nav-link i {
        margin-right: 15px;
        font-size: 1.5rem;
        color: #adb5bd;
    }

    .nav-link:hover i {
        color: #f8f9fa;
    }

    /* Responsividad */
    @media (max-width: 768px) {
        .sidebar {
            width: 70px;
            padding: 15px;
        }

        .sidebar h4 {
            font-size: 1rem;
            text-align: center;
        }

        .nav-link {
            font-size: 0;
            padding: 15px;
            justify-content: center;
        }

        .nav-link i {
            font-size: 1.5rem;
            margin-right: 0;
        }

        .nav-link:hover {
            transform: none;
        }
    }
</style>