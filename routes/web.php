<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::get('/eventos/{evento}', 'HomeController@show');
Route::get('home', 'HomeController@dashboard');
Route::get('dashboard', 'HomeController@dashboard');
Route::get('programacao/sala/atividade/{id}','ProgramacaoController@show');

Auth::routes();

Route::get('estatisticas','EstatisticaController@index');

Route::get('participante/importar','ParticipanteController@importar');
Route::post('participante/importacao','ParticipanteController@importacao');

Route::get('programacao','ProgramacaoController@index');
Route::get('programacao/mensagem','ProgramacaoController@enviarPergunta');

Route::post('palestrante/perfil/foto-upload','PalestranteController@uploadFoto');

Route::resource('sala', 'SalaController');
Route::resource('evento', 'EventoController');
Route::resource('atividade', 'AtividadeController');
Route::resource('palestrante', 'PalestranteController');
Route::resource('participante', 'ParticipanteController');