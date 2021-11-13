@extends('layouts.app')
@section('content')
<div class="col-md-12">
    {!! Form::open(['id' => 'frm_participantes_import', 'url' => 'participante/importacao', 'files' => true]) !!}
        <div class="card ">
            <div class="card-header ">
                @include('layouts.cabecalho')
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title"><i class="nc-icon nc-badge"></i> Importar Participantes</h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('participantes', Session::get('evento')->ds_apelido_eve) }}" class="btn btn-info pull-right" style="margin-right: 12px;"><i class="fa fa-table"></i> Participantes</a>
                    </div>
                </div>
                @include('layouts.mensagens')
            </div>
            <div class="card-body">
                <div class="row px-2">
                    <div class="col-md-12 mb-2">
                        <p><strong>Instruções</strong></p>
                        <ol>
                            <li>O formato do arquivo deve ser <code>.csv</code></li>
                            <li>A primeira linha não deve conter cabeçalhos ou identificação de colunas</li>
                            <li>Os itens devem estar separados por <code>ponto e vírgula</code></li>
                            <li>O primeiro item deve ser obrigatoriamente o <code>email</code> do participante</li>
                            <li>O segundo item deve ser obrigatoriamente o <code>nome</code> do participante</li>
                            <li>Todos os participantes recebem uma senha com o valor padrão <code>123456</code></li>
                        </ol>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Evento</label>
                        <select class="form-control" name="evento" id="evento" aria-label="Selecione um evento">
                            <option value="">Selecione um evento</option>
                            @foreach($eventos as $evento)
                                <option value="{{ $evento->id_evento_eve }}" {{ (old('evento') == $evento->id_evento_eve) ? 'selected' : '' }}>{{ $evento->nm_evento_eve }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Situação</label>
                        <select class="form-control" name="situacao" id="situacao">
                            <option value="">Selecione uma situação</option>
                            @foreach($situacoes as $situacao)
                                <option value="{{ $situacao->id_situacao_sit }}" {{ (old('situacao') == $situacao->id_situacao_sit) ? 'selected' : '' }}>{{ $situacao->ds_situacao_sit }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tipo de Inscrição</label>
                        <select class="form-control" name="tipo" id="tipo">
                            <option value="">Selecione um tipo</option>
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo->id_tipo_inscricao_tii }}" {{ (old('tipo') == $tipo->id_tipo_inscricao_tii) ? 'selected' : '' }}>{{ $tipo->ds_tipo_inscricao_tii }}</option>
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
            <div class="card-footer text-center mb-3">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                <a href="{{ url()->previous() }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
            </div>
        </div>
    {!! Form::close() !!} 
</div> 
@endsection