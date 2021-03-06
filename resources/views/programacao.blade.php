@extends('layouts.evento')
@section('content')
    <div class="col-lg-12 col-md-8 w-100">
        <h2 class="text-white text-center">Ciki 2021</h2>
    </div>
    <div class="col-lg-12 col-md-12 m-auto bg-white rd-12">
        <div class="text-center">
            <h5 class="mb-1 mt-3 pt-4">Programação</h5>
            @if(Auth::user() and Auth::user()->hasRole(['administrador']))
                @if(Session::get('evento')->fl_publicado_eve)
                    <h6 class="mb-3"><a href="{{ url('eventos', Session::get('evento')->ds_apelido_eve) }}" class="link-home">Hall de Entrada</a></h6>
                @else
                    <h6 class="mb-3"><a href="{{ url('temporario', Session::get('evento')->ds_apelido_eve) }}" class="link-home">Hall de Entrada</a></h6>
                @endif
            @else
                <h6 class="mb-3"><a href="{{ url('eventos', Session::get('evento')->ds_apelido_eve) }}" class="link-home">Hall de Entrada</a></h6>
            @endif
        </div>
        <div class="row">
            <div class="col-12 schedule">
                <div class="schedule-tab">
                    <ul class="nav nav-pills text-center" >
                        @php
                            $periodo = Carbon\CarbonPeriod::create(Carbon\Carbon::parse($evento->dt_inicio_eve)->format('Y-m-d'), Carbon\Carbon::parse($evento->dt_fim_eve)->format('Y-m-d'));
                        @endphp
                        @foreach ($periodo as $key => $date) 
                            <li class="nav-item">
                                <a class="nav-link {{ ($key == 0) ? 'active' : '' }}" href="#box{{ $key+1 }}"  data-toggle="pill" style="border-radius: 0px !important;">
                                    DIA {{ $key+1 }}
                                    <span>{{ $date->format('d') }} DE {{ App\Utils::validaMes(Carbon\Carbon::parse($date)->format('m')) }} DE {{ $date->format('Y') }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="schedule-contents bg-schedule">
                    <div class="tab-content" id="pills-tabContent">
                        @foreach ($periodo as $key => $date)
                            <div class="tab-pane fade show schedule-item {{ ($key == 0) ? 'active' : '' }}" id="box{{ $key+1 }}">
                                <ul class="m-0 p-0">
                                    <li class="headings">
                                        <div class="time">Início</div>
                                        <div class="subject">Título</div>
                                        <div class="speaker"></div>					  			
                                        <div class="venue">Local</div>
                                    </li>

                                    @foreach($atividades->whereBetween('dt_inicio_atividade_ati', [$date->format('Y-m-d'), $date->addDays(1)->format('Y-m-d')]) as $atividade)
                                        <li class="schedule-details">
                                            <div class="block">
                                                <div class="time valign-top">
                                                    <i class="fa fa-clock-o"></i>
                                                    <span class="time">
                                                        {{ Carbon\Carbon::parse($atividade->dt_inicio_atividade_ati)->format('H:i') }} -
                                                        {{ Carbon\Carbon::parse($atividade->dt_termino_atividade_ati)->format('H:i') }}
                                                    </span>
                                                </div>
                                                <div class="subject valign-top">{{ $atividade->nm_atividade_ati }}</div>
                                                <div class="speaker">
                                                    @if(count($atividade->palestrantes))
                                                        Convidados
                                                    @endif
                                                    @foreach($atividade->palestrantes as $key => $palestrante)
                                                        <p>{{ $palestrante->ds_tratamento_pal }} {{ $palestrante->pessoa->nm_pessoa_pes }}</p>                          
                                                    @endforeach										
                                                </div>											
                                                <div class="venue valign-top"><a href="{{ url('programacao/sala/atividade/'.$atividade->id_atividade_ati) }}" class="link-programacao">{{ ($atividade->sala) ? $atividade->sala->nm_sala_sal : '' }}</a></div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection