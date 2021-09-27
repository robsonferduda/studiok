@extends('layouts.app')
@section('content')
<div class="col-md-12">
    {!! Form::open(['id' => 'frm_participantes_import', 'url' => 'participante/importacao', 'files' => true]) !!}
        <div class="card ">
            <div class="card-header ">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title"><i class="nc-icon nc-badge"></i> Participantes</h4>
                        <h6 class="card-subtitle mb-2 text-muted">Importar</h6>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('participante') }}" class="btn btn-default pull-right" style="margin-right: 12px;"><i class="fa fa-table"></i> Participantes</a>
                    </div>
                </div>
                @include('layouts.mensagens')
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Evento</label>
                        <select class="form-control" name="evento" id="evento" aria-label="Selecione um evento">
                            <option value="">Selecione um Evento</option>
                            @foreach($eventos as $evento)
                                <option value="{{ $evento->id_evento_eve }}" {{ (old('evento') == $evento->id_evento_eve) ? 'selected' : '' }}>{{ $evento->nm_evento_eve }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label>Planilha de Dados</label>
                        <div class="input-group mb-3">                            
                            <div class="custom-file">
                                <input class="custom-file-input" type="file" name="arquivo" id="arquivo" />
                                <label class="custom-file-label" for="arquivo">Selecionar Arquivo</label>
                            </div>
                        </div>
                    </div>
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