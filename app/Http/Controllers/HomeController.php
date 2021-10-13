<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth', ['except' => ['index','show']]);
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
        return view('dashboard', compact('sala','palestrante','participante','atividade'));
    }

    public function show($e)
    {       
        $evento = Evento::where('ds_apelido_eve',$e)->first();
        $atividades = Atividade::all();
        return view('publico/evento/index',compact('evento','atividades'));
    }
}