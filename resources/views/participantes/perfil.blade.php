@extends('layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="card card-user">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title"><i class="nc-icon nc-badge"></i> Participantes</h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('participante') }}" class="btn btn-default pull-right" style="margin-right: 12px;"><i class="fa fa-table"></i> Participantes</a>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
              <div class="row">
                <div class="col-md-12">
                    <h6 class="w-auto">Dados Pessoais</h6>
                    <p class="mb-1"><strong>CPF: </strong>{{ ($participante->nu_cpf_par ) ? $participante->nu_cpf_par : 'Não informado' }}</p>
                    <p class="mb-1"><strong>ORCID: </strong>{{ ($participante->pessoa->nu_orcid_pes) ? $participante->pessoa->nu_orcid_pes : 'Não informado' }}</p>
                    <p class="mb-1"><strong>Nome: </strong>{{ $participante->pessoa->nm_pessoa_pes }}</p>
                    <p class="mb-1"><strong>Nome Crachá: </strong>{{ $participante->nm_cracha_par }}</p>
                    <p><strong>Data de Cadastro: </strong>{{ date('d/m/Y H:i:s', strtotime($participante->created_at)) }}</p>
                </div>
                
                <div class="col-md-12 mt-3">
                    <h6  class="w-auto">Dados de Acesso</h6>
                    <p class="mb-1"><strong>Email: </strong>{{ $participante->pessoa->ds_email_pes }}</p>
                    <p>
                      <strong>Nível: </strong>
                      @forelse($participante->pessoa->user->roles as $role)
                        <span>{{ $role->display_name }}</span>
                      @empty

                      @endforelse
                    </p>
                </div>

                <div class="col-md-12 mt-3">
                    <h6 class="w-auto">Participação em Eventos</h6>
                      <table class="table">
                        <thead>
                          <tr>
                            <th class="w-25">Data de Inscrição</th>
                            <th class="w-50">Evento</th>
                            <th class="text-center">Opções</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($participante->eventos as $key => $evento)
                            <tr>
                              <td>{{ date('d/m/Y H:i:s', strtotime($evento->pivot->created_at)) }}</td>
                              <td>{{ $evento->nm_evento_eve }}</td>
                              <td class="text-center"><a title="Excluir participação no evento" href="{{ url('participante/'.$participante->id_participante_par.'/evento/'.$evento->id_evento_eve) }}" class="btn btn-danger btn-link btn-icon button-remove-evento"><i class="fa fa-times fa-2x"></i></a></td>
                            </tr>
                          @endforeach        
                        </tbody>
                      </table>
                </div>

              </div>
                  
              <div class="row">
                <div class="update ml-auto mr-auto">
                  <a href="{{ route('participante.edit',$participante->id_participante_par) }}" class="btn btn-primary btn-round"><i class="fa fa-edit"></i> Editar Perfil</a>
                </div>
              </div>
            </div>
        </div>
    </div> 
@endsection