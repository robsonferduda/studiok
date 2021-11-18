@extends('layouts.conferencia')
@section('content')
    <div class="col-lg-12 col-md-8">
        <h2 class="text-white text-center">{{ Session::get('evento')->nm_evento_eve }} - Hall de Entrada</h2>
    </div>
    <div class="col-lg-8 col-md-8 m-auto">
        <div class="row">
            <div class="col-lg-6 col-md-6 ml-auto mb-4">
                <img src="{{ url('img/eventos/ciki_2021.jpeg') }}">
            </div>
            <div class="col-lg-6 col-md-6 ml-auto box-programacao">
                <p class="menu-evento"><i class="fa fa-calendar ml-2"></i><a href="{{ url('eventos/'.Session::get('evento')->ds_apelido_eve.'/programacao') }}"> Programação</a></p>
                <p class="menu-evento"><i class="fa fa-television ml-2"></i><a href="{{ url('eventos/'.Session::get('evento')->ds_apelido_eve.'/salas') }}"> Salas</a></p>
                <p class="menu-evento"><i class="fa fa-comment ml-2"></i><a href="{{ url('eventos/'.Session::get('evento')->ds_apelido_eve.'/apresentacoes') }}"> Apresentações nas Salas</a></p>
                <p class="menu-evento"><i class="fa fa-video ml-2"></i><a href="{{ url('eventos/'.Session::get('evento')->ds_apelido_eve.'/zoom') }}"> Endereços Zoom</a></p>
                <p class="menu-evento"><i class="fa fa-group ml-2"></i><a href="{{ url('eventos/'.Session::get('evento')->ds_apelido_eve.'/conferencistas') }}"> Conferencistas</a></p>
                <p class="menu-evento"><i class="fa fa-envelope ml-2"></i><a href="{{ url('eventos/'.Session::get('evento')->ds_apelido_eve.'/contato') }}"> Contato</a></p>

                <div class="col-lg-12 col-md-12 ml-auto mb-4 pb-3 bg-white rd-12 text-center">
                    <h5 class="mt-3 mb-3 pt-3">Acesso ao Público</h5>
                    <p>Todo o conteúdo do Ciki pode ser assitido de forma aberta clicando no endereço abaixo.</p>
                    <a href="https://www.youtube.com/playlist?list=PLlrwBGCrNusnJJhVTxRFaNnK2roiL8kc7" target="_BLANK"><i class="nc-icon nc-tv-2"></i> Clique aqui</a>
                </div>
            </div>
        </div>
    </div>
@endsection