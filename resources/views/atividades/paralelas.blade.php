@extends('layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="card card-user">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 ">
                        <h4 class="card-title"><i class="nc-icon nc-calendar-60"></i> Atividades > Atividades Paralelas</h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('programacao') }}" class="btn btn-info pull-right"><i class="nc-icon nc-calendar-60"></i> Programação</a>
                        <a href="{{ route('atividade.edit',$atividade->id_atividade_ati) }}" class="btn btn-primary pull-right" style="margin-right: 12px;"><i class="fa fa-edit"></i> Editar</a>                        
                    </div>
                </div>
            </div>
            <div class="card-body px-4">
                <div class="row">
                    <div class="col-md-12">
                        @if(Session::get('atividade_paralela'))
                            <h6>Edição de Atividades Paralelas</h6>
                        @else
                            <h6>Cadastro de Atividades paralelas</h6>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                @include('layouts.mensagens')
                            </div>
                        </div>
                        @if(Session::get('atividade_paralela'))
                            {!! Form::open(['id' => 'frm_atividade_editar', 'url' => ['atividadeparalela', Session::get('atividade_paralela')->id_atividades_paralelas_atp], 'method' => 'patch']) !!}
                        @else
                            {!! Form::open(['id' => 'frm_atividade_novo', 'url' => ['atividade/paralela/salvar']]) !!}
                        @endif
                            <input type="hidden" name="id_atividade_ati" value="{{ $atividade->id_atividade_ati }}">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Local/Sala <span class="text-danger">Obrigatório</span></label>
                                        <select class="form-control" name="id_sala_sal">
                                            <option value="">Selecione uma sala</option>
                                            @foreach($salas as $sala)
                                                <option value="{{ $sala->id_sala_sal }}" {{ (Session::get('atividade_paralela')) ? ((Session::get('atividade_paralela')->id_sala_sal) == $sala->id_sala_sal) ? 'selected' : '' : '' }}>{{ $sala->nm_sala_sal }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label>Título <span class="text-danger">Obrigatório</span></label>
                                        <input type="text" class="form-control" name="titulo_atp" value="{{ (Session::get('atividade_paralela')) ? Session::get('atividade_paralela')->titulo_atp : '' }}" placeholder="Título">
                                    </div>
                                </div>                                
                            </div>  

                            <div class="row">
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Início</label>
                                        <input type="text" class="form-control" name="hr_inicio_atp" id="hr_inicio_atp" placeholder="__:__" value="{{ (Session::get('atividade_paralela')) ? Session::get('atividade_paralela')->hr_inicio_atp : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Término</label>
                                        <input type="text" class="form-control" name="hr_fim_atp" id="hr_fim_atp" placeholder="__:__" value="{{ (Session::get('atividade_paralela')) ? Session::get('atividade_paralela')->hr_fim_atp : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label>Autores <span class="text-danger">Obrigatório</span></label>
                                        <input type="text" class="form-control" name="autores_atp" placeholder="Autores" value="{{ (Session::get('atividade_paralela')) ? Session::get('atividade_paralela')->autores_atp : '' }}">
                                    </div>
                                </div>                                
                            </div>                                                                                               
                                            
                            <div class="row">
                                <div class="update ml-auto mr-auto">
                                    @if(Session::get('atividade_paralela'))
                                        <button type="submit" class="btn btn-wd btn-success"><i class="fa fa-edit"></i> Editar Atividade</button>
                                    @else
                                        <button type="submit" class="btn btn-wd btn-success"><i class="fa fa-plus"></i> Adicionar Atividade</button>
                                    @endif
                                </div>
                            </div>
                        {!! Form::close() !!}               
                    </div>
                    <hr/>
                    <div class="col-md-12">
                        <h6>Dados da Atividade Principal</h6>
                        <p class="mb-1"><strong>Título: </strong> {{ $atividade->nm_atividade_ati }}</p>
                        <p class="mb-1"><strong>Local: </strong> {{ $atividade->sala->nm_sala_sal }}</p>
                        <p class="mb-1"><strong>Data/Hora Início: </strong> {{ ($atividade->dt_inicio_atividade_ati) ? Carbon\Carbon::parse($atividade->inicio_atividade_ati)->format('d/m/Y H:i') : 'Não informada' }}</p>
                        <p class="mb-1"><strong>Data/Hora Término: </strong> {{ ($atividade->dt_termino_atividade_ati) ? Carbon\Carbon::parse($atividade->dt_termino_atividade_ati)->format('d/m/Y H:i') : 'Não informada' }}</p>
                    </div>
                    
                    <div class="col-md-12 mt-3">
                        <h6>Atividades Paralelas</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Início</th>
                                    <th>Término</th>
                                    <th>Sala</th>
                                    <th>Detalhes</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($atividade->atividadesParalelas as $key => $atividade)
                                    <tr>
                                        <td>{{ $atividade->hr_inicio_atp }}</td>
                                        <td>{{ $atividade->hr_fim_atp }}</td>
                                        <td>{{ $atividade->sala->nm_sala_sal }}</td>
                                        <td>
                                            <b>{{ $atividade->titulo_atp }}</b><br/>
                                            {{ $atividade->autores_atp }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('atividadeparalela.edit',$atividade->id_atividades_paralelas_atp) }}" class="btn btn-primary btn-link btn-icon"><i class="fa fa-edit fa-2x"></i></a>
                                            <form class="form-delete" style="display: inline;" action="{{ route('atividadeparalela.destroy',$atividade->id_atividades_paralelas_atp) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button title="Excluir" type="submit" class="btn btn-danger btn-link btn-icon button-remove" title="Delete">
                                                    <i class="fa fa-times fa-2x"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5">Nenhuma atividade cadastrada</td></tr>
                                @endforelse
                            </tbody>
                        </table>           
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection