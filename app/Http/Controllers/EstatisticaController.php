<?php

namespace App\Http\Controllers;

use App\Evento;
use App\Certificado;
use App\Participante;
use App\Atividade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EstatisticaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        Session::put('url','estatistica');
    }

    public function index()
    {
        return view('estatisticas/index');
    }
}