<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Questionary')</title>

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Hojas de estilo comunes -->
    <link rel="stylesheet" href="{{ asset('css/style-game.css') }}">

    <!-- Librerías externas -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Soporte para estilos específicos -->
</head>

<body class="body-style font-sans antialiased">
    @include('game-layouts.nav-game')
    <div class="contenedor-flex">
        <div class="contenedor__sidebar">
            @include('game-layouts.sidebar')
        </div>
        <div class="contenedor__principal bg-gray-100 dark:bg-gray-900 flex">
            <div class="flex-1 ml-64">
                <main class="py-4">
                    @yield('content')
                </main>
            </div>

        </div>
    </div>

    <div class="footer-style">
        @include('game-layouts.footer')
    </div>

    <!-- Scripts comunes -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    @stack('scripts')
    @yield('scripts') 
    <style>
  .contenedor-flex {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 560px;
  }
  body{
    background: linear-gradient(
        rgba(0, 0, 0, 0.5), 
        rgba(0, 0, 0, 0.5)
      ),
      url('{{ asset('img/logo.png') }}'); 
    background-size: cover; 
    background-position: center; 
  }
</style>
</body>
</html>

