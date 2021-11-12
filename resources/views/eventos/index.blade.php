@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title"><i class="nc-icon nc-tag-content"></i> Eventos</h4>
                </div>
                <div class="col-md-6">
                    
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.mensagens')
                </div>
            </div>
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Início</th>
                        <th>Término</th>
                        <th>Evento</th>
                        <th>Nome Curto</th>  
                        <th class="text-center">Situação</th>                     
                        <th class="disabled-sorting text-center">Ações</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Início</th>
                        <th>Término</th>
                        <th>Evento</th>
                        <th>Nome Curto</th> 
                        <th class="text-center">Situação</th>                        
                        <th class="disabled-sorting text-center">Ações</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($eventos as $e)
                        <tr>
                            <td>{!! ($e->dt_inicio_eve) ? date('d/m/Y', strtotime($e->dt_inicio_eve)) : 'Não informado' !!}</td>
                            <td>{!! ($e->dt_fim_eve) ? date('d/m/Y', strtotime($e->dt_fim_eve)) : 'Não informado' !!}</td>
                            <td>{{ $e->nm_evento_eve }}</td>
                            <td>{{ $e->ds_apelido_eve }}</td>
                            <td class="text-center">
                                @if($e->fl_publicado_eve == 'S')
                                    <span class="badge badge-success">PUBLICADO</span>
                                @else
                                    <span class="badge badge-danger">RASCUNHO</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ url('evento/'.$e->id_evento_eve) }}" class="btn btn-warning btn-link btn-icon"><i class="nc-icon nc-tag-content font-25"></i></a>
                                <a href="{{ route('evento.edit',$e->id_evento_eve) }}" class="btn btn-primary btn-link btn-icon"><i class="fa fa-edit fa-2x"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> 
@endsection