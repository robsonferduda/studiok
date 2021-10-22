@extends('layouts.app')
@section('content')
  @role('administrador')
    <div class="row"> 
          <div class="col-lg-4 col-md-4 col-sm-12">  
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

          <div class="col-lg-4 col-md-4 col-sm-12">
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
          
          <div class="col-lg-4 col-md-4 col-sm-12">
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
        </div>   
        <div class="row">
          <div class="col-md-12">
            
          </div> 
    </div>
  @endrole
  @role('participante')
    <div class="row">
      <h5 class="ml-3">Meus Eventos</h5>
    </div>
    <div class="row">
      @foreach($meus_eventos as $key => $evento)
        <div class="col-md-12 col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-9 col-lg-9">
                  <h4 class="card-title mt-2 ml-2"> {{ $evento->nm_evento_eve }}</h4>
                </div>
                <div class="col-md-3 col-lg-3 text-right">
                  <a href="{{ url('eventos/'.$evento->ds_apelido_eve.'/programacao') }}" target="_BLANK" class="btn btn-round btn-primary mb-2"><i class="fa fa-send mr-1"></i> Ir para o Evento</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endrole
  @role('assistente')
    <div class="row">
      <h5 class="ml-3">Meus Eventos</h5>
    </div>
    <div class="row">
      @foreach($meus_eventos as $key => $evento)
        <div class="col-md-12 col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-9 col-lg-9">
                  <h4 class="card-title mt-2 ml-2"> {{ $evento->nm_evento_eve }}</h4>
                </div>
                <div class="col-md-3 col-lg-3 text-right">
                  <a href="{{ url('programacao',$evento->ds_apelido_eve) }}" class="btn btn-round btn-primary mb-2"><i class="nc-icon nc-calendar-60 mr-1"></i> Ir para Programação</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endrole

  @role('gestor')
    <div class="row">
      <h5 class="ml-3">Meus Eventos</h5>
    </div>
    <div class="row">
      @forelse($meus_eventos as $key => $evento)
        <div class="col-md-12 col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-9 col-lg-9">
                  <h4 class="card-title mt-2 ml-2"> {{ $evento->nm_evento_eve }}</h4>
                </div>
                <div class="col-md-3 col-lg-3 text-right">
                  <a href="{{ url('programacao',$evento->ds_apelido_eve) }}" class="btn btn-round btn-primary mb-2"><i class="nc-icon nc-calendar-60 mr-1"></i> Ir para Programação</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-md-12 col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-9 col-lg-9">
                  <h4 class="card-title mt-2 ml-2"> Nenhum evento alocado</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforelse
    </div>
  @endrole
@endsection