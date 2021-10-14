@extends('layouts.app')
@section('content')
  @role('administrador')
    <div class="row"> 
          <div class="col-lg-3 col-md-3 col-sm-12">  
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-tv-2 text-warning"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Salas</p>
                      <p class="card-title"><a href="{{ url('sala') }}">{{ $sala->count() }}</a><p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <a href="{{ url('sala/create') }}">
                    Adicionar Sala
                  </a> 
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="fa fa-graduation-cap text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Palestrantes</p>
                      <p class="card-title"><a href="{{ url('palestrante') }}">{{ $palestrante->count() }}</a><p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <a href="{{ url('palestrante/create') }}">                    
                      Adicionar Palestrante
                  </a>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-badge text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Participantes</p>
                      <p class="card-title"><a href="{{ url('participante') }}">{{ $participante->count() }}</a><p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-clock-o"></i>
                  Atualizado em {{ Carbon\Carbon::now()->format('d/m/Y H:i:s') }} 
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-calendar-60 text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Programação</p>
                      <p class="card-title"><a href="{{ url('programacao') }}">{{ $atividade->count() }}</a><p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-calendar-o"></i>
                  Próximo em 20/11/2021 18:00
                </div>
              </div>
            </div>
          </div>  
        </div>   
        <div class="row">
          <div class="col-md-12">
            
          </div> 
    </div>
  @endrole
  @role('participante')
    <div class="row">
      <div class="col-md-3 col-lg-3">
        <h5>Meus Eventos</h5>
        @foreach($meus_eventos as $key => $evento)
          <div class="card card-pricing ">
            <div class="card-header">
              <h6 class="card-category"></h6>
            </div>
            <div class="card-body">
              <div class="card-icon icon-primary ">
                <i class="nc-icon nc-tag-content"></i>
              </div>
              <h4 class="card-title">{{ $evento->nm_evento_eve }}</h4>
            </div>
            <div class="card-footer">
              <a href="{{ url('eventos/seminario-studiok/programacao') }}" class="btn btn-round btn-primary mb-2">Ver Programação</a>
            </div>
          </div>
        @endforeach
      </div>
      <div class="col-md-9 col-lg-9">
        <h5>Agenda</h5>
        <div class="card">
          <div class="card-body">
            @foreach($programacao as $key => $atividade)
              <p>{{ date('d/m/Y H:i', strtotime($atividade->dt_inicio_atividade_ati)) }} - {{ $atividade->sala->nm_sala_sal }} - {{ $atividade->nm_atividade_ati }}</p>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  @endrole
@endsection