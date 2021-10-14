<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::get('/eventos', 'HomeController@eventos');
Route::get('/eventos/{evento}', 'HomeController@show');
Route::get('/eventos/{evento}/programacao', 'HomeController@programacao');
Route::get('/eventos/{evento}/palestrantes', 'HomeController@palestrantes');
Route::get('/eventos/{evento}/stand-virtual', 'HomeController@stand');
Route::get('home', 'HomeController@dashboard');
Route::get('dashboard', 'HomeController@dashboard');
Route::get('programacao/sala/atividade/{id}','ProgramacaoController@show');

Auth::routes();

Route::get('estatisticas','EstatisticaController@index');

Route::get('participante/importar','ParticipanteController@importar');
Route::post('participante/importacao','ParticipanteController@importacao');
Route::post('participante/cadastro','ParticipanteController@cadastro');

Route::get('programacao','ProgramacaoController@index');
Route::get('programacao/mensagem','ProgramacaoController@enviarPergunta');
Route::get('atividade/atividades-paralelas/{atividade}','AtividadeController@paralelas');
Route::post('atividade/paralela/salvar','AtividadeController@salvarAtividadesParalelas');

Route::post('palestrante/perfil/foto-upload','PalestranteController@uploadFoto');

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