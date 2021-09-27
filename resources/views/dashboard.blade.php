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
                      <p class="card-category">Salas</p>
                      <p class="card-title">8<p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <a href="{{ url('sala/create') }}">
                    Adicionar Sala
                  </a> 
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="fa fa-graduation-cap text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Palestrantes</p>
                      <p class="card-title">5<p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <a href="{{ url('palestrante/create') }}">                    
                      Adicionar Palestrante
                  </a>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-badge text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Participantes</p>
                      <p class="card-title">13<p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-clock-o"></i>
                  Atualizado em 22/08/2020 12:32
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-calendar-60 text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Programação</p>
                      <p class="card-title">15<p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-calendar-o"></i>
                  Próximo em 20/11/2021 18:00
                </div>
              </div>
            </div>
          </div>  
        </div>   
        <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Palestras Mais Acessadas</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class="">
                      <tr><th>
                        Data
                      </th>
                      <th>
                        Título
                      </th>
                      <th>
                        Local
                      </th>
                      <th class="text-right">
                        Palestrantes
                      </th>
                    </tr></thead>
                    <tbody>
                      <tr>
                        <td>
                          11/11/2021 18:00
                        </td>
                        <td>
                          O Fonômeno do Big Data
                          <span class="badge badge-pill badge-primary">Presencial</span>
                        </td>
                        <td>
                          Sala Garapuvu 
                        </td>
                        <td class="text-right">
                          John Doe
                        </td>
                      </tr>
                      <tr>
                        <td>
                          12/11/2021 18:00
                        </td>
                        <td>
                          Trabalhando com Ontologias
                          <span class="badge badge-pill badge-danger">Online</span>
                        </td>
                        <td>
                          Sala Joaquina 
                        </td>
                        <td class="text-right">
                          Monteiro Lobato
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>  
        </div>
@endsection