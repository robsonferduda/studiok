@extends('layouts.guest')
@section('content')
  <div class="row">
    <div class="col-lg-6 col-md-6 mr-auto">
        <div class="card card-signup text-center">
          <div class="card-body">
            <a href="{{ url('eventos/ciki-2021') }}"><img src="img/eventos/ciki_2021.jpeg"></a>
          </div>
          <hr/>
          <div class="card-footer mt-0">
            @if(Auth::user())
              <a href="{{ url('eventos/ciki-2021') }}" class="btn btn-warning"><i class="fa fa-paper-plane"></i> Acesse</a>
            @else
              <a href="{{ url('eventos/ciki-2021') }}" class="btn btn-warning"><i class="fa fa-paper-plane"></i> Acesse</a>
              <a href="{{ url('primeiro-acesso') }}" class="btn btn-primary"><i class="fa fa-lock"></i> Primeiro Acesso</a>
            @endif
          </div>
        </div>
    </div>
  </div>        
@endsection