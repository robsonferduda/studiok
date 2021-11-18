<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use App\Role;
use App\User;
use App\Evento;
use App\Pessoa;
use App\Situacao;
use App\TipoInscricao;
use App\Participante;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ParticipanteRequest;
use App\Http\Requests\ParticipanteImportRequest;
use App\Http\Requests\ParticipanteIndividualRequest;

class ParticipanteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['cadastro','cadastrar']]);
        Session::put('url','participante');
    }

    public function index()
    {
        $eventos = Evento::all();
        $participantes = Participante::all();
        return view('participantes/index', compact('eventos','participantes'));
    }

    public function listar($apelido)
    {
        $evento = Evento::with('participantes')->where('ds_apelido_eve', $apelido)->first();
        $participantes = $evento->participantes;

        Session::put('evento',$evento);
        Session::put('edicao',$apelido);
        
        return view('participantes/index', compact('participantes'));
    }

    public function show($id)
    {
        $participante = Participante::find($id);
        return view('participantes/perfil', compact('participante'));
    }

    public function alterarSituacao($id, $situacao)
    {
        $id_evento = Session::get('evento')->id_evento_eve;
        $participante = Participante::with('eventos')->find($id);

        if($situacao == 1)
            $participante->eventos()->updateExistingPivot($id_evento, array('id_situacao_sit' => 2),false);
        else
            $participante->eventos()->updateExistingPivot($id_evento, array('id_situacao_sit' => 1),false);

        Flash::success('<i class="fa fa-warning"></i> Situação da inscrição de <strong>'.$participante->pessoa->nm_pessoa_pes.'</strong> atualizada com sucesso');
        return redirect('participantes/'.Session::get('evento')->ds_apelido_eve)->withInput();
    }

    public function resetar($usuario)
    {
        $pessoa = Pessoa::find($usuario);
        $user = User::where('id_pessoa_pes',$usuario)->first();
        

        if($user){
            Flash::success('<i class="fa fa-warning"></i> Senha atualizada com sucesso');
        }else{
            Flash::danger('<i class="fa fa-warning"></i> Erro ao atualizar senha');
        }
        return redirect('participante/'.$pessoa->participante->id_participante_par)->withInput();
    }

    public function create()
    {
        $eventos = Evento::orderBy('nm_evento_eve')->get();
        $situacoes = Situacao::orderBy('ds_situacao_sit')->get();
        $tipos = TipoInscricao::orderBy('ds_tipo_inscricao_tii')->get();

        return view('participantes/create', compact('eventos','situacoes','tipos'));
    }

    public function edit($id)
    {
        $participante = Participante::find($id);
        return view('participantes/editar', compact('participante'));
    }

    public function importar()
    {
        $eventos = Evento::orderBy('nm_evento_eve')->get();
        $situacoes = Situacao::orderBy('ds_situacao_sit')->get();
        $tipos = TipoInscricao::orderBy('ds_tipo_inscricao_tii')->get();

        return view('participantes/importar', compact('eventos','situacoes','tipos'));
    }

    public function cadastrar()
    {
        return view('cadastro');
    }

    public function cadastro(ParticipanteRequest $request)
    {
        $pessoa = Pessoa::where('ds_email_pes',$request->email)->first();
        if($pessoa)
            $participante = Participante::where('id_pessoa_pes', $pessoa->id_pessoa_pes)->first();
        else
            $participante = null;

        if($participante){
            Flash::warning('<i class="fa fa-warning"></i> Email já cadastrado no sistema. Utilize a recuperação de senha para reativar seu cadastro');
            return redirect('cadastrar')->withInput();
        }
        
        if(!$pessoa and !$participante)
        {
            $chave_pessoa = array('ds_email_pes' => $request->email);
            $dados_pessoa = array('nm_pessoa_pes' => $request->name);
            $pessoa = Pessoa::updateOrCreate($chave_pessoa, $dados_pessoa);

            $chave_participante = array('id_pessoa_pes' => $pessoa->id_pessoa_pes);
            $dados_participante = array('nm_cracha_par' => $request->name);
            $participante = Participante::updateOrCreate($chave_participante, $dados_participante);

            $chave_usuario = array('email' => $request->email);
            $dados_usuario = array('id_pessoa_pes' => $pessoa->id_pessoa_pes, 'name' => $request->name, 'password' => Hash::make($request->senha));
            $user = User::updateOrCreate($chave_usuario, $dados_usuario);

            $role = Role::where('name','participante')->first();

            if(!$user->hasRole($role->name))
                $user->attachRole($role); 


        }elseif($pessoa and !$participante){

            $chave_participante = array('id_pessoa_pes' => $pessoa->id_pessoa_pes);
            $dados_participante = array('nm_cracha_par' => $request->name);
            $participante = Participante::updateOrCreate($chave_participante, $dados_participante);

            //Atualiza a senha de acordo com o cadastro de participante
            $user = User::where('id_pessoa_pes', $pessoa->id_pessoa_pes)->first();
            $user->password = Hash::make($request->senha);
            $user->save();

            $role = Role::where('name','participante')->first();

            if(!$user->hasRole($role->name))
                $user->attachRole($role); 

        }

        Auth::login($user);
        return redirect('home')->withInput();
    }

    public function store(ParticipanteIndividualRequest $request)
    {
        //Verifica se o participante existe. Se sim, direciona para a página de inserção de eventos
        $pessoa = Pessoa::where('ds_email_pes', $request->ds_email_pes)->first();
        $evento = Evento::where('id_evento_eve', $request->evento)->first();

        if($pessoa)
            $participante = Participante::where('id_pessoa_pes', $pessoa->id_pessoa_pes)->first();
        else
            $participante = null;

        if($pessoa and $participante){ //Se a pessoa está cadastrada e já é participante, encaminha para a tela de adição de eventos

            Flash::error('<i class="fa fa-warning"></i> O participante já está cadastrado no sistema. Para vincular ele a um evento, <a href="'.url('participante',$participante->id_participante_par).'"><strong style="color: white;">clique aqui</strong></a> e selecione o evento que deseja adicionar.');
            return redirect('participante/create')->withInput();

        }elseif($pessoa){

            $user = User::where('id_pessoa_pes', $pessoa->id_pessoa_pes)->first();

            $chave_participante = array('id_pessoa_pes' => $pessoa->id_pessoa_pes);
            $dados_participante = array('nm_cracha_par' => '');
            $participante = Participante::updateOrCreate($chave_participante, $dados_participante);

            $role = Role::where('name','participante')->first();

            if(!$user->hasRole($role->name))
                $user->attachRole($role); 

            $participante->eventos()->attach($evento);  
            $participante->eventos()->updateExistingPivot($evento, array('id_situacao_sit' => $request->situacao, 'id_tipo_inscricao_tii' => $request->tipo),false);  

            Flash::success('<i class="fa fa-check"></i> Participante cadastrado com sucesso');
            return redirect('participante/create')->withInput();

        }else{

            $chave_pessoa = array('ds_email_pes' => $request->ds_email_pes);
            $dados_pessoa = array('nm_pessoa_pes' => $request->nm_pessoa_pes);
            $pessoa = Pessoa::updateOrCreate($chave_pessoa, $dados_pessoa);

            $chave_participante = array('id_pessoa_pes' => $pessoa->id_pessoa_pes);
            $dados_participante = array('nm_cracha_par' => '');
            $participante = Participante::updateOrCreate($chave_participante, $dados_participante);

            $chave_usuario = array('email' => $request->ds_email_pes);
            $dados_usuario = array('id_pessoa_pes' => $pessoa->id_pessoa_pes, 'name' => $request->nm_pessoa_pes, 'password' => Hash::make('123456'));
            $user = User::updateOrCreate($chave_usuario, $dados_usuario);

            $role = Role::where('name','participante')->first();

            if(!$user->hasRole($role->name))
                $user->attachRole($role); 

            $participante->eventos()->attach($evento);  
            $participante->eventos()->updateExistingPivot($evento, array('id_situacao_sit' => $request->situacao, 'id_tipo_inscricao_tii' => $request->tipo),false); 
            
            Flash::success('<i class="fa fa-check"></i> Participante cadastrado com sucesso');
            return redirect('participante/create')->withInput();
        }
                        
        return redirect('participante/create')->withInput();
    }

    public function update(Request $request, Participante $participante)
    {
        //Higienização de entradas
        $request->merge(['nu_cpf_par' => ($request->nu_cpf_par) ? str_replace(array('.','-'), "", $request->nu_cpf_par) : null]);
        $request->merge(['nu_orcid_pes' => ($request->nu_orcid_pes) ? str_replace("-", "", $request->nu_orcid_pes) : null]);

        //Atualiza Pessoa
        $pessoa = Pessoa::find($participante->id_pessoa_pes);
        $pessoa->update($request->all());

        //Atualiza Usuário
        $user = User::where('id_pessoa_pes',$pessoa->id_pessoa_pes)->first();
        $dados = array('name' => $request->nm_pessoa_pes,
                       'email' => $request->ds_email_pes);

        $user->update($dados);

        //Atualiza Participante
        $participante->update($request->all());

        Flash::success('<i class="fa fa-check"></i> Dados atualizados com sucesso');
        return redirect()->route('participante.edit', $participante->id_participante_par)->withInput();
    }

    public function importacao(ParticipanteImportRequest $request)
    {
        $total = 0;
        $file = $request->file('arquivo');
        $evento = Evento::find($request->evento);

        if (($handle = fopen($file, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, ';')) !== false)
            {
                $chave_pessoa = array('ds_email_pes' => $row[0]);
                $dados_pessoa = array('nm_pessoa_pes' => $row[1]);
                $pessoa = Pessoa::updateOrCreate($chave_pessoa, $dados_pessoa);

                $chave_participante = array('id_pessoa_pes' => $pessoa->id_pessoa_pes);
                $dados_participante = array('nm_cracha_par' => $row[1]);
                $participante = Participante::updateOrCreate($chave_participante, $dados_participante);

                $chave_usuario = array('email' => $row[0]);
                $dados_usuario = array('id_pessoa_pes' => $pessoa->id_pessoa_pes, 'name' => $row[1], 'password' => Hash::make('123456'));
                $user = User::updateOrCreate($chave_usuario, $dados_usuario);

                $role = Role::where('name','participante')->first();

                if(!$user->hasRole($role->name))
                    $user->attachRole($role); 

                $participante->eventos()->sync($evento);  
                $participante->eventos()->updateExistingPivot($evento, array('id_situacao_sit' => $request->situacao, 'id_tipo_inscricao_tii' => $request->tipo),false);    
                
                $total++;
            }
            fclose($handle);
            Flash::success('<i class="fa fa-check"></i> Foram inseridos '.$total.' participantes com sucesso');
        }else{
            Flash::error('<i class="fa fa-times"></i> Erro no processamento do arquivo');
        }
        return redirect('participante/importar')->withInput();
    }

    public function destroy(Request $request, Participante $participante)
    {
        if($participante->eventos)
        {
            Flash::error('<i class="fa fa-exclamation"></i> Esse participante possui vínculo com eventos. Remova os eventos para realizar a exclusão.');
        }else{
            if($participante->delete())
                Flash::success('<i class="fa fa-check"></i> Registro de <strong>'.$participante->pessoa->nm_pessoa_pes.'</strong> excluído com sucesso');
        }
        
        return redirect('participante')->withInput();
    }

    public function excluirParticipacaoEvento($id_participante, $id_evento)
    {
        $participante = Participante::where('id_participante_par', $id_participante)->first();
        
        if($participante){

            //Remove a ocorrência do evento para o participante selecionado
            if($participante->eventos()->wherePivot('id_evento_eve',$id_evento)->detach())
                Flash::success('<i class="fa fa-check"></i> O participante <strong>'.$participante->pessoa->nm_pessoa_pes.'</strong> foi excluído do evento com sucesso');
            else
                Flash::error('<i class="fa fa-exclamation"></i> Ocorreu um erro ao remover o registro');

        }else{
            Flash::error('<i class="fa fa-exclamation"></i> Não encontramos um participante para o código informado');
            return redirect()->back()->withInput();
        }
        return redirect('participante/'.$participante->id_participante_par)->withInput();
    }
}