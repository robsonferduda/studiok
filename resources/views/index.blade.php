@extends('layouts.guest')
@section('content')

          <div class="row">
            <div class="col-lg-5 col-md-5 ml-auto mt-5">
              <div class="info-area info-horizontal">
                <div class="icon icon-primary">
                  <i class="nc-icon nc-tv-2"></i>
                </div>
                <div class="description">
                  <h5 class="info-title">Palestras</h5>
                  <p class="description">
                    Nossos eventos online possuem transmissão ao vivo, onde é possível acompanhar 
                    as palestras e interagir com os palestrantes por meio do chat disponível em 
                    cada sala de transmissão.
                  </p>
                </div>
              </div>
              <div class="info-area info-horizontal">
                <div class="icon icon-primary">
                <i class="nc-icon nc-calendar-60"></i>
                </div>
                <div class="description">
                  <h5 class="info-title">Programação</h5>
                  <p class="description">
                    Acompanhe a programação detalhada do evento para saber dia e horário de cada palestra.
                  </p>
                </div>
              </div>
              <div class="info-area info-horizontal">
                <div class="icon icon-info">
                <i class="nc-icon nc-lock-circle-open"></i>
                </div>
                <div class="description">
                  <h5 class="info-title">Área do Participante</h5>
                  <p class="description">
                    Faça seu cadastro para inscrever-se nos eventos, acompanhar a programação e emitir seus certificados.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 mr-auto">
              <div class="card card-signup text-center">
        
                <div class="card-body ">
                  <h5>Próximos Eventos</h5>
                  <a href="{{ url('eventos/seminario-studiok') }}"><img src="img/workshop-egc.jpeg"></a>
                </div>
                <hr/>
                <div class="card-footer mt-0">
                  <a class="btn-link mb-1" href="{{ url('cadastrar') }}">
                    <span class="forget-password">Cadastre-se Aqui</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        
@endsection