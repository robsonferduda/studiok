<?php

namespace App\Http\Controllers;

use Auth;
use App\Sala;
use App\Evento;
use App\Certificado;
use App\Participante;
use App\Palestrante;
use App\Atividade;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuditoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        Session::put('url','auditoria');
    }

    public function index()
    {
        $audits = Audit::with('user')->get();
        return view('auditoria/index',compact('audits'));
    }

}