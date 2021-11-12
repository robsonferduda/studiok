@extends('layouts.conferencia')
@section('content')
    <div class="col-lg-12 col-md-8">
        <h2 class="text-white text-center">{{ Session::get('evento')->nm_evento_eve }}</h2>
    </div>
    <div class="col-lg-12 col-md-12 m-auto bg-white" style="border-radius: 12px;">
        <h4 class="text-center py-5">Aguarde a publicação dos dados do evento</h4>
    </div>
@endsection