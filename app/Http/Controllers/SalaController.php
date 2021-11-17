<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Sala;
use App\Evento;
use App\Utils;
use App\TipoSala;
use App\Atividade;
use App\AtividadeAcesso;
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
        /*
        $atividade = Atividade::where('id_sala_sal', $id_sala)
                                ->where('dt_inicio_atividade_ati','<',Carbon::now()->toDateTimeString())
                                ->where('dt_termino_atividade_ati', '>', Carbon::now()->toDateTimeString())
                                ->first();
        */

        $atividade = Atividade::where('id_sala_sal', $id_sala)
                                ->where('fl_corrente_ati','=', true)
                                ->first();

        $id_atividade = ($atividade) ? $atividade->id_atividade_ati : null;

        $dados = array('id_usuario_usu' => Auth::user()->id,
                       'id_sala_ati' => $id_sala,
                       'id_atividade_ati' => $id_atividade);

        AtividadeAcesso::create($dados);
            
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
        $sala = Sala::with('atividades')->find($sala->id_sala_sal);
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
            return redirect('salas/'.Session::get('evento')->ds_apelido_eve)->withInput();
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

    public function getSalaAtual($id)
    {
        $dados = array();
        $sala = Sala::find($id);
        $atividade = Atividade::where('id_sala_sal', $id)
                                ->where('fl_corrente_ati','=', true)
                                ->first();

        if($atividade){
            $dados = array('sala' => $sala->nm_sala_sal,
                            'id_atividade_ati' => $atividade->id_atividade_ati,
                            'atividade' => $atividade->nm_atividade_ati,
                            'data' => 'Atividade iniciada em '.Carbon::parse($atividade->dt_inicio_atividade_ati)->format('d/m/Y H:i').' e término em '.Carbon::parse($atividade->dt_termino_atividade_ati)->format('d/m/Y H:i'));
        }else{
            $dados = array('sala' => $sala->nm_sala_sal,
                            'id_atividade_ati' => 0,
                            'atividade' => "",
                            'data' => "Nenhuma atividade online no momento");
        }

        return response()->json($dados);       
    }
}