@extends('layouts.app')
@section('content')
<div class="col-md-12">
    {!! Form::open(['id' => 'frm_evento_editar', 'url' => ['evento', $evento->id_evento_eve], 'method' => 'patch']) !!}
        <div class="card ">
            <div class="card-header ">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title"><i class="nc-icon nc-tag-content"></i> Eventos</h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('evento') }}" class="btn btn-info pull-right" style="margin-right: 12px;"><i class="fa fa-table"></i> Eventos</a>
                    </div>
                </div>
                @include('layouts.mensagens')
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group has-label">
                            <label for="nm_evento_eve">Nome do Evento <span class="text-danger">Obrigatório</span></label>
                            <input class="form-control" name="nm_evento_eve" id="nm_evento_eve" type="text" value="{{ $evento->nm_evento_eve }}" required="true" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dt_inicio_eve">Data Inicial <span class="text-primary">(dd/mm/yyyy)</span></label>
                            <input class="form-control" name="dt_inicio_eve" id="dt_inicio_eve" value="{{ ($evento->dt_inicio_eve) ? date('d/m/Y', strtotime($evento->dt_inicio_eve)) : '' }}" type="name" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dt_final_eve">Data Final <span class="text-primary">(dd/mm/yyyy)</span></label>
                            <input class="form-control" name="dt_fim_eve" id="dt_fim_eve" value="{{ ($evento->dt_inicio_eve) ? date('d/m/Y', strtotime($evento->dt_fim_eve)) : '' }}" type="name" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                <a href="{{ url('evento') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
            </div>
        </div>
    {!! Form::close() !!} 
</div> 
@endsection