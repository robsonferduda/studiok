@extends('layouts.app')
@section('content')
<div class="col-md-12">
    {!! Form::open(['id' => 'frm_participantes_novo', 'url' => 'participante' ]) !!}
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title"><i class="nc-icon nc-badge"></i> Participantes</h4>
                        <h6 class="card-subtitle mb-2 text-muted">Novo</h6>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('participante') }}" class="btn btn-default pull-right" style="margin-right: 12px;"><i class="fa fa-table"></i> Participantes</a>
                    </div>
                </div>
                @include('layouts.mensagens')
            </div>
            <div class="card-body">
                <div class="row">
                   
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                <a href="{{ url('participante') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
            </div>
        </div>
    {!! Form::close() !!} 
</div> 
@endsection