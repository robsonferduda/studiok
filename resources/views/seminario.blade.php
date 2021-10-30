@extends('layouts.conferencia')
@section('content')
    <div class="col-lg-12 col-md-8">
        <h2 class="text-white text-center mt-2">12º Workshop EGC</h2>
    </div>
    <div class="col-lg-8 col-md-8 m-auto">
        <div class="row">
            <div class="col-lg-6 col-md-6 ml-auto mb-4">
                <img src="{{ url('img/workshop-egc.jpeg') }}">
            </div>
            <div class="col-lg-6 col-md-6 ml-auto">
                <p class="menu-evento"><i class="fa fa-calendar ml-2"></i> <a href="{{ url('eventos/'.Session::get('evento')->ds_apelido_eve.'/programacao') }}">Programação</a></p>
                <p class="menu-evento"><i class="fa fa-envelope ml-2"></i> Contato</p>
                <p class="menu-evento"><i class="fa fa-desktop ml-2"></i> Auditório</p>
                <p class="menu-evento"><i class="fa fa-desktop ml-2"></i> Sala Engenharia</p>
                <p class="menu-evento"><i class="fa fa-desktop ml-2"></i> Sala Gestão</p>
                <p class="menu-evento"><i class="fa fa-desktop ml-2"></i> Sala Mídia</p>
            </div>
        </div>
    </div>
@endsection