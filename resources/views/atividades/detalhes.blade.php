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
                        <p class="mb-1"><strong>Data/Hora Início: </strong> {{ ($atividade->dt_inicio_atividade_ati) ? Carbon\Carbon::parse($atividade->inicio_atividade_ati)->format('d/m/Y H:i') : 'Não informada' }}</p>
                        <p class="mb-1"><strong>Data/Hora Término: </strong> {{ ($atividade->dt_termino_atividade_ati) ? Carbon\Carbon::parse($atividade->dt_termino_atividade_ati)->format('d/m/Y H:i') : 'Não informada' }}</p>
                        <p><strong>Resumo: </strong> {{ ($atividade->ds_atividade_ati) ? $atividade->ds_atividade_ati : 'Nenhum resumo cadastrado'}}</p>
                    </div>
                    <div class="col-md-4">
                        <h6>Palestrantes</h6>
                        @forelse($atividade->palestrantes as $key => $palestrante)
                            <div class="row mt-3 hover-overlay">
                                <div class="col-md-3">
                                    @if($palestrante->path_imagem_pal)
                                        <img src="{{ url('/storage//profile_pictures/'.$palestrante->path_imagem_pal) }}" />
                                    @else
                                        <img src="{{ url('img/icon-cam.png') }}" />
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <p class="mb-1">{{ $palestrante->pessoa->nm_pessoa_pes }}</p>
                                    <p class="mb-1">{{ $palestrante->pessoa->ds_email_pes }}</p>
                                </div>
                            </div>                           
                        @empty
                            <p>Nenhum palestrante cadastrado</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection