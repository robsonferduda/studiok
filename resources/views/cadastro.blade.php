@extends('layouts.guest')
@section('content')

          <div class="row mb-3">
            <div class="col-lg-4 col-md-6 ml-auto mr-auto mt-5">
              <div class="card card-signup text-center">
                <div class="card-header">
                 
                  <img class="mt-3" src="images/favicon.png">
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
                    
                    <button type="submit" class="btn btn-info btn-round mb-4"><i class="nc-icon nc-check-2"></i> Cadastrar</button>
                    {!! Form::close() !!} 
                </div>
              </div>
            </div>
          </div>
        
@endsection