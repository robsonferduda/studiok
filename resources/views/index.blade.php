@extends('layouts.guest')
@section('content')

<div class="container">
          <div class="row">
            <div class="col-lg-5 col-md-5 ml-auto">
              <div class="info-area info-horizontal mt-5">
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
                <div class="card-header">
                 
                  <img src="images/favicon.png">
                  <h4 class="card-title mt-2"> Cadastre-se Aqui</h4>
                  
                </div>
                <div class="card-body ">
                  @include('layouts.mensagens')
                  {!! Form::open(['id' => 'frm_participante_novo', 'url' => 'participante/cadastro' ]) !!}
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="nc-icon nc-single-02"></i>
                        </span>
                      </div>
                      <input type="text" name="name" class="form-control" placeholder="Nome">
                    </div>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="nc-icon nc-email-85"></i>
                        </span>
                      </div>
                      <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="nc-icon nc-key-25"></i>
                        </span>
                      </div>
                      <input type="password" name="password" class="form-control" placeholder="Senha">
                    </div>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="nc-icon nc-key-25"></i>
                        </span>
                      </div>
                      <input type="password" name="password_confirm" class="form-control" placeholder="Repita a Senha">
                    </div>
                    
                    <button type="submit" class="btn btn-info btn-round"><i class="nc-icon nc-check-2"></i> Cadastrar</button>
                    {!! Form::close() !!} 
                </div>
                <hr/>
                <div class="card-footer mt-0">
                  <h6><a class="btn-link mb-3" href="{{ route('login') }}">
                    <span class="forget-password">{{ __('Acessar o sistema') }}</span>
                  </a></h6>
                  <a class="btn-link mb-1" href="{{ route('password.request') }}">
                    <span class="forget-password">{{ __('esqueci minha senha') }}</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection