<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::get('cadastrar', 'ParticipanteController@cadastrar');
Route::get('/eventos', 'HomeController@eventos');
Route::get('/eventos/{evento}', 'HomeController@show');
Route::get('/temporario/{evento}', 'HomeController@temporario');
Route::get('/eventos/{evento}/programacao', 'HomeController@programacao');
Route::get('/eventos/{evento}/palestrantes', 'HomeController@palestrantes');
Route::get('/eventos/{evento}/stand-virtual', 'HomeController@stand');
Route::get('home', 'HomeController@dashboard');
Route::get('dashboard', 'HomeController@dashboard');
Route::get('programacao/sala/atividade/{id}','ProgramacaoController@show');
Route::get('perfil', 'UserController@perfil');
Route::get('primeiro-acesso', 'UserController@primeiroAcesso');
Route::get('meus-eventos', 'HomeController@meusEventos');

Auth::routes();

Route::get('auditoria','AuditoriaController@index');
Route::get('auditoria/{id}','AuditoriaController@show');

Route::get('estatisticas','EstatisticaController@index');

Route::get('sala/transmissao/atual/{sala}', 'SalaController@getSalaAtual');

Route::get('participante/{participante}/situacao/{situacao}','ParticipanteController@alterarSituacao');
Route::get('participante/importar','ParticipanteController@importar');
Route::get('participante/senha/resetar/{usuario}','ParticipanteController@resetar'); 
Route::get('participante/{participante}/evento/{evento}','ParticipanteController@excluirParticipacaoEvento');
Route::post('participante/importacao','ParticipanteController@importacao');
Route::post('participante/cadastro','ParticipanteController@cadastro');

Route::get('eventos/{evento}/contato','EventoController@contato');
Route::get('eventos/{evento}/sala/{sala}','SalaController@sala');
Route::get('eventos/{evento}/inscricao','EventoController@inscricao');

Route::get('salas/{evento}','SalaController@listar');
Route::get('palestrantes/{evento}','PalestranteController@listar');
Route::get('participantes/{evento}','ParticipanteController@listar');
Route::get('programacao/{evento}','ProgramacaoController@listar');

Route::get('programacao','ProgramacaoController@index');
Route::get('programacao/mensagem','ProgramacaoController@enviarPergunta');
Route::get('atividade/atividades-paralelas/{atividade}','AtividadeController@paralelas');
Route::post('atividade/paralela/salvar','AtividadeController@salvarAtividadesParalelas');

Route::post('palestrante/perfil/foto-upload','PalestranteController@uploadFoto');

Route::post('atividades/chat/salvar','AtividadeController@salvarChat');
Route::get('atividades/{atividade}/chat','AtividadeController@getChat');
Route::get('atividade/situacao/{id}','AtividadeController@atualizaStatus');

Route::get('permissoes','PermissaoController@index');
Route::get('perfis','RoleController@index');
Route::get('usuarios','UserController@index');
Route::get('role/permissions/{role}','RoleController@permissions');

Route::resource('role', 'SalaController');
Route::resource('sala', 'SalaController');
Route::resource('evento', 'EventoController');
Route::resource('atividade', 'AtividadeController');
Route::resource('atividadeparalela', 'AtividadeParalelaController');
Route::resource('palestrante', 'PalestranteController');
Route::resource('participante', 'ParticipanteController');
Route::resource('permissions', 'PermissionController');