@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title"><i class="nc-icon nc-tag-content"></i> Permissões</h4>
                </div>
                <div class="col-md-6">
                    
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
                        <th>Permissão</th>
                        <th>Chave</th>
                        <th>Descrição</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permissions as $p)
                    <tr>
                        <td>{{ $p->display_name }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->description }}</td>
                        <td class="text-center" style="min-width: 100px;">                          
                            <a title="Editar" href="{{ route('permissions.edit',$p->id) }}" class="btn btn-primary btn-link btn-icon"><i class="fa fa-edit fa-2x"></i></a>
                            <form class="form-delete" style="display: inline;" action="{{ route('permissions.destroy',$p->id) }}" method="POST">
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