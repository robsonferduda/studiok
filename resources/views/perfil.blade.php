@extends('layouts.conferencia')
@section('content')
    <div class="col-lg-12 col-md-12 m-auto bg-white p-5" style="border-radius: 12px;">
        <div class="row">
            <h5 class="ml-3">Meus Dados</h5>
        </div>
        <p><strong>Nome</strong>: {{ Auth::user()->name }}</p>
        <p><strong>Email</strong>: {{ Auth::user()->email }}</p>
        <p><strong>Membro desde</strong>: {{ date('d/m/Y H:i', strtotime(Auth::user()->created_at)) }}</p>
    </div>
@endsection