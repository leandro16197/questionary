@extends('layouts.app')

@section('header')
@section('title', 'questionary')
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
@endpush

@section('content')
<div class="contenedor-principal d-flex align-items-stretch" style="min-height: 100vh;">
    <div class="sidebar bg-dark text-white p-4 d-flex flex-column">
        <h4 class="text-center mb-4">Menu</h4>
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

    <!-- Main Content -->
    <div class="main-content flex-grow-1 p-4">
        @include('questionary.form-add-questionary', ['generos' => $generos])
    </div>
</div>
@endsection
<style>
    .main-content {
        margin-left: 5%;
    }

    .contenedor-principal {
        margin-top: -1.2% !important;
    }

    .d-flex.align-items-stretch {
        display: flex;
        align-items: stretch;
    }

    /* Sidebar */
    .sidebar {
        background-color: #212529; /* Fondo oscuro */
        width: 260px;
        border-right: 1px solid #444;
        box-shadow: 4px 0 8px rgba(0, 0, 0, 0.1);
    }

    .sidebar h4 {
        font-size: 1.5rem;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 0 !important;
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

    /* Responsiveness: Hide sidebar on small screens */
    @media (max-width: 800px) {
        .sidebar {
            display: none;
        }

        .main-content {
            margin-left: 0;
        }
    }
</style>
