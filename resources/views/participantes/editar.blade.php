@extends('layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="card card-user">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title"><i class="nc-icon nc-badge"></i> Participantes</h4>
                        <h6 class="card-subtitle mb-2 text-muted">Editar Dados</h6>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('participante') }}" class="btn btn-default pull-right" style="margin-right: 12px;"><i class="fa fa-table"></i> Participantes</a>
                    </div>
                </div>
                @include('layouts.mensagens')
            </div>
            <div class="card-body">
                {!! Form::open(['id' => 'frm_participante_editar', 'url' => ['participante', $participante->id_participante_par], 'method' => 'patch']) !!}
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CPF</label>
                                <input type="text" class="form-control" name="nu_cpf_par" id="nu_cpf_par" placeholder="CPF" value="{{ $participante->nu_cpf_par }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>ORCID (Open Researcher and Contributor ID)</label>
                                <input type="text" class="form-control" name="nu_orcid_pes" id="nu_orcid_pes" placeholder="ORCID" value="{{ $participante->pessoa->nu_orcid_pes }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="ds_email_pes" placeholder="Email" value="{{ $participante->pessoa->ds_email_pes }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Nome Completo</label>
                                <input type="text" class="form-control" name="nm_pessoa_pes" placeholder="Nome Completo" value="{{ $participante->pessoa->nm_pessoa_pes }}">
                            </div>
                        </div>
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label>Nome Crachá</label>
                                <input type="text" class="form-control" name="nm_cracha_par" placeholder="Nome Crachá" value="{{ $participante->nm_cracha_par }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="update ml-auto mr-auto">
                            <button type="submit" class="btn btn-success btn-round"><i class="fa fa-refresh"></i> Atualizar Perfil</button>
                        </div>
                    </div>
                {!! Form::close() !!} 
            </div>
        </div>
    </div> 
@endsection