@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card card-user">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title"><i class="nc-icon nc-tv-2"></i> {{ $sala->nm_sala_sal }}</h4>
                </div>
                <div class="col-md-6">
                    <a href="{{ url('sala') }}" class="btn btn-info pull-right"><i class="nc-icon nc-tv-2"></i> Salas</a>
                    <a href="{{ route('sala.edit',$sala->id_sala_sal) }}" class="btn btn-primary pull-right" style="margin-right: 12px;"><i class="fa fa-edit"></i> Editar</a>                        
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-12">
                    <h6>Dados da Sala</h6>
                    <p class="mb-1"><strong>Evento: </strong> {{ ($sala->evento) ? $sala->evento->nm_evento_eve : 'Nenhum evento selecionado' }} </p>
                    <p class="mb-1"><strong>Nome: </strong> {{ $sala->nm_sala_sal }} </p>
                    <p class="mb-1"><strong>Tipo: </strong> {!! ($sala->tipo) ? $sala->tipo->ds_tipo_sala_tis : 'Não definido' !!}</p>
                    <p class="mb-1"><strong>Local/Endereço: </strong> {{ ($sala->ds_local_sal) ? $sala->ds_local_sal : 'Não Definido' }}</p>
                    <p class="mb-1"><strong>Local/URL de Transmissão: </strong> {{ ($sala->ds_ambiente_sal) ? $sala->ds_ambiente_sal : 'Não Definido' }}</p>
                </div>
                <div class="col-md-12 mt-3">
                    <h6>Atividades</h6>
                    <table class="table">
                        <thead>
                          <tr>
                            <th>Início</th>
                            <th>Término</th>
                            <th>Atividade</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($sala->atividades->sortBy('dt_inicio_atividade_ati') as $key => $atividade)
                                <tr>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($atividade->dt_inicio_atividade_ati)) }}</td>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($atividade->dt_termino_atividade_ati)) }}</td>
                                    <td>{{ $atividade->nm_atividade_ati }}</td>
                                    <td>
                                        <a href="{{ url('atividade/situacao/'.$atividade->id_atividade_ati) }}">
                                            @if($atividade->fl_corrente_ati)
                                                <span class="badge badge-success">ATIVO</span>
                                            @else
                                                <span class="badge badge-danger">INATIVO</span>
                                            @endif
                                        </a>
                                    </td>
                                </tr>
                            @endforeach       
                        </tbody>
                      </table>
                </div>
                <div class="col-md-12 mt-3">
                    <h6>Transmissão</h6>
                    @if($sala->tipo and $sala->tipo->id_tipo_sala_tis == 2 and $sala->ds_local_sal)
                        <iframe width="100%" height="600px" src="{{ $sala->ds_local_sal }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    @else
                        {{ ($sala->ds_local_sal) ? $sala->ds_local_sal : 'Não Definido' }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection