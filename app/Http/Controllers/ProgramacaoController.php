<?php

namespace App\Http\Controllers;

use App\Atividade;
use Illuminate\Http\Request;
use App\Events\Programacao\SendMessage;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;

class ProgramacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
        Session::put('url','programacao');
    }

    public function index()
    {
        $atividades = Atividade::orderBy('dt_inicio_atividade_ati')->get();
        return view('programacao/index',compact('atividades'));
    }

    public function listar($apelido)
    {
        $atividades = Atividade::orderBy('dt_inicio_atividade_ati')->get();
        Session::put('edicao',$apelido);

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