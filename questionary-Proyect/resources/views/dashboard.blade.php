@extends('layouts.app')

@section('header')
@section('title', 'Quiz')
@endsection


@section('content')
<div class="contenedor-principal d-flex align-items-stretch">
    <div class="main-content flex-grow-1">
        @include('questionary.form-add-questionary', ['generos' => $generos])
    </div>
</div>
@endsection
