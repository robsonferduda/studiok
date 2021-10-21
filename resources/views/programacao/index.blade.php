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
                    <a href="{{ url('palestrante/create') }}" class="btn btn-info pull-right" style="margin-right: 12px;"><i class="fa fa-plus"></i> Novo Palestrante</a>
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
                            <div class="card-header no-border">
                                <h5 class="card-title">{{ $atividade->nm_atividade_ati }}</h5>
                            </div>
                            <div class="card-body pt-0">
                                <div class="widget-49">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="widget-49-title-wrapper">
                                                <div class="widget-49-date-primary">
                                                    <span class="widget-49-date-day">{{ Carbon\Carbon::parse($atividade->dt_inicio_atividade_ati)->format('d') }}</span>
                                                    <span class="widget-49-date-month">{{ Carbon\Carbon::parse($atividade->dt_inicio_atividade_ati)->format('M') }}</span>
                                                </div>
                                                <div class="widget-49-meeting-info">
                                                    <span class="widget-49-pro-title">{{ $atividade->sala->nm_sala_sal }} </span>
                                                    <span>{{ $atividade->sala->tipo->ds_tipo_sala_tis }}</span>
                                                    <span class="widget-49-meeting-time">{{ Carbon\Carbon::parse($atividade->dt_inicio_atividade_ati)->format('H:i') }} até {{ Carbon\Carbon::parse($atividade->dt_termino_atividade_ati)->format('H:i') }} horas</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            @if(count($atividade->palestrantes)) <h6>Palestrantes</h6> @endif
                                            @foreach($atividade->palestrantes as $key => $palestrante)
                                                {{ $palestrante->pessoa->nm_pessoa_pes }}<br/>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="widget-49-meeting-info mt-3 mb-3">
                                        {{ $atividade->ds_atividade_ati }}
                                    </div>
                                    <div class="widget-49-meeting-action">
                                        @if($atividade->tipo->fl_paralelo)
                                            <a href="{{ url('atividade/atividades-paralelas',$atividade->id_atividade_ati) }}" class="btn btn-sm btn-success"><i class="nc-icon nc-bullet-list-67"></i> Atividades</a>
                                        @endif
                                        <a href="{{ route('atividade.show',$atividade->id_atividade_ati) }}" class="btn btn-sm btn-warning"><i class="fa fa-table"></i> Detalhes</a>
                                        <a href="{{ route('atividade.edit',$atividade->id_atividade_ati) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Editar</a>
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