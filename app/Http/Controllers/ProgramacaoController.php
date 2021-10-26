<?php

namespace App\Http\Controllers;

use App\Evento;
use App\Atividade;
use Illuminate\Http\Request;
use App\Events\Programacao\SendMessage;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;

class ProgramacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        Session::put('url','programacao');
    }

    public function index()
    {
        $atividades = Atividade::orderBy('dt_inicio_atividade_ati')->get();
        return view('programacao/index',compact('atividades'));
    }

    public function listar($apelido)
    {
        $evento = Evento::where('ds_apelido_eve',$apelido)->first();
        $atividades = Atividade::where('id_evento_eve', $evento->id_evento_eve)->orderBy('dt_inicio_atividade_ati')->get();

        Session::put('edicao',$apelido);
        Session::put('evento',$evento);

        return view('programacao/index',compact('atividades'));
    }

    public function show($id)
    {
        $atividade = Atividade::find($id);
        return view('publico/evento/sala', compact('atividade'));
    }

    public function enviarPergunta()
    {
        event(new SendMessage("Mensagem Teste",1));
    }
}