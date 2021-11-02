@extends('layouts.evento')
@section('content')
    <div class="col-lg-12 col-md-8 w-100">
        <h2 class="text-white text-center">12º Workshop EGC</h2>
    </div>
    <div class="col-lg-12 col-md-12 m-auto bg-white">
        <div class="row">
            <div class="col-12 schedule">
                <h4 class="text-center">Contato</h4>
            </div>
            <div class="col-12 schedule">
                <div class="download-button text-center">
                    <a href="{{ url('eventos', Session::get('evento')->ds_apelido_eve) }}" class="btn btn-main-md">Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection