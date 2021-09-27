<?php

namespace App\Http\Controllers;

use App\Sala;
use App\TipoSala;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SalaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
        Session::put('url','sala');
    }

    public function index()
    {
        $salas = Sala::all();
        return view('salas/index',compact('salas'));
    }

    public function create()
    {
        return view('salas/create');
    }

    public function edit(Sala $sala)
    {
        $tipos = TipoSala::all();
        return view('salas/editar', compact('sala','tipos'));
    }

    public function show(Sala $sala)
    {
        return view('salas/detalhes', compact('sala'));
    }

    public function store(Request $request)
    {
        try {
            
            Sala::create($request->all());
            $retorno = array('flag' => true,
                             'msg' => "Dados inseridos com sucesso");

        } catch (\Illuminate\Database\QueryException $e) {

            $retorno = array('flag' => false,
                             'msg' => Utils::getDatabaseMessageByCode($e->getCode()));

        } catch (Exception $e) {
            
            $retorno = array('flag' => true,
                             'msg' => "Ocorreu um erro ao inserir o registro");
        }

        if ($retorno['flag']) {
            Flash::success($retorno['msg']);
            return redirect('sala')->withInput();
        } else {
            Flash::error($retorno['msg']);
            return redirect('sala/create')->withInput();
        }
    }

    public function update(Request $request, Sala $sala)
    {
        try {
        
            $sala->update($request->all());
            $retorno = array('flag' => true,
                             'msg' => "Dados atualizados com sucesso");
        } catch (\Illuminate\Database\QueryException $e) {
            $retorno = array('flag' => false,
                             'msg' => Utils::getDatabaseMessageByCode($e->getCode()));
        } catch (Exception $e) {
            $retorno = array('flag' => true,
                             'msg' => "Ocorreu um erro ao atualizar o registro");
        }

        if ($retorno['flag']) {
            Flash::success($retorno['msg']);
            return redirect('sala')->withInput();
        } else {
            Flash::error($retorno['msg']);
            return redirect()->route('sala.edit', $sala->id_sala_sal)->withInput();
        }
    }

    public function destroy(Sala $sala)
    {
        if(is_null($sala->atividades)){
            $sala->delete();
            Flash::success("Sala excluída com sucesso.");
        } else {
            Flash::warning("Não é possível excluir a sala <strong>$sala->nm_sala_sal</strong>, ela possui atividades vinculadas. Exclua as atividades vinculadas para permtir a exclusão.");
        }
        
        return redirect('sala');
    }
}