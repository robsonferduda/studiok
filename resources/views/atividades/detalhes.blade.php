@extends('layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="card card-user">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title"><i class="nc-icon nc-calendar-60"></i> Atividade</h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('programacao') }}" class="btn btn-info pull-right"><i class="nc-icon nc-calendar-60"></i> Programação</a>
                        <a href="{{ route('atividade.edit',$atividade->id_atividade_ati) }}" class="btn btn-primary pull-right" style="margin-right: 12px;"><i class="fa fa-edit"></i> Editar</a>                        
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Dados da Atividade</h6>
                        <p class="mb-1"><strong>Título: </strong> {{ $atividade->nm_atividade_ati }}</p>
                        <p class="mb-1"><strong>Local: </strong> {{ $atividade->sala->nm_sala_sal }}</p>
                        <p class="mb-1"><strong>Tipo de Atividade: </strong> {{ $atividade->tipo->ds_tipo_atividade_tia }}</p>
                        <p class="mb-1"><strong>Data/Hora Início: </strong> {{ ($atividade->dt_inicio_atividade_ati) ? Carbon\Carbon::parse($atividade->dt_inicio_atividade_ati)->format('d/m/Y H:i') : 'Não informada' }}</p>
                        <p class="mb-1"><strong>Data/Hora Término: </strong> {{ ($atividade->dt_termino_atividade_ati) ? Carbon\Carbon::parse($atividade->dt_termino_atividade_ati)->format('d/m/Y H:i') : 'Não informada' }}</p>
                        <p><strong>Resumo: </strong> {{ ($atividade->ds_atividade_ati) ? $atividade->ds_atividade_ati : 'Nenhum resumo cadastrado'}}</p>
                    </div>
                    <div class="col-md-4">
                        <h6>Palestrantes</h6>
                        @forelse($atividade->palestrantes as $key => $palestrante)
                            <div class="row mt-3 hover-overlay">
                                <div class="col-md-3">
                                    @if($palestrante->path_imagem_pal)
                                        <img src="{{ url('/profile_pictures/'.$palestrante->path_imagem_pal) }}" />
                                    @else
                                        <img src="{{ url('img/icon-cam.png') }}" />
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <p class="mb-1"><a href="{{ url('palestrante/'.$palestrante->id_palestrante_pal) }}">{{ $palestrante->pessoa->nm_pessoa_pes }}</a></p>
                                    <p class="mb-1">{{ $palestrante->pessoa->ds_email_pes }}</p>
                                </div>
                            </div>                           
                        @empty
                            <p>Nenhum palestrante cadastrado</p>
                        @endforelse
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-12">
                        <h6>Perguntas dos Participantes</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Participante</th>
                                    <th>Pergunta</th>
                                    <th>Situação</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Robson Fernando Duda</td>
                                    <td>Qual a formação do palestrante?</td>
                                    <td><span class="badge badge-pill badge-danger">REJEITADA</span></td>
                                    <td>
                                        <button title="Rejeitar" type="submit" class="btn btn-danger btn-link btn-icon">
                                            <i class="fa fa-thumbs-down fa-2x"></i>
                                        </button>
                                        <button title="Aceitar" type="submit" class="btn btn-primary btn-link btn-icon">
                                            <i class="fa fa-thumbs-up fa-2x"></i>
                                        </button>
                                        <button title="Excluir" type="submit" class="btn btn-success btn-link btn-icon">
                                            <i class="fa fa-check fa-2x"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Anderson Clayton dos Santos</td>
                                    <td>Qual curso melhor se encaixa no formato de graduação apresentado nesta palestra?</td>
                                    <td><span class="badge badge-pill badge-primary">ACEITA</span></td>
                                    <td>
                                        <button title="Rejeitar" type="submit" class="btn btn-danger btn-link btn-icon">
                                            <i class="fa fa-thumbs-down fa-2x"></i>
                                        </button>
                                        <button title="Aceitar" type="submit" class="btn btn-primary btn-link btn-icon">
                                            <i class="fa fa-thumbs-up fa-2x"></i>
                                        </button>
                                        <button title="Excluir" type="submit" class="btn btn-success btn-link btn-icon">
                                            <i class="fa fa-check fa-2x"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Elizabete Catapan</td>
                                    <td>Qual o sentido da vida?</td>
                                    <td><span class="badge badge-pill badge-success">RESPONDIDA</span></td>
                                    <td>
                                        <button title="Rejeitar" type="submit" class="btn btn-danger btn-link btn-icon">
                                            <i class="fa fa-thumbs-down fa-2x"></i>
                                        </button>
                                        <button title="Aceitar" type="submit" class="btn btn-primary btn-link btn-icon">
                                            <i class="fa fa-thumbs-up fa-2x"></i>
                                        </button>
                                        <button title="Excluir" type="submit" class="btn btn-success btn-link btn-icon">
                                            <i class="fa fa-check fa-2x"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Robson Fernando Duda</td>
                                    <td>Quem vai ser campeão da Libertadores?</td>
                                    <td><span class="badge badge-pill badge-warning">PENDENTE</span></td>
                                    <td>
                                        <button title="Rejeitar" type="submit" class="btn btn-danger btn-link btn-icon">
                                            <i class="fa fa-thumbs-down fa-2x"></i>
                                        </button>
                                        <button title="Aceitar" type="submit" class="btn btn-primary btn-link btn-icon">
                                            <i class="fa fa-thumbs-up fa-2x"></i>
                                        </button>
                                        <button title="Excluir" type="submit" class="btn btn-success btn-link btn-icon">
                                            <i class="fa fa-check fa-2x"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>   
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection