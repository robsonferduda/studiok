@extends('layouts.evento')
@section('content')
    <div class="col-lg-12 col-md-8 w-100">
        <h2 class="text-white text-center">{{ Session::get('evento')->nm_evento_eve }}</h2>
    </div>
    <div class="col-lg-12 col-md-12 m-auto bg-white rd-12 p-3">
        <div class="text-center">
            <h5 class="mb-1">Contato</h5>
            <h6 class="mb-3"><a class="link-home" href="{{ url('eventos', Session::get('evento')->ds_apelido_eve) }}">Hall de Entrada</a></h6>
        </div>
        <div class="col-12 schedule text-center mb-3">
            <p><i class="fa fa-envelope"></i> comissaocientificaciki@gmail.com</p>
        </div>
    </div>
@endsection