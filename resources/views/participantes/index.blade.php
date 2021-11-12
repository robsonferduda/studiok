@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            @include('layouts.cabecalho')
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title"><i class="nc-icon nc-badge"></i> Participantes</h4>
                </div>
                <div class="col-md-6">
                    <a href="{{ url('participante/create') }}" class="btn btn-primary pull-right" style="margin-right: 12px;"><i class="fa fa-plus"></i> Novo</a>
                    <a href="{{ url('participante/importar') }}" class="btn btn-info pull-right" style="margin-right: 12px;"><i class="fa fa-download"></i> Importar</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.mensagens')
                </div>
            </div>
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Email</th>
                      <th>Situação</th>
                      <th>Tipo da Inscrição</th>
                      <th class="disabled-sorting text-center">Ações</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Situação</th>
                        <th>Tipo da Inscrição</th>
                        <th class="disabled-sorting text-center">Ações</th>>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($participantes as $p)
                        <tr>
                            <td>{{ $p->pessoa->nm_pessoa_pes }}</td>
                            <td>{{ $p->pessoa->ds_email_pes }}</td>
                            <td>{{ ($p->pivot and $p->pivot->id_situacao_sit) ? \App\Situacao::find($p->pivot->id_situacao_sit)->ds_situacao_sit  : 'Não informado' }}</td>
                            <td>{{ ($p->pivot and $p->pivot->id_tipo_inscricao_tii) ? \App\TipoInscricao::find($p->pivot->id_tipo_inscricao_tii)->ds_tipo_inscricao_tii : 'Não informado' }}</td>
                            <td class="text-center">
                                <a title="Dados do Participante" href="{{ url('participante',$p->id_participante_par) }}" class="btn btn-warning btn-link btn-icon"><i class="nc-icon nc-badge font-25"></i></a>
                                <a title="Editar" href="{{ route('participante.edit',$p->id_participante_par) }}" class="btn btn-primary btn-link btn-icon"><i class="fa fa-edit fa-2x"></i></a>
                                <form class="form-delete" style="display: inline;" action="{{ route('participante.destroy',$p->id_participante_par) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button title="Excluir" type="submit" class="btn btn-danger btn-link btn-icon button-remove" title="Delete">
                                        <i class="fa fa-times fa-2x"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> 
@endsection