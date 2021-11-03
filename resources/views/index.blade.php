@extends('layouts.guest')
@section('content')
          <div class="row">
            <div class="col-lg-4 col-md-6 mr-auto">
              <div class="card card-signup text-center">
        
                <div class="card-body ">
                  <h5>Próximos Eventos</h5>
                  <a href="{{ url('eventos/seminario-studiok') }}"><img src="img/workshop-egc.jpeg"></a>
                </div>
                <hr/>
                <div class="card-footer mt-0">
                  @if(Auth::user())
                    <a href="{{ url('dashboard') }}" class="btn btn-info"><i class="fa fa-check"></i> Inscreva-se</a>
                    <a href="{{ url('eventos/12-workshop-egc') }}" class="btn btn-warning"><i class="fa fa-lock"></i> Acesse</a>
                  @else
                    <a href="{{ url('login') }}" class="btn btn-info"><i class="fa fa-check"></i> Inscreva-se</a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        
@endsection