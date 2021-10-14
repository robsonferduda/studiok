@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title"><i class="nc-icon nc-calendar-60"></i> Atividades</h4>
                </div>
                <div class="col-md-6">
                    <a href="{{ url('programacao') }}" class="btn btn-primary pull-right"><i class="nc-icon nc-calendar-60"></i> Programação</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.mensagens')
                </div>
            </div>
            {!! Form::open(['id' => 'frm_atividade_editar', 'url' => ['atividade', $atividade->id_atividade_ati], 'method' => 'patch']) !!}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Evento <span class="text-danger">Obrigatório</span></label>
                            <select class="form-control" name="id_evento_eve">
                                <option value="">Selecione um evento</option>
                                @foreach($eventos as $evento)
                                    <option value="{{ $evento->id_evento_eve }}" {{ ($atividade->id_evento_eve == $evento->id_evento_eve) ? 'selected' : '' }}>{{ $evento->nm_evento_eve }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Local/Sala <span class="text-danger">Obrigatório</span></label>
                            <select class="form-control" name="id_sala_sal">
                                <option value="">Selecione uma sala</option>
                                @foreach($salas as $sala)
                                    <option value="{{ $sala->id_sala_sal }}" {{ ($atividade->id_sala_sal == $sala->id_sala_sal) ? 'selected' : '' }}>{{ $sala->nm_sala_sal }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tipo de Atividade <span class="text-danger">Obrigatório</span></label>
                            <select class="form-control" name="id_tipo_atividade_tia">
                                <option value="">Selecione um tipo</option>
                                @foreach($tipos as $tipo)
                                    <option value="{{ $tipo->id_tipo_atividade_tia }}" {{ ($atividade->id_tipo_atividade_tia == $tipo->id_tipo_atividade_tia) ? 'selected' : '' }}>{{ $tipo->ds_tipo_atividade_tia }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>  

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Título <span class="text-danger">Obrigatório</span></label>
                            <input type="text" class="form-control" name="nm_atividade_ati" value="{{ $atividade->nm_atividade_ati }}" placeholder="Título">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Data/Hora Início</label>
                            <input type="text" class="form-control" name="dt_inicio_atividade_ati" id="dt_inicio_atividade_ati" value="{{ ($atividade->dt_inicio_atividade_ati) ? Carbon\Carbon::parse($atividade->dt_inicio_atividade_ati)->format('d/m/Y H:i') : '' }}" placeholder="__/__/____ __:__">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Data/Hora Término</label>
                            <input type="text" class="form-control" name="dt_termino_atividade_ati" id="dt_termino_atividade_ati" value="{{ ($atividade->dt_termino_atividade_ati) ? Carbon\Carbon::parse($atividade->dt_termino_atividade_ati)->format('d/m/Y H:i') : '' }}" placeholder="__/__/____ __:__">
                        </div>
                    </div>
                </div>  

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Palestrantes</label>
                            <select class="form-control" name="palestrantes[]" id="choices-multiple-remove-button" placeholder="Selecione ou digite o nome para pesquisar" multiple>
                                @foreach($palestrantes as $palestrante)
                                    <option value="{{ $palestrante->id_palestrante_pal }}" {{ ($atividade->palestrantes->find($palestrante->id_palestrante_pal)) ? 'selected' : '' }}>{{ $palestrante->pessoa->nm_pessoa_pes }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                                        
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mt-2">
                            <div class="checkbox">
                                <input name="fl_ativo_ati" id="fl_ativo_ati" type="checkbox">
                                <label for="fl_ativo_ati">Cadastro Ativo</label>
                            </div>
                            <div class="checkbox">
                                <input name="fl_destaque_ati" id="fl_destaque_ati" type="checkbox">
                                <label for="fl_destaque_ati">Destaque (Visualização no Site)</label>
                            </div>
                        </div>
                    </div>
                </div>  
                                              
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group pr-2">
                            <label>Resumo</label>
                            <textarea class="form-control" name="ds_atividade_ati" row="8">{{ $atividade->ds_atividade_ati }}</textarea>
                        </div>
                    </div>
                </div>                        
                                 
                <div class="row">
                    <div class="update ml-auto mr-auto">
                        <button type="submit" class="btn btn-wd btn-success"><i class="fa fa-save"></i> Salvar</button>
                        <a href="{{ url('palestrante') }}" class="btn btn-danger btn-fill btn-wd"><i class="fa fa-times"></i> Cancelar</a>
                    </div>
                </div>
            {!! Form::close() !!}                         
        </div>
    </div>
</div> 
@endsection