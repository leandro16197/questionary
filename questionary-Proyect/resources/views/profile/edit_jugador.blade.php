@extends('questionary.game-index')

@section('header')
@section('title', 'Perfil')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('node_modules/datatables.net-dt/css/jquery.dataTables.css') }}">
@endpush
@section('content')

<div class="py-12 bg-gray-50 dark:bg-gray-900">
    <div class="div-actualizacion-perfil">

        <div class="modificar-contrasena">
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