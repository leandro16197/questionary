@extends('questionary.game-index')

@section('title', 'Ranking')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">

<link rel="stylesheet" type="text/css" href="{{ asset('node_modules/datatables.net-dt/css/jquery.dataTables.css') }}">

@endpush
@section('content')


<div class="">
    <table class="table-dataTable-ranking table">
        <thead>
            <tr>
                <th>username</th>
                <th>Nombre</th>
                <th>Puntos</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>


@endsection
@push('scripts')
<script>
    var usuario = "{{ auth()->user()->username }}";
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/ranking.js') }}"></script>

@endpush