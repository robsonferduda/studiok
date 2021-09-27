@extends('layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="card card-user">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title"><i class="nc-icon nc-tag-content"></i> Detalhes do Evento</h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('evento') }}" class="btn btn-info pull-right" style="margin-right: 12px;"><i class="fa fa-table"></i> Eventos</a>
                        <a href="{{ route('evento.edit',$evento->id_evento_eve) }}" class="btn btn-primary pull-right" style="margin-right: 12px;"><i class="fa fa-edit"></i> Editar</a>                        
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-12">
                        <p class="mb-1"><strong>Nome: </strong>{{ $evento->nm_evento_eve }}</p>
                        <p class="mb-1"><strong>Data de Início: </strong>{{ date('d/m/Y', strtotime($evento->dt_inicio_eve)) }}</p>
                        <p class="mb-1"><strong>Data de Término: </strong>{{ date('d/m/Y', strtotime($evento->dt_fim_eve)) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection