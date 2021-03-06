@extends('layouts.guest')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5>Primeiro Acesso</h5>
                        <p>Caso você não tenha feito sua inscrição por esta plataforma, precisará criar uma senha de acesso ao sistema.</p>
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
                                    <div class="input-group mt-2 is-invalid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text @error('email') border-red @enderror">
                                                <i class="nc-icon nc-email-85"></i>
                                            </span>
                                        </div>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-group mt-0">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 8px;">
                                            <i class="fa fa-check"></i> {{ __('Requisitar Senha') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 px-2 mb-2 text-center">
                                    @error('email')
                                        <span class="text-red">
                                            <strong>{!! $message !!}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection