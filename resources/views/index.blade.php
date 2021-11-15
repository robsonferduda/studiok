@extends('layouts.guest')
@section('content')
  <div class="row">
    <div class="col-lg-4 col-md-6 mr-auto">
        <div class="card card-signup text-center">
          <div class="card-body">
            <a href="{{ url('eventos/ciki-2021') }}"><img src="img/eventos/ciki_2021.jpeg"></a>
          </div>
          <hr/>
          <div class="card-footer mt-0">
            @if(Auth::user())
              @if(count($meus_eventos))
                <a href="{{ url('eventos/ciki-2021') }}" class="btn btn-warning"><i class="fa fa-lock"></i> Acesse</a>
              @else
                <a href="{{ url('dashboard') }}" class="btn btn-info"><i class="fa fa-check"></i> Inscreva-se</a>
              @endif
            @else
              <a href="{{ url('eventos/ciki-2021') }}" class="btn btn-warning"><i class="nc-icon nc-tag-content"></i> Acesse</a>
              <a href="{{ url('primeiro-acesso') }}" class="btn btn-primary"><i class="fa fa-lock"></i> Primeiro Acesso</a>
            @endif
          </div>
        </div>
    </div>
  </div>        
@endsection