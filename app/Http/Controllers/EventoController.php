<?php

namespace App\Http\Controllers;

use Auth;
use App\Utils;
use App\Evento;
use App\Participante;
use App\TipoParticipacao;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class EventoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['contato']]);
        Session::put('url','evento');
    }

    public function index()
    {
        $eventos = Evento::paginate(10);
        return view('eventos/index', compact('eventos'));
    }

    public function contato()
    {
        return view('eventos/contato');
    }

    public function create()
    {
        return view('eventos/create');
    }

    public function edit($id)
    {
        $evento = Evento::findOrFail($id);
        return view('eventos/edit', compact('evento'));
    }

    public function show(Evento $evento)
    {
        return view('eventos/detalhes', compact('evento'));
    }

    public function inscricao($id)
    {
        $evento = Evento::find($id);
        $participante = Participante::where('id_pessoa_pes', Auth::user()->id_pessoa_pes)->first();
        $participante->eventos()->attach($evento);

        return redirect('dashboard')->withInput();
    }

    public function store(Request $request)
    {
        try {
            
            Evento::create($request->all());
            $retorno = array('flag' => true,
                             'msg' => "Dados inseridos com sucesso");

        } catch (\Illuminate\Database\QueryException $e) {

            $retorno = array('flag' => false,
                             'msg' =>'<i class="fa fa-times"></i> '.Utils::getDatabaseMessageByCode($e->getCode()));

        } catch (Exception $e) {
            
            $retorno = array('flag' => true,
                             'msg' => "Ocorreu um erro ao inserir o registro");
        }

        if ($retorno['flag']) {
            Flash::success($retorno['msg']);
            return redirect('eventos')->withInput();
        } else {
            Flash::error($retorno['msg']);
            return redirect('eventos/create')->withInput();
        }
    }

    public function update(Request $request, Evento $evento)
    {
        try {

            if (!empty($request->dt_inicio_eve)) {
                $request->merge(['dt_inicio_eve' => date('Y-m-d', strtotime(str_replace('/', '-', $request->dt_inicio_eve)))]);
            }

            if (!empty($request->dt_fim_eve)) {
                $request->merge(['dt_fim_eve' => date('Y-m-d', strtotime(str_replace('/', '-', $request->dt_fim_eve)))]);
            }
                    
            $evento->update($request->all());
            $retorno = array('flag' => true,
                             'msg' => '<i class="fa fa-check"></i> Dados atualizados com sucesso');
                             
        } catch (\Illuminate\Database\QueryException $e) {
            $retorno = array('flag' => false,
                             'msg' => '<i class="fa fa-times"></i> '.Utils::getDatabaseMessageByCode($e->getCode()));
        } catch (Exception $e) {
            $retorno = array('flag' => true,
                             'msg' => '<i class="fa fa-times"></i> Ocorreu um erro ao atualizar o registro');
        }

        if ($retorno['flag']) {
            Flash::success($retorno['msg']);
            return redirect('evento')->withInput();
        } else {
            Flash::error($retorno['msg']);
            return redirect()->route('evento.edit', $evento->id_evento_eve)->withInput();
        }
    }
}