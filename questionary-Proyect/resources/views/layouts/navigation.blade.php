@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('node_modules/datatables.net-dt/css/jquery.dataTables.css') }}">
@endpush


<div class="contenedor-nav">
  <div>
    <nav class="estilo-nav navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <img class="logo-img" src="{{ asset('img/logo.png') }}" alt="">
        <div class="ocultar">
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link text-white px-3 py-2 rounded hover-bg-light" href="/addQuestion">Pregunta - Genero</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white px-3 py-2 rounded hover-bg-light" href="/listQuestion">Lista de Preguntas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white px-3 py-2 rounded hover-bg-light" href="#">Lista de Usuarios</a>
            </li>
          </ul>

        </div>
        <div class="perfil-div collapse navbar-collapse d-flex justify-content-center" id="navbarSupportedContent">
          <div class="perfil dropdown">
            @if(Auth::user()->profile_picture)
            <a class="nav-link text-white px-3 py-2 rounded hover-bg-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="rounded-circle" width="50" height="50">
            </a>
            @else
            <a class="nav-link text-white px-3 py-2 rounded hover-bg-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span>{{ Auth::user()->username }}</span>
            </a>
            @endif

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/profile">Perfil</a></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault(); 
            this.closest('form').submit();">
                    {{ __('Cerrar sesión') }}
                  </x-responsive-nav-link>
                </form>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </nav>
  </div>
</div>
<style>
  .estilo-nav {
    background-color: rgb(31 41 55 / var(--tw-bg-opacity, 1)) !important;
  }

  .navbar-nav .nav-link {
    color: #f8f9fa;
    font-size: 16px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: background-color 0.3s ease;
  }

  .navbar-nav .nav-link:hover {
    background-color: #495057;
    color: #fff;
    text-decoration: none;
  }

  .nav-link:hover {
    background-color: #495057 !important;
  }

  .navbar-collapse {
    padding-left: 15px;
  }

  .navbar-nav {
    display: flex;
    gap: 15px;
    justify-content: center;
  }

  .navbar-nav .nav-item {
    border-bottom: 2px solid transparent;
    transition: border-color 0.3s ease;
  }

  .navbar-nav .nav-item:hover {
    border-color: #f8f9fa;
  }

  .perfil .nav-link {
    padding-right: 30px !important;
    color: #f8f9fa;
    font-size: 16px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: background-color 0.3s ease;
  }

  .dropdown-menu[data-bs-popper] {}

  .perfil .nav-link:hover {
    background-color: #495057;
    color: #fff;
    text-decoration: none;
  }

  .dropdown-menu {
    background-color: rgb(31 41 55);
    border: none;
    min-width: 150px;
  }

  .dropdown-item {
    color: #f8f9fa;
    font-size: 14px;
    padding: 10px 20px;
    text-transform: none;
  }

  .dropdown-item:hover {
    background-color: #495057;
    color: #fff;
  }


  @media (max-width: 992px) {
    .navbar-nav {
      display: none;
    }
  }

  .perfil .dropdown-menu-end {
    right: 0;
  }

  .ocultar {
    display: flex;
    justify-content: center;
    width: 100%;
  }
</style>