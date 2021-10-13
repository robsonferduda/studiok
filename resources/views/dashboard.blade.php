@extends('layouts.app')
@section('content')
  <div class="row"> 
    @role('administrador')
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
    @endrole
    @role('participante')

    @endrole
  </div>
@endsection