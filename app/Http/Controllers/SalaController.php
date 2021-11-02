<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Sala;
use App\Evento;
use App\Utils;
use App\TipoSala;
use App\Atividade;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\SalaRequest;

class SalaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        Session::put('url','sala');
    }

    public function index()
    {
        $salas = Sala::all();
        return view('salas/index',compact('salas'));
    }

    public function sala($evento, $id_sala)
    {
        $sala = Sala::with('atividades')->find($id_sala);
        $atividade = Atividade::where('id_sala_sal', $id_sala)->where('dt_inicio_atividade_ati','<',Carbon::now()->toDateTimeString())
                                                              ->where('dt_termino_atividade_ati', '>', Carbon::now()->toDateTimeString())
                                                              ->first();
            
        return view('publico/evento/sala', compact('atividade','sala'));
    }

    public function listar($apelido)
    {
        $evento = Evento::where('ds_apelido_eve',$apelido)->first();
        $salas = Sala::where('id_evento_eve',$evento->id_evento_eve)->orderBy('nm_sala_sal')->get();

        Session::put('edicao',$apelido);
        Session::put('evento',$evento);

        return view('salas/index',compact('salas'));
    }

    public function create()
    {
        $tipos = TipoSala::all();
        return view('salas/create',compact('tipos'));
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

    public function store(SalaRequest $request)
    {
        try {

            $id_evento = Session::get('evento')->id_evento_eve;
            $request->merge(['id_evento_eve' => $id_evento]);
            
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

    public function update(SalaRequest $request, Sala $sala)
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