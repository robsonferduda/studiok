@extends('layouts.app')
@section('content')
<div class="row"> 
    <div class="col-lg-3 col-md-3 col-sm-12">  
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="nc-icon nc-tv-2 text-warning"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Percentual de Acessos</p>
                <p class="card-title">{{ '15%' }}<p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <i class="fa fa-clock-o"></i>
            Atualizado em {{ Carbon\Carbon::now()->format('d/m/Y H:i:s') }}  
          </div>
        </div>
      </div>
    </div>
</div>    
@endsection