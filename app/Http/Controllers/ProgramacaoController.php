<?php

namespace App\Http\Controllers;

use Auth;
use App\Evento;
use App\Atividade;
use App\AtividadeAcesso;
use Carbon\Carbon;
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
        $atividades = Atividade::where('id_evento_eve', $evento->id_evento_eve)->orderBy('dt_inicio_atividade_ati')->orderBy('nm_atividade_ati')->get();

        Session::put('edicao',$apelido);
        Session::put('evento',$evento);

        return view('programacao/index',compact('atividades'));
    }

    public function show($id)
    {
        $ati = Atividade::find($id);
        $sala = $ati->sala;

        /*
        $atividade = Atividade::where('id_sala_sal', $sala->id_sala_sal)
                            ->where('dt_inicio_atividade_ati','<',Carbon::now()->toDateTimeString())
                            ->where('dt_termino_atividade_ati', '>', Carbon::now()->toDateTimeString())
                            ->first();
        */

        $atividade = Atividade::where('id_sala_sal', $sala->id_sala_sal)
                                ->where('fl_corrente_ati','=', true)
                                ->first();

        $dados = array('id_usuario_usu' => Auth::user()->id,
                        'id_sala_ati' => $sala->id_sala_sal,
                        'id_atividade_ati' => $id);
     
        AtividadeAcesso::create($dados);
    
        return view('publico/evento/sala', compact('atividade','sala'));
    }

    public function enviarPergunta()
    {
        event(new SendMessage("Mensagem Teste",1));
    }
}