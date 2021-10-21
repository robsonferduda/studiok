<div class="row" style="border-bottom: 1px solid #9e9e9e2e;">
    <div class="col-md-12 mb-2">
        @if(Session::get('evento') and Session::get('url') != 'home')
            <span class="evento_selecionado_label"> {{ Session::get('evento')->nm_evento_eve }} </span>
        @endif
    </div>
</div>