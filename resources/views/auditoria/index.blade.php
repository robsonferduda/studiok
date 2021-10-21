@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title"><i class="fa fa-shield"></i> Auditoria</h4>
                </div>
                <div class="col-md-6">
                    
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
                        <th>Modelo</th>
                        <th>Evento</th>
                        <th>Usuário</th>
                      <th class="disabled-sorting text-center">Ações</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Modelo</th>
                        <th>Evento</th>
                        <th>Usuário</th>
                        <th class="disabled-sorting text-center">Ações</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($audits as $audit)
                        <tr>
                            <td>{{ $audit->auditable_type }}</td>
                            <td>{{ $audit->event }}</td>
                            <td>{{ ($audit->user) ? $audit->user->name : 'Usuário não logado' }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> 
@endsection