@extends('layouts.app')

@section('header')
@section('title', 'Questionary')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">

<link rel="stylesheet" type="text/css" href="{{ asset('node_modules/datatables.net-dt/css/jquery.dataTables.css') }}">

@endpush
@section('content')

<div class="py-12 bg-gray-50 dark:bg-gray-900">
    <div class="div-actualizacion-perfil">

        <div class="form-questionary">
            <div class="centered-content">
                <h2 class="centered-text">
                    Actualizar Información del Perfil
                </h2>
                <p class="centered-text">
                    Modifica tu información personal aquí.
                </p>
            </div>

            <div class="p-6">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        {{-- Cambio de Contraseña --}}
        <div class="form-questionary">
            <div class="p-6">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- Eliminación de Usuario --}}
        <div class="form-questionary">
            <div class="">
                <h2 class="centered-text">
                    Eliminar Cuenta
                </h2>
                <p class="centered-text">
                    Advertencia: Esta acción es irreversible.
                </p>
            </div>
            <div class="style-danger p-6">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>

@endsection

<style>
    .div-actualizacion-perfil {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

    }

    .centered-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .centered-text {
        text-align: center;
    }

    .form-questionary {
        color: aliceblue !important;
        margin-bottom: 2% !important;
        transition:none !important;
    }
    .style-danger{
        margin-bottom: 2% !important;
        border: none !important;
    }
</style>