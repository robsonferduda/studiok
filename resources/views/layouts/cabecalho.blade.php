<div class="row">
    <div class="col-md-12 mb-2">
        @if(Session::get('evento') and Session::get('url') != 'home')
            <span class="evento_selecionado_label"> {{ Session::get('evento')->nm_evento_eve }} </span>
        @endif
    </div>
</div>