<?php

namespace App\Http\Controllers;

use Auth;
use App\Utils;
use App\Chat;
use App\Sala;
use App\Evento;
use App\Atividade;
use App\Palestrante;
use App\TipoAtividade;
use App\AtividadeParalela;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AtividadeRequest;
use App\Http\Requests\AtividadeParalelaRequest;

class AtividadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','getChat']]);
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

    public function atualizaStatus($id)
    {
        $atividade = Atividade::find($id);
        $sala = Sala::with('atividades')->find($atividade->id_sala_sal);

        foreach($sala->atividades as $ati){
            $ati->fl_corrente_ati = false;
            $ati->save();
        }

        $atividade->fl_corrente_ati = true;
        $atividade->save();

        return redirect('sala/'.$atividade->sala->id_sala_sal)->withInput();
    }

    public function create()
    {
        $eventos = Evento::orderBy('nm_evento_eve')->get();
        $salas = Sala::where('id_evento_eve', Session::get('evento')->id_evento_eve)->orderBy('nm_sala_sal')->get();
        $tipos = TipoAtividade::orderBy('ds_tipo_atividade_tia')->get();
        $palestrantes = Palestrante::all();

        return view('atividades/create',compact('eventos','salas','tipos','palestrantes'));
    }

    public function edit($id)
    {
        $eventos = Evento::all();
        $salas = Sala::all();
        $tipos = TipoAtividade::orderBy('ds_tipo_atividade_tia')->get();
        $palestrantes = Palestrante::all();
        $atividade = Atividade::find($id);

        return view('atividades/editar', compact('atividade','eventos','salas','tipos','palestrantes'));
    }

    public function store(AtividadeRequest $request)
    {
        try {

            $fl_ativa_ati = $request->fl_ativa_ati == true ? true : false;
            $fl_destaque_ati = $request->fl_destaque_ati == true ? true : false;

            if (!empty($request->dt_inicio_atividade_ati)) {
                $request->merge(['dt_inicio_atividade_ati' => date('Y-m-d H:i', strtotime(str_replace('/', '-', $request->dt_inicio_atividade_ati)))]);
            }

            if (!empty($request->dt_termino_atividade_ati)) {
                $request->merge(['dt_termino_atividade_ati' => date('Y-m-d H:i', strtotime(str_replace('/', '-', $request->dt_termino_atividade_ati)))]);
            }

            $request->merge(['fl_ativa_ati' => $fl_ativa_ati]);
            $request->merge(['fl_destaque_ati' => $fl_destaque_ati]);

            $tipo = TipoAtividade::find($request->id_tipo_atividade_tia)->fl_paralelo;

            $atividade = Atividade::create($request->all());

            if($atividade){
                $atividade->palestrantes()->sync($request->palestrantes);
                Flash::success('<i class="fa fa-check"></i> Atividade <strong>'.$atividade->nm_atividade_ati.'</strong> cadastrada com sucesso');
                if($tipo)
                    return redirect('atividade/atividades-paralelas/'.$atividade->id_atividade_ati)->withInput(); 

            }else{
                Flash::error('<i class="fa fa-times"></i> Erro ao cadastrar a atividade <strong>'.$atividade->nm_atividade_ati.'</strong>');
            }

        } catch (\Illuminate\Database\QueryException $e) {

            Flash::error('<i class="fa fa-times"></i> Erro ao cadastrar a atividade <strong>'.Utils::getDatabaseMessageByCode($e->getCode()).'</strong>');
        
        }catch (Exception $e) {
            
            Flash::error('<i class="fa fa-times"></i> Erro ao cadastrar a atividade: <strong>'.$atividade->nm_atividade_ati.'</strong>');
        }

        return redirect('programacao')->withInput();       
    }

    public function update(Request $request, Atividade $atividade)
    {
            
        if (!empty($request->dt_inicio_atividade_ati)) {
            $request->merge(['dt_inicio_atividade_ati' => date('Y-m-d H:i', strtotime(str_replace('/', '-', $request->dt_inicio_atividade_ati)))]);
        }

        if (!empty($request->dt_termino_atividade_ati)) {
            $request->merge(['dt_termino_atividade_ati' => date('Y-m-d H:i', strtotime(str_replace('/', '-', $request->dt_termino_atividade_ati)))]);
        }
        
        $fl_ativa_ati = $request->fl_ativa_ati == true ? true : false;
        $fl_destaque_ati = $request->fl_destaque_ati == true ? true : false;

        $request->merge(['fl_ativa_ati' => $fl_ativa_ati]);
        $request->merge(['fl_destaque_ati' => $fl_destaque_ati]);

        $atividade = Atividade::find($atividade->id_atividade_ati);
        $atividade->update($request->all());

        if($atividade){
            $atividade->palestrantes()->sync($request->palestrantes);
        }

        Flash::success('<i class="fa fa-check"></i> Dados atualizados com sucesso');
        return redirect('programacao')->withInput();
    }

    public function paralelas($atividade)
    {
        $salas = Sala::orderBy('nm_sala_sal')->get();
        $atividade = Atividade::find($atividade);

        return view('atividades/paralelas', compact('atividade','salas'));
    }

    public function salvarAtividadesParalelas(AtividadeParalelaRequest $request)
    {
        $atividadeParalela = AtividadeParalela::create($request->all());
        return redirect('atividade/atividades-paralelas/'.$request->id_atividade_ati)->withInput(); 
    }

    public function destroy(Atividade $atividade)
    {
        if($atividade->delete()){
            Flash::success('<i class="fa fa-check"></i> Atividade excluída com sucesso.');
        } else {
            Flash::warning("Erro ao excluir a atividade <strong>$atividade->nm_atividade_ati</strong>.");
        }
        
        return redirect('programacao');
    }

    public function salvarChat(Request $request)
    {
        $request->merge(['id_usuario_usu' => Auth::user()->id ]);
        Chat::create($request->all());
    }

    public function getChat($atividade)
    {
        $mensagens = array();
        $dados = Chat::where('id_atividade_ati',$atividade)->get();

        foreach($dados as $chat){
            $mensagens[] = array('mensagem' => $chat->mensagem_cha, 
                                 'usuario' => $chat->user->name,
                                 'id' => substr($chat->user->name, 0, 1),
                                 'data' => date('d/m/Y H:i:s', strtotime($chat->created_at)));
        }

        return response()->json($mensagens);       
    }
}