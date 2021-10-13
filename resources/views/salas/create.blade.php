@extends('layouts.app')
@section('content')
<div class="col-md-12">
    {!! Form::open(['id' => 'frm_sala_novo', 'url' => 'sala' ]) !!}
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title"><i class="nc-icon nc-tv-2"></i> Salas</h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('sala') }}" class="btn btn-info pull-right" style="margin-right: 12px;"><i class="fa fa-table"></i> Salas</a>
                    </div>
                </div>
                @include('layouts.mensagens')
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="nm_sala_sal" id="nm_sala_sal" placeholder="Nome" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipo</label>
                            <select class="form-control" name="id_tipo_sala_tis">
                                <option value="">Selecione um tipo</option>
                                @foreach($tipos as $tipo)
                                    <option value="{{ $tipo->id_tipo_sala_tis }}" {{ (old('id_tipo_sala_tis') == $tipo->id_tipo_sala_tis) ? 'selected' : '' }}>{{ $tipo->ds_tipo_sala_tis }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Local/Endereço</label>
                            <input type="text" class="form-control" name="ds_local_sal" id="ds_local_sal" placeholder="Local/Endereço" value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                <a href="{{ url('sala') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
            </div>
        </div>
    {!! Form::close() !!} 
</div> 
@endsection