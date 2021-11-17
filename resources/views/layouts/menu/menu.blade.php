<ul class="navbar-nav">
    <li class="nav-item ">
      <a href="{{ url('/') }}" class="nav-link">
        <i class="nc-icon nc-shop"></i>
        Início
      </a>
    </li>
    @if(Auth::user())
      <li class="nav-item ">
        <a href="{{ url('meus-eventos') }}" class="nav-link text-none">
          <i class="nc-icon nc-tag-content"></i>
          Meus Eventos
        </a>
      </li>
      <li class="nav-item ">
        <a href="{{ url('perfil') }}" class="nav-link text-none">
          <i class="nc-icon nc-circle-10"></i>
          {{ Auth::user()->name }}
        </a>
      </li>
      @if(Auth::user()->hasRole('administrador'))
        <li class="nav-item ">
          <a href="{{ url('dashboard') }}" class="nav-link text-none">
            <i class="nc-icon nc-laptop"></i>
            <p>Painel Administrativo</p>
          </a>
        </li>
      @endif
      <li class="nav-item ">
        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"  class="nav-link text-none">
          <i class="nc-icon nc-button-power"></i>
          <p>Sair</p>
        </a>
      </li>
    @else
      <li class="nav-item ">
        <a href="{{ url('cadastrar') }}" class="nav-link text-none">
          <i class="nc-icon nc-circle-10"></i>
          Criar Conta
        </a>
      </li>
      <li class="nav-item ">
        <a href="{{ url('login') }}" class="nav-link">
          <i class="nc-icon nc-lock-circle-open"></i>
          Acesse sua conta
        </a>
      </li>
    @endif
  </ul>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
  </form>