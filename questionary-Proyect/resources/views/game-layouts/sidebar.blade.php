<!-- Sidebar para pantallas grandes -->
<div class="sidebar d-none d-lg-block">
  <div class="style-sidebar-game d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <i class="fa-solid fa-bars me-2" style="font-size: 1.5rem;"></i>
      <span class="fs-4">Menú</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="/home" class="nav-link text-white" aria-current="page">
          <i class="fa-solid fa-house me-2"></i> Inicio
        </a>
      </li>
      <li>
        @if(Auth::user() && Auth::user()->rol==1)
      <li>
        <a href="/addQuestion" class="nav-link text-white">
          <i class="fa-solid fa-user-cog me-2"></i> Admin
        </a>
      </li>
      @endif
      </li>
      <li>
        <a href="/ranking" class="nav-link text-white">
          <i class="fa-solid fa-chart-line me-2"></i> Ranking
        </a>
      </li>
      <li>
        <a href="/play" class="nav-link text-white">
          <i class="fa-solid fa-play me-2"></i> Jugar ahora
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <i class="fa-solid fa-user me-2"></i> Perfil
        </a>
      </li>
    </ul>
  </div>
</div>