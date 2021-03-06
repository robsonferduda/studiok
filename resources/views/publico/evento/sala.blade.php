@extends('layouts.sala')
@section('content')
    <div class="col-lg-12 col-md-8 w-100">
        <h2 class="text-white text-center">Ciki 2021</h2>
    </div>
    <div class="col-lg-12 col-md-12 m-auto bg-white rd-12">
        @if($atividade)
            <div class="row">
                <div class="col-lg-12 col-md-12 align-self-center">  
                    <input type="hidden" id="id_atividade_ati" value="{{ $atividade->id_atividade_ati }}"> 
                    <h4 class="mb-1 mt-2 mb-0"><strong class="lbl_sala">{{ $atividade->sala->nm_sala_sal }}</strong> <span class="lbl_atividade">{{ $atividade->nm_atividade_ati }}</span></h4> 
                    <h4 class="mb-1 mt-0"><strong></strong> </h4>  
                    <div>
                        <p class="lbl_hora">Atividade iniciada em {{ Carbon\Carbon::parse($atividade->dt_inicio_atividade_ati)->format('d/m/Y H:i') }} e término em {{ Carbon\Carbon::parse($atividade->dt_termino_atividade_ati)->format('d/m/Y H:i') }}</p>
                        <span class="badge badge-success lbl_status">ONLINE</span>      
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 mt-1">  
                    <input type="hidden" id="id_sala_sal" value="{{ $atividade->sala->id_sala_sal }}">              
                    <iframe width="100%" height="460px" src="{{ $atividade->sala->ds_local_sal }}" title="YouTube Video Player" frameborder="0" autoplay="1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <div class="mt-2 mb-3" style="display: none;">
                        <p>Conferencistas</p>
                        @foreach($atividade->palestrantes as $key => $palestrante)
                            <div class="row mt-3 hover-overlay">
                                <div class="col-md-2 text-center">
                                    @if($palestrante->path_imagem_pal)
                                        <img src="{{ url('/profile_pictures/'.$palestrante->path_imagem_pal) }}" />
                                    @else
                                        <img src="{{ url('img/icon-cam.png') }}" />
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <p><strong>{{ $palestrante->ds_tratamento_pal }} {{ $palestrante->pessoa->nm_pessoa_pes }}</strong></p> 
                                    <p>{{ $palestrante->ds_empresa_pal }}</p> 
                                    <p>{{ $palestrante->ds_cargo_pal }}</p>
                                </div>
                            </div>                        
                        @endforeach	
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card card-bordered">
                        <div class="card-header px-2 py-0 border-b-gray">
                            <p class="mt-2 mb-2"><strong>Perguntas e Comentários</strong></p>
                        </div>
                        <div class="ps-container ps-theme-default ps-active-y" id="chat-content" data-atividade="{{ $atividade->id_atividade_ati }}" style="overflow-y: scroll !important; height:400px !important;">
                            @foreach($atividade->chat->sortBy('created_at') as $key => $chat)
                                <div class="media media-chat" style="padding: 0px !important; padding-right: 8px !important;">                                     
                                    <div class="media-body">
                                        <p class="font-12"><strong>{{ $chat->user->name }}</strong> {{ $chat->mensagem_cha }}</p>
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
                        @if(Auth::user())
                            <div class="publisher bt-1 border-light"> 
                                <input class="publisher-input" type="text" name="text_chat" id="text_chat" placeholder="Digite aqui...">  
                                <a class="publisher-btn text-info" data-abc="true"><i class="fa fa-paper-plane"></i></a> 
                            </div>
                        @endif
                    </div>
                    <div class="text-center mt-2 mb-2">
                        <a href="{{ url('eventos',Session::get('evento')->ds_apelido_eve) }}" class="btn btn-main-md">Hall de Entrada</a>
                    </div>
                </div>
        @else
                <div class="row">
                    <div class="col-lg-12 col-md-12 align-self-center">    
                        <h4 class="mb-1 mt-2 mb-2"><strong></strong> {{ $sala->nm_sala_sal }}</h4> 
                        <span class="badge badge-danger">OFFLINE</span>
                        <p class="mt-2">A sala não possui programação AO VIVO no momento.</p>
                        <hr/>           
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        @if($sala->atividades)
                            @foreach($sala->atividades->sortBy('dt_inicio_atividade_ati') as $key => $atividade)
                                <div class="row mb-1">
                                    <div class="col-lg-12 col-md-12">
                                        <div style="float: left;">
                                            <p>{{ ($atividade->dt_inicio_atividade_ati) ? Carbon\Carbon::parse($atividade->dt_inicio_atividade_ati)->format('d/m/Y H:i') : 'Não informada' }} - </p>
                                        </div>
                                        <div class="ml-1" style="float: left;">
                                            <p><strong>{{ $atividade->nm_atividade_ati }}</strong></p>
                                            @foreach($atividade->palestrantes as $key => $palestrante)
                                                <p>{{ $palestrante->ds_tratamento_pal }} {{ $palestrante->pessoa->nm_pessoa_pes }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-lg-12 col-md-8">
                    <div class="download-button text-center">
                        <a href="{{ url('eventos',Session::get('evento')->ds_apelido_eve) }}" class="btn btn-main-md">Hall de Entrada</a>
                        <a href="{{ url('eventos/'.Session::get('evento')->ds_apelido_eve.'/programacao') }}" class="btn btn-main-md">Programação</a>
                    </div>
                </div>
        @endif
        </div>
    </div>
@endsection