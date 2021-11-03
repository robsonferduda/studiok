<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link href="images/favicon.png" rel="shortcut icon">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>{{ config('app.name', 'Studio K Sistema de Gerenciamento de Eventos') }}</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/paper-dashboard.css?v=2.0.1') }}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('demo/demo.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/schedule.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/croppie.min.css') }}" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="white" data-active-color="danger">
            <div class="logo">
                <a style="padding-left: 8px;" href="{{ url('perfil') }}" class="simple-text logo-normal">
                  <i class="fa fa-user"></i> {{ (Auth::user()) ? explode(" ", Auth::user()->name)[0] : '' }}
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                <li class="{{ (Session::has('url') and Session::get('url') == 'home') ? 'active' : '' }}">
                    <a href="{{ url('home') }}">
                    <i class="nc-icon nc-chart-pie-36"></i>
                    <p>DASHBOARD</p>
                    </a>
                </li>

                @role('administrador')
                  <li class="{{ (Session::has('url') and Session::get('url') == 'evento') ? 'active' : '' }}">
                      <a href="{{ url('evento') }}">
                      <i class="nc-icon nc-tag-content"></i>
                      <p>Eventos</p>
                      </a>
                  </li>
                @endrole
                                
                @if(Auth::user()->hasRole(['administrador', 'palestrante']))
                  @if(Session::has('meus_eventos'))
                    @foreach(Session::get('meus_eventos') as $evento)

                    @role('administrador') 

                      <li class="{{ (Session::has('edicao') and Session::get('edicao') == $evento->ds_apelido_eve) ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#menu_{{ $evento->id_evento_eve }}" class="{{ (Session::get('edicao') and Session::get('edicao') == $evento->ds_apelido_eve) ? '' : 'collapsed' }}" aria-expanded="{{ (Session::get('edicao') and Session::get('edicao') == $evento->ds_apelido_eve) ? 'true' : 'false' }}">
                          <i class="nc-icon nc-settings-gear-65"></i>
                          <p>
                            {{ $evento->ds_apelido_eve }} <b class="caret"></b>
                          </p>
                        </a>
                        <div id="menu_{{ $evento->id_evento_eve }}" class="collapse {{ (Session::get('edicao') and Session::get('edicao') == $evento->ds_apelido_eve) ? 'show' : '' }}" style="">
                          <ul class="nav ml-4">
                            <li>
                              <a target="BLANK" href="{{ url('eventos', $evento->ds_apelido_eve) }}">
                                <span class="sidebar-normal"> <i class="nc-icon nc-world-2"></i> Página</span>
                              </a>
                            </li>
                            <li class="{{ (Session::get('url') and Session::get('url') == 'sala' and Session::get('edicao') == $evento->ds_apelido_eve) ? 'active' : '' }}">
                              <a href="{{ url('salas', $evento->ds_apelido_eve) }}">
                                <span class="sidebar-normal"> <i class="nc-icon nc-tv-2"></i> Salas </span>
                              </a>
                            </li>
                            <li class="{{ (Session::get('url') and Session::get('url') == 'palestrante' and Session::get('edicao') == $evento->ds_apelido_eve) ? 'active' : '' }}">
                              <a href="{{ url('palestrantes', $evento->ds_apelido_eve) }}">
                                <span class="sidebar-normal"> <i class="fa fa-graduation-cap"></i> Palestrantes </span>
                              </a>
                            </li>
                            
                            @permission('participantes')
                              <li class="{{ (Session::get('url') and Session::get('url') == 'participante' and Session::get('edicao') == $evento->ds_apelido_eve) ? 'active' : '' }}">
                                <a href="{{ url('participantes', $evento->ds_apelido_eve) }}">
                                  <span class="sidebar-normal"> <i class="nc-icon nc-badge"></i> Participantes </span>
                                </a>
                              </li>
                            @endpermission
                            <li class="{{ (Session::get('url') and Session::get('url') == 'programacao' and Session::get('edicao') == $evento->ds_apelido_eve) ? 'active' : '' }}">
                              <a href="{{ url('programacao', $evento->ds_apelido_eve) }}">
                                <span class="sidebar-normal"> <i class="nc-icon nc-calendar-60"></i> Programação </span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </li>

                    @endrole 

                    @role('palestrante') 
                      <li class="{{ (Session::has('edicao') and Session::get('edicao') == $evento->ds_apelido_eve) ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#menu_{{ $evento->id_evento_eve }}" class="{{ (Session::get('edicao') and Session::get('edicao') == $evento->ds_apelido_eve) ? '' : 'collapsed' }}" aria-expanded="{{ (Session::get('edicao') and Session::get('edicao') == $evento->ds_apelido_eve) ? 'true' : 'false' }}">
                          <i class="nc-icon nc-settings-gear-65"></i>
                          <p>
                            {{ $evento->ds_apelido_eve }} <b class="caret"></b>
                          </p>
                        </a>
                        <div id="menu_{{ $evento->id_evento_eve }}" class="collapse {{ (Session::get('edicao') and Session::get('edicao') == $evento->ds_apelido_eve) ? 'show' : '' }}" style="">
                          <ul class="nav ml-4">
                            <li>
                              <a target="BLANK" href="{{ url('eventos', $evento->ds_apelido_eve) }}">
                                <span class="sidebar-normal"> <i class="nc-icon nc-world-2"></i> Página</span>
                              </a>
                            </li>
                            <li class="{{ (Session::get('url') and Session::get('url') == 'programacao' and Session::get('edicao') == $evento->ds_apelido_eve) ? 'active' : '' }}">
                              <a href="{{ url('programacao', $evento->ds_apelido_eve) }}">
                                <span class="sidebar-normal"> <i class="nc-icon nc-calendar-60"></i> Minhas Atividades </span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </li>

                    @endrole 
                    
                    @endforeach

                    @endif
                  @endif
                <hr/>

                @role('administrador')               
                  
                <li class="{{ (Session::has('url') and Session::get('url') == 'auditoria') ? 'active' : '' }}">
                  <a href="{{ url('auditoria') }}">
                    <i class="fa fa-shield"></i>
                  <p>Autidoria</p>
                  </a>
              </li>

                <li class="{{ (Session::has('url') and Session::get('url') == 'perfis') ? 'active' : '' }}">
                    <a href="{{ url('perfis') }}">
                    <i class="fa fa-group"></i>
                    <p>Perfis</p>
                    </a>
                </li>
                <li class="{{ (Session::has('url') and Session::get('url') == 'permissoes') ? 'active' : '' }}">
                    <a href="{{ url('permissoes') }}">
                    <i class="nc-icon nc-lock-circle-open"></i>
                    <p>Permissões</p>
                    </a>
                </li>
                <li class="{{ (Session::has('url') and Session::get('url') == 'usuarios') ? 'active' : '' }}">
                    <a href="{{ url('usuarios') }}">
                    <i class="nc-icon nc-circle-10"></i>
                    <p>Usuários</p>
                    </a>
                </li>  
                @endrole               
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                      <i class="nc-icon nc-button-power"></i>
                      <p>Sair</p>
                    </a>
                </li>
              </ul>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
        </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand upper" href="{{ url('dashboard') }}">Sistema de Gerenciamento de Eventos</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  <i class="fa fa-sign-out"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">          
        @yield('content')          
      </div>

      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            
            <div class="credits ml-auto">
              <span class="copyright" data-host="{{ env('PASTA_URL') }}">
                © <script>
                  document.write(new Date().getFullYear())
                </script> - Sistema de Gerenciamento de Eventos
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/core/moment.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
 
  <!-- Chart JS -->
  <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('js/plugins/bootstrap-notify.js') }}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
 
  <script src="{{ asset('js/paper-dashboard.min.js?v=2.0.1') }}" type="text/javascript"></script>
  <script src="{{ asset('js/plugins/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/plugins/bootstrap-datetimepicker.js') }}"></script>
  <script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('js/sweetalert2.js') }}"></script>
  <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
  <script src="{{ asset('demo/demo.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}"></script>
  <script src="{{ asset('js/croppie.min.js') }}"></script>
  <script src="{{ asset('js/upload-image.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
  
  <script>
    function setFormValidation(id) {
      $(id).validate({
        highlight: function(element) {
          $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
          $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
        },
        success: function(element) {
          $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
          $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
        },
        errorPlacement: function(error, element) {
          $(element).closest('.form-group').append(error);
        },
      });
    }

    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      //demo.initChartsPages();
      demo.initDateTimePicker();
      setFormValidation('#RegisterValidation');
    });
  </script>
  <script>
    $(document).ready(function() {

      $('.select2').select2();

      $("#id_tipo_participacao_tip").change(function(){
        let valor = $('#id_tipo_participacao_tip option:selected').val(); 
        let texto = $('#id_tipo_participacao_tip option:selected').text(); 
        if(valor != 0)
          $("#tipo_participacao").html(texto);
      });

      $("#total_horas_cer").keyup(function(){
        let valor = $(this).val();

        if(valor != ''){
          if(valor > 0)
            $(".carga_horaria").css('display','block');
          else
            $(".carga_horaria").css('display','none');
          $("#carga_horaria").html(valor);
        }else{
          $(".carga_horaria").css('display','none');
        }
    
      });

      $("#ds_conteudo_cer").keyup(function(){
        let texto = $(this).val();

        if(texto != '')
          $("#conteudo").html(texto);
      });

      $("#complemento_cer").keyup(function(){
        let texto = $(this).val();

        if(texto != '')
          $("#complemento").html(texto);
      });

      $('#arquivo').on('change',function(){
        var fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);
      });
      
      $('#datatable').DataTable({
        "pagingType": "full_numbers",
        
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Filtrar",
        }

      });

      var table = $('#datatable').DataTable();

      // Edit record
      table.on('click', '.edit', function() {
        $tr = $(this).closest('tr');

        var data = table.row($tr).data();
        alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
      });

      // Delete a record
      table.on('click', '.remove', function(e) {
        $tr = $(this).closest('tr');
        table.row($tr).remove().draw();
        e.preventDefault();
      });

      //Like record
      table.on('click', '.like', function() {
        alert('You clicked on Like button');
      });
    });
  </script>
</body>

</html>