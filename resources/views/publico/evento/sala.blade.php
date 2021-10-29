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
                <div class="col-lg-12 col-md-12 align-self-center">   
                    <h4 class="mb-1 mt-2"><strong></strong> {{ $atividade->nm_atividade_ati }}</h4>   
                    <h6 class="mb-1 mt-2 mb-2"><strong></strong> {{ $atividade->sala->nm_sala_sal }}</h6>              
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 mt-1">                
                    <iframe width="100%" height="460px" src="{{ $atividade->sala->ds_local_sal }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card card-bordered">
                        <div class="card-header px-2 py-0">
                            <p class="mt-2 mb-2"><strong>Perguntas e Comentários</strong></p>
                        </div>
                        <div class="ps-container ps-theme-default ps-active-y" id="chat-content" data-atividade="{{ $atividade->id_atividade_ati }}" style="overflow-y: scroll !important; height:400px !important;">
                            @foreach($atividade->chat->sortBy('created_at') as $key => $chat)
                                <div class="media media-chat"> 
                                    
                                    <div class="media-body">
                                        <p><strong>{{ $chat->user->name }}</strong> {{ $chat->mensagem_cha }}</p>
                                    </div>
                                </div>                                
                            @endforeach
                            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                                <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 2px;">
                                <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 2px;"></div>
                            </div>
                        </div>
                        <div class="publisher bt-1 border-light"> 
                            <p data-letters="{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}"></p>
                            <input class="publisher-input" type="text" name="text_chat" id="text_chat" placeholder="Digite aqui..." autofocus>  
                            <a class="publisher-btn text-info" data-abc="true"><i class="fa fa-paper-plane"></i></a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>  
@endsection