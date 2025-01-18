<nav class="navbar navbar-expand-lg  align-items-center">
  <div class="div-logo align-items-center">
    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="style-logo me-2">
  </div>

  <div class="contenedor-pantallas-cichas">
    <div class="center-title">
      <img src="{{ asset('img/Quiz.png') }}" alt="Logo-questionary" class="questioanry-logo me-2">
    </div>
    <!-- Botón Hamburguesa -->
    <div class="hamburguesa">
      <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</nav>

<!-- Sidebar Offcanvas -->
<div class=" offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="sidebarOffcanvasLabel">Sidebar</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="#" class="nav-link active" aria-current="page">
          <svg class="bi me-2" width="16" height="16">
            <use xlink:href="#home"></use>
          </svg>
          inicio
        </a>
      </li>
      <li>
        @if(Auth::user() && Auth::user()->rol==1)
      <li>
        <a href="#" class="nav-link text-white">
          <i class="fa-solid fa-user-cog me-2"></i> Admin
        </a>
      </li>
      @endif
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16">
            <use xlink:href="/rankin"></use>
          </svg>
          Ranking
        </a>
      </li>
      <li>
        <div class="text-center mt-5">
          <a href="/play" class="btn btn-primary btn-lg">
            <i class="fa-solid fa-play me-2"></i> Jugar ahora
          </a>
        </div>
      </li>
    </ul>
  </div>
</div>