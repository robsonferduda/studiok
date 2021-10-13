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
            {!! Form::open(['id' => 'frm_atividade_novo', 'url' => ['atividade']]) !!}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Evento <span class="text-danger">Obrigatório</span></label>
                            <select class="form-control" name="id_evento_eve">
                                <option value="">Selecione um evento</option>
                                @foreach($eventos as $evento)
                                    <option value="{{ $evento->id_evento_eve }}" {{ (old('evento') == $evento->id_evento_eve) ? 'selected' : '' }}>{{ $evento->nm_evento_eve }}</option>
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
                                    <option value="{{ $sala->id_sala_sal }}" {{ (old('sala') == $sala->id_sala_sal) ? 'selected' : '' }}>{{ $sala->nm_sala_sal }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tipo de Atividade <span class="text-danger">Obrigatório</span></label>
                            <select class="form-control" name="id_tipo_atividade_tia" id="id_tipo_atividade_tia">
                                <option value="">Selecione um tipo</option>
                                @foreach($tipos as $tipo)
                                    <option value="{{ $tipo->id_tipo_atividade_tia }}" {{ (old('tipo') == $tipo->id_tipo_atividade_tia) ? 'selected' : '' }} data-paralelo="{{ ($tipo->fl_paralelo) ? $tipo->fl_paralelo : 0 }}" data-palestrante="{{ ($tipo->fl_palestrante) ? $tipo->fl_palestrante : 0 }}">{{ $tipo->ds_tipo_atividade_tia }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>  

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Título <span class="text-danger">Obrigatório</span></label>
                            <input type="text" class="form-control" name="nm_atividade_ati" value="{{ old('nm_atividade_ati') }}" placeholder="Título">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Data/Hora Início</label>
                            <input type="text" class="form-control" name="dt_inicio_atividade_ati" id="dt_inicio_atividade_ati" placeholder="__/__/____ __:__">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Data/Hora Término</label>
                            <input type="text" class="form-control" name="dt_termino_atividade_ati" id="dt_termino_atividade_ati" placeholder="__/__/____ __:__">
                        </div>
                    </div>
                </div>  

                <div class="row box-paralelo">
                    <div class="col-md-12 mt-2">
                    <div class="alert alert-info alert-with-icon alert-dismissible fade show" data-notify="container">
                        <span data-notify="icon" class="nc-icon nc-bullet-list-67"></span>
                        <span data-notify="message"><b>Atenção!</b> Esta atividade possui atividades paralelas. Após o cadastro, você será direcionado para a tela de preenchimento de atividades paralelas.</span>
                      </div>
                    </div>
                </div>

                <div class="row box-palestrante">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Palestrantes</label>
                            <select class="form-control" name="palestrantes[]" id="choices-multiple-remove-button" placeholder="Selecione ou digite o nome para pesquisar" multiple>
                                @foreach($palestrantes as $palestrante)
                                    <option value="{{ $palestrante->id_palestrante_pal }}">{{ $palestrante->pessoa->nm_pessoa_pes }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-check mt-2">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="fl_ativo_ati" value="true">
                                    CADASTRO ATIVO
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-check mt-2">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="fl_destaque_ati" value="true">
                                    Destaque (Visualização no Site)
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>                                                                                      
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group pr-2">
                            <label>Resumo</label>
                            <textarea class="form-control" name="ds_atividade_ati" rows="10"></textarea>
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