<?php

namespace App\Http\Controllers;

use App\Sala;
use App\Evento;
use App\Atividade;
use App\Palestrante;
use App\TipoAtividade;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AtividadeRequest;

class AtividadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
        Session::put('url','programacao');
    }

    public function index()
    {      
        return view('atividades/index');
    }

    public function show($id)
    {
        $atividade = Atividade::find($id);
        return view('atividades/detalhes', compact('atividade'));
    }

    public function create()
    {
        $eventos = Evento::all();
        $salas = Sala::all();
        $tipos = TipoAtividade::all();
        $palestrantes = Palestrante::all();

        return view('atividades/create',compact('eventos','salas','tipos','palestrantes'));
    }

    public function edit($id)
    {
        $eventos = Evento::all();
        $salas = Sala::all();
        $tipos = TipoAtividade::all();
        $palestrantes = Palestrante::all();
        $atividade = Atividade::find($id);

        return view('atividades/editar', compact('atividade','eventos','salas','tipos','palestrantes'));
    }

    public function store(AtividadeRequest $request)
    {
       
        $atividade = Atividade::create($request->all());

        if($atividade){
            $atividade->palestrantes()->sync($request->palestrantes);
        }

        Flash::success('<i class="fa fa-check"></i> Atividade <strong>'.$atividade->nm_atividade_ati.'</strong> cadastrada com sucesso');

        return redirect('atividade/create')->withInput();
        
    }

    public function update(Request $request, Atividade $atividade)
    {
            
        $atividade = Atividade::find($atividade->id_atividade_ati);
        $atividade->update($request->all());

        if($atividade){
            $atividade->palestrantes()->sync($request->palestrantes);
        }

        Flash::success('<i class="fa fa-check"></i> Dados atualizados com sucesso');
        return redirect()->route('atividade.edit', $atividade->id_atividade_ati)->withInput();
    }
}