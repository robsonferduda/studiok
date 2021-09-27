<?php

namespace App\Http\Controllers;

use App\Evento;
use App\Certificado;
use App\Participante;
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

    public function dashboard()
    {       
        return view('dashboard');
    }

    public function show()
    {       
        $atividades = Atividade::all();
        return view('publico/evento/index',compact('atividades'));
    }
}