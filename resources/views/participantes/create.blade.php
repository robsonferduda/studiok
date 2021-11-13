@extends('layouts.app')
@section('content')
<div class="col-md-12">
    {!! Form::open(['id' => 'frm_participantes_novo', 'url' => 'participante' ]) !!}
        <div class="card ">
            <div class="card-header">
                @include('layouts.cabecalho')
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title"><i class="nc-icon nc-badge"></i> Cadastro de Participantes</h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('participantes', Session::get('evento')->ds_apelido_eve) }}" class="btn btn-info pull-right"><i class="fa fa-table"></i> Participantes</a>
                    </div>
                </div>
                @include('layouts.mensagens')
            </div>
            <div class="card-body">

                {!! Form::open(['id' => 'frm_participante_novo', 'url' => 'participante' ]) !!}
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Evento <span class="text-danger">Obrigatório</span></label>
                            <select class="form-control" name="evento" id="evento" aria-label="Selecione um evento">
                                <option value="">Selecione um evento</option>
                                @foreach($eventos as $evento)
                                    <option value="{{ $evento->id_evento_eve }}" {{ (old('evento') == $evento->id_evento_eve) ? 'selected' : '' }}>{{ $evento->nm_evento_eve }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Situação <span class="text-danger">Obrigatório</span></label>
                            <select class="form-control" name="situacao" id="situacao">
                                <option value="">Selecione uma situação</option>
                                @foreach($situacoes as $situacao)
                                    <option value="{{ $situacao->id_situacao_sit }}" {{ (old('situacao') == $situacao->id_situacao_sit) ? 'selected' : '' }}>{{ $situacao->ds_situacao_sit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tipo de Inscrição <span class="text-danger">Obrigatório</span></label>
                            <select class="form-control" name="tipo" id="tipo">
                                <option value="">Selecione um tipo</option>
                                @foreach($tipos as $tipo)
                                    <option value="{{ $tipo->id_tipo_inscricao_tii }}" {{ (old('tipo') == $tipo->id_tipo_inscricao_tii) ? 'selected' : '' }}>{{ $tipo->ds_tipo_inscricao_tii }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email <span class="text-danger">Obrigatório</span></label>
                                <input type="text" class="form-control" name="ds_email_pes" placeholder="Email" value="{{ old('pessoa->ds_email_pes') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CPF</label>
                                <input type="text" class="form-control" name="nu_cpf_par" id="nu_cpf_par" placeholder="CPF" value="{{ old('nu_cpf_par') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>ORCID (Open Researcher and Contributor ID)</label>
                                <input type="text" class="form-control" name="nu_orcid_pes" id="nu_orcid_pes" placeholder="ORCID" value="{{ old('pessoa->nu_orcid_pes') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Nome Completo <span class="text-danger">Obrigatório</span></label>
                                <input type="text" class="form-control" name="nm_pessoa_pes" placeholder="Nome Completo" value="{{ old('pessoa->nm_pessoa_pes') }}">
                            </div>
                        </div>
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label>Nome Crachá</label>
                                <input type="text" class="form-control" name="nm_cracha_par" placeholder="Nome Crachá" value="{{ old('nm_cracha_par') }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-2 mb-2">
                        <div class="update ml-auto mr-auto">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                            <a href="{{ url()->previous() }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
                        </div>
                    </div>
                {!! Form::close() !!} 
            </div>
        </div>
    {!! Form::close() !!} 
</div> 
@endsection