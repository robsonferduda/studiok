<?php

namespace App\Http\Controllers;

use Auth;
use App\Sala;
use App\Evento;
use App\Certificado;
use App\Participante;
use App\Palestrante;
use App\Atividade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show','programacao','palestrantes','stand']]);
        Session::put('url','home');
    }

    public function index()
    {
        return view('index');
    }

    public function eventos()
    {
        $eventos = Evento::all();
        return view('publico/evento/listar', compact('eventos'));
    }

    public function dashboard()
    {       
        $sala = new Sala();
        $atividade = new Atividade();
        $palestrante = new Palestrante();
        $participante = new participante();
        $meus_eventos = array();
        $programacao = array();

        if(Auth::user()->hasRole('administrador')){
            $meus_eventos = Evento::all();
        }

        if(Auth::user()->hasRole('participante')){

            $p = Participante::where('id_pessoa_pes', Auth::user()->id_pessoa_pes)->first();
            if($p){
                $meus_eventos = $p->eventos;
                $evento = Evento::find(1);
                $programacao = $evento->atividades->sortBy('dt_inicio_atividade_ati');
            }
        }   
        
        Session::put('meus_eventos', $meus_eventos);

        return view('dashboard', compact('sala','palestrante','participante','atividade','meus_eventos','programacao'));
    }

    public function show($e)
    {       
        $evento = Evento::where('ds_apelido_eve',$e)->first();
        Session::put('evento',$evento);
        $atividades = Atividade::all();
        return view('publico/evento/index',compact('evento','atividades'));
    }

    public function programacao($e)
    {      
        $evento = Evento::where('ds_apelido_eve',$e)->first();
        Session::put('evento',$evento);
        $atividades = Atividade::all();
        return view('publico/evento/index',compact('evento','atividades'));
    }

    public function palestrantes($e)
    {       
        $evento = Evento::where('ds_apelido_eve',$e)->first();
        Session::put('evento',$evento);
        $atividades = Atividade::all();
        return view('publico/evento/index',compact('evento','atividades'));
    }

    public function stand($e)
    {       
        $evento = Evento::where('ds_apelido_eve',$e)->first();
        Session::put('evento',$evento);
        $atividades = Atividade::all();
        return view('publico/evento/index',compact('evento','atividades'));
    }
}