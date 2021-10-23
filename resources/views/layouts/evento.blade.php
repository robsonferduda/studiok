<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Studio K - Sistema de Gerenciamento de Eventos') }}</title>
  <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/font-awsome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/slick/slick.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/slick/slick-theme.css') }}" rel="stylesheet">
  <link href="{{ asset('css/evento.css') }}" rel="stylesheet">
  <link href="{{ asset('images/favicon.png') }}" rel="shortcut icon">
</head>
<body class="body-wrapper">
<nav class="navbar main-nav border-less fixed-top navbar-expand-lg p-0">
  <div class="container-fluid p-0 mb-4 mt-4">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="fa fa-bars"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item dropdown active dropdown-slide">
          <a class="nav-link" href="{{ url('eventos/'.Session::get('evento')->ds_apelido_eve) }}"  data-toggle="dropdown">Início
            <span>/</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('eventos/'.Session::get('evento')->ds_apelido_eve.'/palestrantes') }}">Palestrantes
            <span>/</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('eventos/'.Session::get('evento')->ds_apelido_eve.'/programacao') }}">Programação<span>/</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('eventos/'.Session::get('evento')->ds_apelido_eve.'/stand-virtual') }}">Stand Virtual<span>/</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('cadastrar') }}">Cadastre-se</a>
        </li>
      </ul>
      
      </div>
  </div>
</nav>

@yield('content') 

<footer class="subfooter">
  <div class="container">
    <div class="row">
      <div class="col-md-6 align-self-center">
        <div class="copyright-text">
          <p><a href="#">StudioK</a> &#169; 2021 Todos os direitos reservados</p>
        </div>
      </div>
      <div class="col-md-6">
          <a href="#" class="to-top"><i class="fa fa-angle-up"></i></a>
      </div>
    </div>
  </div>
</footer>
  <script src="{{ asset('plugins/jquery/jquery.js') }}"></script>
  <script src="{{ asset('plugins/popper/popper.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('plugins/smoothscroll/SmoothScroll.min.js') }}"></script>  
  <script src="{{ asset('plugins/isotope/mixitup.min.js') }}"></script>  
  <script src="{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('plugins/slick/slick.min.js') }}"></script>  
  <script src="{{ asset('plugins/syotimer/jquery.syotimer.min.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>