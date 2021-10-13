@extends('layouts.evento')
@section('content')
    <section class="page-title bg-title overlay-dark">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="title">
                        <h3>StudioK</h3>
                    </div>
                    <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item"><a href="index.html">Eventos</a></li>
                    <li class="breadcrumb-item active">Todos</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="row d-flex justify-content-center mt-100 mb-100">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body text-center">
                    <h4 class="card-title m-b-0">Eventos Disponíveis</h4>
                </div>
                <ul class="list-style-none">
                    @foreach($eventos as $key => $evento)
                        <li class="d-flex no-block card-body"> 
                            <div>
                                <h3><a class="font-30" href="{{ url('eventos/'.$evento->ds_apelido_eve) }}">{{ $evento->nm_evento_eve }}</a></h3> 
                            </div>
                            <div class="ml-auto">
                                <div class="text-right">
                                    <h5 class="text-muted m-b-0">{{ Carbon\Carbon::parse($evento->dt_inicio_eve)->format('d') }}</h5> <span class="text-muted font-16">{{ Carbon\Carbon::parse($evento->dt_fim_eve)->format('M') }}</span>
                                </div>
                            </div>
                        </li>                        
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="mb-100">
    </div>
@endsection