@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            @include('layouts.cabecalho')
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title"><i class="nc-icon nc-calendar-60"></i> Programação</h4>
                </div>
                <div class="col-md-6">
                    <a href="{{ url('atividade/create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Nova Atividade</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.mensagens')
                </div>
            </div>
            <div class="row">
                @foreach($atividades as $atividade)
                    <div class="col-md-12">                
                        <div class="card card-margin" style="border: 1px solid #9e9e9e26;">
                            <div class="card-body pt-3">
                                <div class="widget-49">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="mb-1 font-21">{!! ($atividade->fl_destaque_ati) ? '<i title="Atividade Destaque" class="fa fa-star text-warning font-21"></i>' : '' !!} {{ $atividade->nm_atividade_ati }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Local: </strong> {{ ($atividade->sala) ? $atividade->sala->nm_sala_sal : 'Não requerido' }}</p>
                                            <p class="mb-1"><strong>Tipo de Atividade: </strong> {{ $atividade->tipo->ds_tipo_atividade_tia }}</p>
                                            <p class="mb-1"><strong>Data/Hora Início: </strong> {{ ($atividade->dt_inicio_atividade_ati) ? Carbon\Carbon::parse($atividade->dt_inicio_atividade_ati)->format('d/m/Y H:i') : 'Não informada' }}</p>
                                            <p class="mb-1"><strong>Data/Hora Término: </strong> {{ ($atividade->dt_termino_atividade_ati) ? Carbon\Carbon::parse($atividade->dt_termino_atividade_ati)->format('d/m/Y H:i') : 'Não informada' }}</p>
                                            <p><strong>Resumo: </strong> {{ ($atividade->ds_atividade_ati) ? $atividade->ds_atividade_ati : 'Nenhum resumo cadastrado'}}</p>
                                            {!! ($atividade->fl_ativa_ati) ? '<span class="badge badge-pill badge-success">ATIVO</span>' : '<span class="badge badge-pill badge-danger">INATIVO</span>' !!}
                                        </div>
                                        <div class="col-md-6">
                                            @if(count($atividade->palestrantes)) <h6>Palestrantes</h6> @endif
                                            @foreach($atividade->palestrantes as $key => $palestrante)
                                                {{ $palestrante->pessoa->nm_pessoa_pes }}<br/>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="widget-49-meeting-action">
                                        @if($atividade->tipo->fl_paralelo)
                                            <a href="{{ url('atividade/atividades-paralelas',$atividade->id_atividade_ati) }}" class="btn btn-sm btn-success"><i class="nc-icon nc-bullet-list-67"></i> Atividades</a>
                                        @endif
                                        <form class="form-delete" style="display: inline;" action="{{ route('atividade.destroy',$atividade->id_atividade_ati) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button title="Excluir" type="submit" class="btn btn-sm btn-danger button-remove" title="Delete">
                                                <i class="fa fa-times"></i> Excluir
                                            </button>
                                        </form>
                                        <a href="{{ route('atividade.edit',$atividade->id_atividade_ati) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Editar</a>
                                        <a href="{{ route('atividade.show',$atividade->id_atividade_ati) }}" class="btn btn-sm btn-warning"><i class="fa fa-table"></i> Detalhes</a>
                                    </div>
                                </div>
                            </div>                             
                        </div>    
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div> 
@endsection