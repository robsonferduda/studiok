@extends('layouts.conferencia')
@section('content')
<div class="col-lg-12 col-md-12 m-auto bg-white p-5" style="border-radius: 12px;">
@role('participante')
    <div class="row">
    <h5 class="ml-3">Meus Eventos</h5>
    </div>
    <div class="row">
    @forelse($meus_eventos as $key => $evento)
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3">                            
                            <a href="{{ url('eventos/seminario-studiok') }}"><img src="img/workshop-egc.jpeg"></a>
                        </div>
                        <div class="col-md-9 col-lg-9">
                            <h4 class="card-title mt-2 ml-2"> {{ $evento->nm_evento_eve }}</h4>
                            <a href="{{ url('eventos/'.$evento->ds_apelido_eve) }}" class="btn btn-round btn-primary mb-2"><i class="nc-icon nc-tag-content mr-1"></i> Acessar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
    <div class="col-md-12 col-lg-12">
        <div class="card">
        <div class="card-body">
            <div class="row">
            <div class="col-md-9 col-lg-9">
                <p class="card-title font-18 mt-2 ml-2">Você não está inscrito em nenhum evento</p>
            </div>
            </div>
        </div>
        </div>
    </div>
    @endforelse
    </div>
    <div class="row">
    <h5 class="ml-3">Eventos Disponíveis</h5>
    </div>
    <div class="row">
    @forelse($eventos as $key => $evento)
        <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
            <div class="row">
                <div class="col-md-9 col-lg-9">
                <h4 class="card-title mt-2 ml-2"> {{ $evento->nm_evento_eve }}</h4>
                </div>
                <div class="col-md-3 col-lg-3 text-right">
                <a href="{{ url('eventos/'.$evento->id_evento_eve.'/inscricao') }}" class="btn btn-round btn-primary mb-2"><i class="fa fa-check mr-1"></i> Inscreva-se</a>
                </div>
            </div>
            </div>
        </div>
        </div>
    @empty 
        <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
            <div class="row">
                <div class="col-md-9 col-lg-9">
                <h4 class="card-title mt-2 ml-2"> Nenhum evento disponível no momento</h4>
                </div>
            </div>
            </div>
        </div>
        </div>
    @endforelse
    </div>
    @endrole
</div>
@endsection