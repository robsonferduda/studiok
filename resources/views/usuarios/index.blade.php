@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title ml-2"><i class="nc-icon nc-circle-10"></i> Usuários</h4>
                </div>
                <div class="col-md-6">
                    <a href="{{ url('user/create') }}" class="btn btn-info pull-right" style="margin-right: 12px;"><i class="fa fa-plus"></i> Cadastrar</a>
                </div>
            </div>
        </div>
        <div class="card-body">           
            <div class="col-md-12">
                @include('layouts.mensagens')
            </div>            
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Email</th>
                      <th>Perfil</th>
                      <th>Situação</th>
                      <th class="disabled-sorting text-center">Ações</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Perfil</th>
                        <th class="text-center">Situação</th>
                        <th class="disabled-sorting text-center">Ações</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($usuarios as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @forelse($user->roles as $role)
                                    <span class="badge badge-{{ $role->display_color }}">{{ $role->display_name }}</span>
                                @empty
                                    Nenhum perfil associado
                                @endforelse
                            </td>
                            <td class="text-center">
                                @if($user->fl_active == 'S')
                                    <span class="badge badge-success">ATIVO</span>
                                @else
                                    <span class="badge badge-danger">INATIVO</span>
                                @endif
                            </td>
                            <td class="text-center">

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> 
@endsection