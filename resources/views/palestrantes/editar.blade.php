@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title"><i class="fa fa-graduation-cap"></i> Palestrantes</h4>
                </div>
                <div class="col-md-6">
                    <a href="{{ url('palestrante') }}" class="btn btn-default pull-right" style="margin-right: 12px;"><i class="fa fa-table"></i> Palestrantes</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.mensagens')
                </div>
            </div>
            {!! Form::open(['id' => 'frm_palestrante_novo', 'url' => ['palestrante', $palestrante->id_palestrante_pal], 'method' => 'patch']) !!}
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-flex justify-content-center p-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h6 class="card-title">Foto de Perfil</h6>
                                    <div class="profile-img p-3">
                                        <img src="{{ ($palestrante->path_imagem_pal) ? url('/profile_pictures/'.$palestrante->path_imagem_pal) : url('img/icon-cam.png') }}" id="profile-pic">
                                    </div>
                                    <div class="btn btn-dark">
                                        <input type="file" class="file-upload" id="file-upload" 
                                        name="profile_picture" accept="image/*">
                                        <i class="fa fa-photo"></i> BUSCAR FOTO
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-md-9">
                        <input type="hidden" name="path_imagem_pal" id="path_imagem_pal" value="{{ $palestrante->path_imagem_pal }}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ORCID</label>
                                    <input type="text" class="form-control" name="nu_orcid_pes" id="nu_orcid_pes" value="{{ $palestrante->nu_orcid_pes }}" placeholder="ORCID">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">Obrigatório</span></label>
                                    <input type="text" class="form-control" name="ds_email_pes"  value="{{ $palestrante->pessoa->ds_email_pes }}" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group pr-2">
                                    <label>Nome Completo <span class="text-danger">Obrigatório</span></label>
                                    <input type="text" class="form-control" name="nm_pessoa_pes"  value="{{ $palestrante->pessoa->nm_pessoa_pes }}" placeholder="Nome Completo">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Empresa</label>
                                    <input type="text" class="form-control" name="ds_empresa_pal"  value="{{ $palestrante->ds_empresa_pal }}" placeholder="Empresa">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group pr-2">
                                    <label>Cargo</label>
                                    <input type="text" class="form-control" name="ds_cargo_pal"  value="{{ $palestrante->ds_cargo_pal }}" placeholder="Cargo">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>Como deseja ser chamado?</label>
                                    <input type="text" class="form-control" name="ds_tratamento_pal" value="{{ $palestrante->ds_tratamento_pal }}" placeholder="Sr, Dr, Prof., por exemplo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-4">
                                    <div class="checkbox">
                                        <input name="fl_ativo_pal" id="fl_ativo_pal" type="checkbox">
                                        <label for="fl_ativo_pal">Cadastro Ativo</label>
                                    </div>
                                    <div class="checkbox">
                                        <input name="fl_destaque_atp" id="fl_destaque_atp" type="checkbox">
                                        <label for="fl_destaque_atp">Destaque (Visualização no Site)</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group pr-2">
                                    <label>Biografia</label>
                                    <textarea class="form-control" name="biografia_pal" row="8">{{ $palestrante->biografia_pal }}</textarea>
                                </div>
                            </div>
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
<div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body mt-5">
                <div id="resizer"></div>
                <div class="row">
                    <button class="btn rotate float-left m-auto" data-deg="90"><i class="fa fa-undo"></i></button>
                    <button class="btn rotate float-right m-auto" data-deg="-90"><i class="fa fa-repeat"></i></button>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-block btn-success" id="upload"><i class="fa fa-upload"></i> CORTAR E ENVIAR</button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-block btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> CANCELAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection