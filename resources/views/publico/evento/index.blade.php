@extends('layouts.evento')
@section('content')
	<section class="banner bg-banner-one overlay">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="block">
						<div class="timer"></div>
						<h1>{{ $evento->nm_evento_eve }}</h1>
						<h2>Conferência Online</h2>
						<h6>{{ Carbon\Carbon::parse($evento->dt_inicio_eve)->format('d') }} - {{ Carbon\Carbon::parse($evento->dt_fim_eve)->format('d') }} de {{ App\Utils::validaMes(Carbon\Carbon::parse($evento->dt_fim_eve)->format('m')) }} de {{ Carbon\Carbon::parse($evento->dt_fim_eve)->format('Y') }}</h6>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="section schedule">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h3>Palestrantes</h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<section class="customer-logos slider">
						@foreach($palestrantes as $p)
							<div class="slide">
								<img src="{{ url('/profile_pictures/'.$p->path_imagem_pal) }}">
								<h6>{{ $p->pessoa->nm_pessoa_pes }}</h6>
								{{ $p->ds_empresa_pal }}
								{{ $p->ds_cargo_pal }}
							</div>
						@endforeach
					 </section>
				</div>
			</div>
		</div>
	</section>

	<section class="section schedule">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h3>Programação do Evento</h3>
						<p>Confira a programação e fique por dentro de tudo que acontece no evento!</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="schedule-tab">
						<ul class="nav nav-pills text-center">
							@php
								$periodo = Carbon\CarbonPeriod::create(Carbon\Carbon::parse($evento->dt_inicio_eve)->format('Y-m-d'), Carbon\Carbon::parse($evento->dt_fim_eve)->format('Y-m-d'));
							@endphp
							@foreach ($periodo as $key => $date) 
								<li class="nav-item">
									<a class="nav-link {{ ($key == 0) ? 'active' : '' }}" href="#box{{ $key+1 }}"  data-toggle="pill">
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

										@foreach($atividades->whereBetween('dt_inicio_atividade_ati', [$date->format('Y-m-d'), $date->addDays(1)->format('Y-m-d')])->sortBy('dt_inicio_atividade_ati') as $atividade)
											<li class="schedule-details">
												<div class="block">
													<div class="time valign-top">
														<i class="fa fa-clock-o"></i>
														<span class="time">{{ Carbon\Carbon::parse($atividade->dt_inicio_atividade_ati)->format('H:i') }}</span>
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
													<div class="venue  valign-top"><a href="{{ url('programacao/sala/atividade/'.$atividade->id_atividade_ati) }}">{{ $atividade->sala->nm_sala_sal }}</a></div>
												</div>
											</li>
										@endforeach
									</ul>
								</div>
							@endforeach
						</div>
					</div>
					<div class="download-button text-center">
						<a href="#" class="btn btn-main-md">Baixar Programação</a>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection