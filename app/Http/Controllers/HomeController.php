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
        //$evento = Evento::where('ds_apelido_eve',$e)->first();
        //Session::put('evento',$evento);
        $atividades = Atividade::all();
        $meus_eventos = array();

        if(Auth::user() and Auth::user()->hasRole('participante')){

            $p = Participante::where('id_pessoa_pes', Auth::user()->id_pessoa_pes)->first();
            
            if($p){

                $eventos_participante = $p->eventos->pluck('id_evento_eve')->toArray();
                $eventos = Evento::whereNotIn('id_evento_eve', $eventos_participante)->where('fl_publicado_eve', true)->get();

                $meus_eventos = $p->eventos;
                $evento = Evento::find(1);
                $programacao = $evento->atividades->sortBy('dt_inicio_atividade_ati');
            }

        } 

        //return view('seminario');
        return view('index', compact('meus_eventos'));
    }

    public function eventos(){
    
        $eventos = Evento::all();
        return view('publico/evento/listar', compact('eventos'));
    }

    public function meusEventos()
    {
        $sala = new Sala();
        $atividade = new Atividade();
        $palestrante = new Palestrante();
        $participante = new Participante();
        $meus_eventos = array();
        $programacao = array();
        $eventos = array();
        $msg = "";

        $p = Participante::where('id_pessoa_pes', Auth::user()->id_pessoa_pes)->first();
            
        if($p){
            $eventos_participante = $p->eventos->pluck('id_evento_eve')->toArray();
            $eventos = Evento::whereNotIn('id_evento_eve', $eventos_participante)->where('dt_fim_eve', '<', date('Y-m-d') )->where('fl_publicado_eve', true)->get();

            $meus_eventos = $p->eventos;
            $evento = Evento::find(1);
            $programacao = $evento->atividades->sortBy('dt_inicio_atividade_ati');

        }else{
            $msg = "Voc?? n??o est?? cadastrado como participante e n??o possui v??nculos em eventos";
        }

        Session::put('meus_eventos', $meus_eventos);
        return view('painel', compact('sala','palestrante','participante','atividade','meus_eventos','programacao','eventos','msg')); 
        
    }

    public function dashboard()
    {       
        $sala = new Sala();
        $atividade = new Atividade();
        $palestrante = new Palestrante();
        $participante = new Participante();
        $meus_eventos = array();
        $programacao = array();
        $eventos = array();
        $msg = "";

        if(Auth::user()->hasRole('administrador')){
            $eventos = Evento::all();
            $meus_eventos = Evento::all();
        }

        if(Auth::user()->hasRole('assistente')){

            $meus_eventos = Auth::user()->eventos;
        }

        if(Auth::user()->hasRole('gestor')){

            $meus_eventos = Auth::user()->eventos;
        }

        if(Auth::user()->hasRole('participante')){

            $p = Participante::where('id_pessoa_pes', Auth::user()->id_pessoa_pes)->first();
            
            if($p){

                $eventos_participante = $p->eventos->pluck('id_evento_eve')->toArray();
                $eventos = Evento::whereNotIn('id_evento_eve', $eventos_participante)->where('dt_fim_eve', '<', date('Y-m-d') )->where('fl_publicado_eve', true)->get();

                $meus_eventos = $p->eventos;
                $evento = Evento::find(1);
                $programacao = $evento->atividades->sortBy('dt_inicio_atividade_ati');
            }

            return view('painel', compact('sala','palestrante','participante','atividade','meus_eventos','programacao','eventos'));
        }   
        
        Session::put('meus_eventos', $meus_eventos);

        return view('dashboard', compact('sala','palestrante','participante','atividade','meus_eventos','programacao','eventos'));
    }

    public function show($e)
    {       
        $evento = Evento::where('ds_apelido_eve',$e)->first();
        Session::put('evento',$evento);

        $salas = Sala::where('id_evento_eve',$evento->id_evento_eve)->get();

        $atividades = Atividade::all();
        $palestrantes = Palestrante::all();

        if($evento->fl_publicado_eve)
            return view('seminario',compact('evento','atividades','palestrantes','salas'));
        else
            return view('temporario',compact('evento','atividades','palestrantes','salas'));
        //return view('publico/evento/index',compact('evento','atividades','palestrantes'));
    }

    public function temporario($e)
    {       
        $evento = Evento::where('ds_apelido_eve',$e)->first();
        Session::put('evento',$evento);

        $salas = Sala::where('id_evento_eve',$evento->id_evento_eve)->get();

        $atividades = Atividade::all();
        $palestrantes = Palestrante::all();

        return view('seminario',compact('evento','atividades','palestrantes','salas'));
        //return view('publico/evento/index',compact('evento','atividades','palestrantes'));
    }

    public function programacao($e)
    {      
        $evento = Evento::where('ds_apelido_eve',$e)->first();
        Session::put('evento',$evento);
        $atividades = Atividade::where('id_evento_eve', $evento->id_evento_eve)->orderBy('dt_inicio_atividade_ati')->orderBy('nm_atividade_ati')->get();
        $palestrantes = Palestrante::all();

        return view('programacao',compact('evento','atividades','palestrantes'));

        return view('publico/evento/index',compact('evento','atividades','palestrantes'));
    }

    public function palestrantes($e)
    {       
        $evento = Evento::where('ds_apelido_eve',$e)->first();
        Session::put('evento',$evento);
        $atividades = Atividade::all();
        $palestrantes = Palestrante::all();

        return view('publico/evento/index',compact('evento','atividades','palestrantes'));
    }

    public function stand($e)
    {       
        $evento = Evento::where('ds_apelido_eve',$e)->first();
        Session::put('evento',$evento);
        $atividades = Atividade::all();
        return view('publico/evento/index',compact('evento','atividades'));
    }
}