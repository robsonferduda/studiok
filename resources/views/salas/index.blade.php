@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title"><i class="nc-icon nc-tv-2"></i> Salas</h4>
                </div>
                <div class="col-md-6">
                    <a href="{{ url('sala/create') }}" class="btn btn-info pull-right" style="margin-right: 12px;"><i class="fa fa-plus"></i> Cadastrar</a>
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
                      <th>Sala</th>
                      <th>Local/Endereço</th>
                      <th>Tipo</th>
                      <th class="disabled-sorting text-center">Ações</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Sala</th>
                        <th>Local/Endereço</th>
                        <th>Tipo</th>
                        <th class="disabled-sorting text-center">Ações</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($salas as $sala)
                        <tr>
                            <td>{{ $sala->nm_sala_sal }}</td>
                            <td>{!! ($sala->tipo and $sala->tipo->id_tipo_sala_tis == 2) ? '<a href="'.$sala->ds_local_sal.'" target="BLANK">'.$sala->ds_local_sal.'</a>' : $sala->ds_local_sal !!}</td>
                            <td>
                                {!! ($sala->tipo) ? $sala->tipo->ds_tipo_sala_tis : 'Não definido' !!}
                            </td>
                            <td class="text-center">
                                <a title="Dados da Sala" href="{{ url('sala',$sala->id_sala_sal) }}" class="btn btn-warning btn-link btn-icon"><i class="nc-icon nc-tv-2 font-25"></i></a>
                                <a href="{{ route('sala.edit',$sala->id_sala_sal) }}" class="btn btn-primary btn-link btn-icon"><i class="fa fa-edit fa-2x"></i></a>
                                <form class="form-delete" style="display: inline;" action="{{ route('sala.destroy',$sala->id_sala_sal) }}" method="POST">
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