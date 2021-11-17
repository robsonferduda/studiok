@extends('layouts.evento')
@section('content')
    <div class="col-lg-12 col-md-8 w-100">
        <h2 class="text-white text-center">{{ Session::get('evento')->nm_evento_eve }} - Conferencistas</h2>
    </div>
    <div class="col-lg-12 col-md-12 m-auto bg-white rd-12">
        <div class="col-12 schedule text-center">
            <div class="download-button text-center mb-1">
                @if(Auth::user()->hasRole(['administrador']))
                    @if(Session::get('evento')->fl_publicado_eve)
                        <a href="{{ url('eventos', Session::get('evento')->ds_apelido_eve) }}" class="btn btn-main-md mt-0">Hall de Entrada</a>
                    @else
                        <a href="{{ url('temporario', Session::get('evento')->ds_apelido_eve) }}" class="btn btn-main-md mt-0">Hall de Entrada</a>
                    @endif
                @else
                    <a href="{{ url('eventos', Session::get('evento')->ds_apelido_eve) }}" class="btn btn-main-md mt-0">Hall de Entrada</a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 ml-auto mb-3">
                @forelse($conferencistas as $key => $conferencista)
                    <div class="row mt-3 mb-3 hover-overlay">
                        <div class="col-md-1">
                            @if($conferencista->path_imagem_pal)
                                <img class="mt-2" src="{{ url('/profile_pictures/'.$conferencista->path_imagem_pal) }}" />
                            @else
                                <img src="{{ url('img/icon-cam.png') }}" />
                            @endif
                        </div>
                        <div class="col-md-10">
                            <p class="mb-1"><strong>{{ $conferencista->ds_tratamento_pal }} {{ $conferencista->pessoa->nm_pessoa_pes }}</strong></p>
                            <p class="mb-1">{{ $conferencista->ds_empresa_pal }}</p>
                            <p class="mb-1">{{ $conferencista->ds_cargo_pal }}</p>
                        </div>
                    </div> 
                @empty
                    <h4 class="text-center">Nenhum conferencista cadastrado</h4>      
                @endforelse
            </div>
        </div>
    </div>
@endsection