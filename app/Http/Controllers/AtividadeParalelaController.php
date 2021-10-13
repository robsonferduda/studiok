<?php

namespace App\Http\Controllers;

use App\AtividadeParalela;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AtividadeParalelaRequest;

class AtividadeParalelaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
    }

    public function update(Request $request, $id)
    {
        $atividade_paralela = AtividadeParalela::with('atividade')->find($id);
        if($atividade_paralela->update($request->all()))
            Flash::success("Atividade atualizada com sucesso");
        else
            Flash::error("Erro ao atualizar atividade paralela");

        return redirect('atividade/atividades-paralelas/'.$request->id_atividade_ati)->withInput();
    }

    public function edit($id)
    {
        $atividade_paralela = AtividadeParalela::with('atividade')->find($id);
        return redirect('atividade/atividades-paralelas/'.$atividade_paralela->atividade->id_atividade_ati)->with('atividade_paralela',$atividade_paralela);
    }

    public function destroy($id)
    {
        $atividade_paralela = AtividadeParalela::with('atividade')->find($id);
        
        if($atividade_paralela->delete()){
            Flash::success("Atividade excluída com sucesso.");
        } else {
            Flash::warning("Erro ao excluir a atividade <strong>$atividade->titulo_atp</strong>.");
        }
        return redirect('atividade/atividades-paralelas/'.$atividade_paralela->atividade->id_atividade_ati);
    }
}