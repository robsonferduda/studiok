@extends('layouts.app')
@section('content')
<div class="col-md-12">
    {!! Form::open(['id' => 'frm_sala_editar', 'url' => ['sala', $sala->id_sala_sal], 'method' => 'patch']) !!}
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title"><i class="nc-icon nc-tv-2"></i> Salas</h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('salas', Session::get('evento')->ds_apelido_eve) }}" class="btn btn-info pull-right" style="margin-right: 12px;"><i class="fa fa-table"></i> Salas</a>
                    </div>
                </div>
                @include('layouts.mensagens')
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="nm_sala_sal" id="nm_sala_sal" placeholder="Nome" value="{{ $sala->nm_sala_sal }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipo de Sala</label>
                            <select class="form-control" name="id_tipo_sala_tis">
                                <option value="">Selecione um tipo de sala</option>
                                @foreach($tipos as $tipo)
                                    <option value="{{ $tipo->id_tipo_sala_tis }}" {{ ($sala->id_tipo_sala_tis == $tipo->id_tipo_sala_tis) ? 'selected' : '' }}>{{ $tipo->ds_tipo_sala_tis }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Local/URL de Transmissão</label>
                            <input type="text" class="form-control" name="ds_local_sal" id="ds_local_sal" placeholder="URL de Transmissão" value="{{ $sala->ds_local_sal }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>URL do Ambinte Virtual(Ex.: Zoom, Meet, StreamYard)</label>
                            <input type="text" class="form-control" name="ds_ambiente_sal" id="ds_ambiente_sal" placeholder="URL do Ambinte Virtual" value="{{ $sala->ds_ambiente_sal }}">
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