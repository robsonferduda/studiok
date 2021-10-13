@extends('layouts.evento')
@section('content')
    <section class="page-title bg-title overlay-dark">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="title">
                        <h3>{{ $atividade->sala->nm_sala_sal }}</h3>
                    </div>
                    <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{ url('eventos/ciki2021') }}">Home</a></li>
                    <li class="breadcrumb-item active">Salas</li>
                    <li class="breadcrumb-item active">{{ $atividade->sala->nm_sala_sal }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="section about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-6 align-self-center">                    
                    <iframe width="100%" height="600px" src="https://www.youtube.com/embed/NlGzgaPg5os" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="col-lg-12 col-md-6 align-self-center">
                    <h4 class="mb-1 mt-2"><strong></strong> {{ $atividade->nm_atividade_ati }}</h4>
                    <h6 class="mb-1 mt-2"><strong></strong> {{ $atividade->sala->nm_sala_sal }}</h6>
                    <p class="mb-1 mt-2"><strong>Início: </strong> {{ ($atividade->dt_inicio_atividade_ati) ? Carbon\Carbon::parse($atividade->inicio_atividade_ati)->format('d/m/Y H:i') : 'Não informada' }}</p>
                    <p class="mb-1"><strong>Término: </strong> {{ ($atividade->dt_termino_atividade_ati) ? Carbon\Carbon::parse($atividade->dt_termino_atividade_ati)->format('d/m/Y H:i') : 'Não informada' }}</p>
                    <p><strong>Resumo: </strong> {{ ($atividade->ds_atividade_ati) ? $atividade->ds_atividade_ati : 'Nenhum resumo cadastrado'}}</p>
                </div>
            </div>
        </div>
    </section>    
@endsection