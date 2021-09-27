@extends('layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="card card-user">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title"><i class="fa fa-graduation-cap"></i> Palestrantes</h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('palestrante') }}" class="btn btn-default pull-right" style="margin-right: 12px;"><i class="fa fa-table"></i> Palestrantes</a>
                        <a href="{{ route('palestrante.edit',$palestrante->id_palestrante_pal) }}" class="btn btn-primary pull-right" style="margin-right: 12px;"><i class="fa fa-edit"></i> Editar</a>                        
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-2 center">
                        @if($palestrante->path_imagem_pal)
                            <img src="{{ url('/storage/profile_pictures/'.$palestrante->path_imagem_pal) }}" />
                        @else
                            <img src="{{ url('img/icon-cam.png') }}" />
                        @endif
                        <h6 class="mt-3">{{ $palestrante->pessoa->nm_pessoa_pes }}</h6>
                    </div>
                    <div class="col-md-10">
                        <p class="mb-1"><strong>Nome: </strong>{{ $palestrante->ds_tratamento_pal }} {{ $palestrante->pessoa->nm_pessoa_pes }}</p>
                        <p class="mb-1"><strong>Empresa: </strong>{{ $palestrante->ds_empresa_pal }}</p>
                        <p class="mb-1"><strong>Cargo: </strong>{{ $palestrante->ds_cargo_pal }}</p>
                        <p class="mb-1"><strong>Email: </strong>{{ $palestrante->pessoa->ds_email_pes }}</p>
                        <p><strong>Biografia: </strong> {{ $palestrante->biografia_pal }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection