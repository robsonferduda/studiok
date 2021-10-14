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
						<h6>18-19 de Novembro de 2020</h6>
						<a href="#" class="btn btn-white-md">Assistir ao Vivo</a>
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
						<h3>Programação do Evento</h3>
						<p>Confira a programação e fique por dentro de tudo que acontece no evento!</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="schedule-tab">
						<ul class="nav nav-pills text-center">
						<li class="nav-item">
							<a class="nav-link active" href="#nov20" data-toggle="pill">
								DIA 01
								<span>10 DE OUTUBRO DE 2021</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#nov21" data-toggle="pill">
								DIA 02
								<span>11 DE OUTUBRO DE 2021</span>
							</a>
						</li>
						</ul>
					</div>
					<div class="schedule-contents bg-schedule">
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active schedule-item" id="nov20">
								<ul class="m-0 p-0">
									<li class="headings">
										<div class="time">Início</div>
										<div class="subject">Título</div>
										<div class="speaker"></div>					  			
										<div class="venue">Local</div>
									</li>
									@foreach($atividades as $atividade)
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
							<div class="tab-pane fade schedule-item" id="nov21">
								<ul class="m-0 p-0">
									<li class="headings">
										<div class="time">Início</div>
										<div class="subject">Título</div>
										<div class="speaker"></div>					  			
										<div class="venue">Local</div>
									</li>
									@foreach($atividades as $atividade)
											<li class="schedule-details">
												<div class="block">
													<div class="time">
														<i class="fa fa-clock-o"></i>
														<span class="time">{{ Carbon\Carbon::parse($atividade->dt_inicio_atividade_ati)->format('H:i') }}</span>
													</div>
													<div class="subject">{{ $atividade->nm_atividade_ati }}</div>
													<div class="speaker">
														@if(count($atividade->palestrantes))
															Convidados
														@endif
														@foreach($atividade->palestrantes as $key => $palestrante)
															<p>{{ $palestrante->ds_tratamento_pal }} {{ $palestrante->pessoa->nm_pessoa_pes }}</p>                          
														@endforeach										
													</div>											
													<div class="venue"><a href="{{ url('programacao/sala/atividade/'.$atividade->id_atividade_ati) }}">{{ $atividade->sala->nm_sala_sal }}</a></div>
												</div>
											</li>
									@endforeach
								</ul>
							</div>
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