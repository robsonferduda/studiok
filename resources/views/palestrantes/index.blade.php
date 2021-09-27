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
                    <a href="{{ url('palestrante/create') }}" class="btn btn-primary pull-right" style="margin-right: 12px;"><i class="fa fa-plus"></i> Novo</a>
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
                      <th>Empresa/Instituição</th>
                      <th>Cargo</th>
                      <th>Email</th>
                      <th class="disabled-sorting text-center">Ações</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>Empresa/Instituição</th>
                        <th>Cargo</th>
                        <th>Email</th>
                        <th class="disabled-sorting text-center">Ações</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($palestrantes as $p)
                        <tr>
                            <td>{{ $p->pessoa->nm_pessoa_pes }}</td>
                            <td>{{ $p->ds_empresa_pal }}</td>
                            <td>{{ $p->ds_cargo_pal }}</td>
                            <td>{{ $p->pessoa->ds_email_pes }}</td>
                            <td class="center">
                                <a title="Dados do Palestrante" href="{{ url('palestrante',$p->id_palestrante_pal) }}" class="btn btn-warning btn-link btn-icon"><i class="nc-icon nc-badge font-25"></i></a>
                                <a title="Editar" href="{{ route('palestrante.edit',$p->id_palestrante_pal) }}" class="btn btn-primary btn-link btn-icon"><i class="fa fa-edit fa-2x"></i></a>
                                <form class="form-delete" style="display: inline;" action="{{ route('palestrante.destroy',$p->id_palestrante_pal) }}" method="POST">
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