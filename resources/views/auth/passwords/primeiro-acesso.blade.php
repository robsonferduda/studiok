@extends('layouts.guest')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5>Primeiro Acesso</h5>
                        <p>Caso você não tenha feito sua inscrição pelo nosso formulário de cadastro, precisará criar uma senha de acesso ao sistema.</p>
                        <p>Mas fique tranquilo, esse procedimento é muito simples. Informe no campo abaixo o email que você utilizou na inscrição feita em outra plataforma.</p>
                        <p>Caso o endereço de email informado já esteja em nossa base de dados, você receberá uma mensagem com as instruções de criação de uma senha de acesso.</p>
                        
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {!! session('status') !!}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-group mt-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="nc-icon nc-email-85"></i>
                                            </span>
                                        </div>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 px-0">
                                    <div class="input-group">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-check"></i> {{ __('Requisitar Senha') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection