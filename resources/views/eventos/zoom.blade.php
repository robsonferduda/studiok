@extends('layouts.evento')
@section('content')
    <div class="col-lg-12 col-md-8 w-100">
        <h2 class="text-white text-center">{{ Session::get('evento')->nm_evento_eve }}</h2>
    </div>
    <div class="col-lg-12 col-md-12 m-auto bg-white rd-12 p-3">
        <div class="text-center">
            <h5 class="mb-1">Endereços Zoom</h5>
            <h6 class="mb-3"><a class="link-home" href="{{ url('eventos', Session::get('evento')->ds_apelido_eve) }}">Hall de Entrada</a></h6>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-8">
                <p>
                    <strong>Atenção!</strong><br/>
                    As salas das apresentações de trabalhos mudaram por motivos operacionais.
                    Trocaremos o Zoom pela Conferência Web.                    
                    Todos devem entrar em <a class="link-home" href="https://conferenciaweb.rnp.br/webconf/ciki-2021-apresentacoes" target="_BLANK">https://conferenciaweb.rnp.br/webconf/ciki-2021-apresentacoes</a>
                </p>
            </div>
            <!--
            <iframe src="{{ asset('pdf/enderecos_zoom.pdf') }}" width="95%" height="800">
                    This browser does not support PDFs. Please download the PDF to view it: <a href="{{ asset('pdf/enderecos_zoom.pdf') }}">Download</a>
            </iframe>
            -->
        </div>
    </div>
@endsection