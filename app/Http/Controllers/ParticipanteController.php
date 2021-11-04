<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use App\Role;
use App\User;
use App\Evento;
use App\Pessoa;
use App\Participante;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ParticipanteRequest;
use App\Http\Requests\ParticipanteImportRequest;

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

        Session::put('edicao',$apelido);
        
        return view('participantes/index', compact('participantes'));
    }

    public function show($id)
    {
        $participante = Participante::find($id);
        return view('participantes/perfil', compact('participante'));
    }

    public function create()
    {
        $eventos = Evento::all();
        return view('participantes/create', compact('eventos'));
    }

    public function edit($id)
    {
        $participante = Participante::find($id);
        return view('participantes/editar', compact('participante'));
    }

    public function importar()
    {
        $eventos = Evento::all();
        return view('participantes/importar', compact('eventos'));
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

    public function store(Request $request)
    {
       
        $file = $request->file('arquivo');
        $extensions = array("csv","CSV");

        if($file){
            
            $path = $file->getRealPath();
            if(in_array($file ->getClientOriginalExtension(),$extensions)){
                                

            }

          
        }else{
            Flash::error('Erro ao atualizar dados');
        }
        return redirect('participantes/create')->withInput();
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
        $dados = array('name' => $request->ds_email_pes,
                       'email' => $request->nm_pessoa_pes);

        $user->update($dados);

        //Atualiza Participante
        $participante->update($request->all());

        Flash::success('<i class="fa fa-check"></i> Dados atualizados com sucesso');
        return redirect()->route('participante.edit', $participante->id_participante_par)->withInput();
    }

    public function destroy(Request $request, Participante $participante)
    {
        if($participante->eventos)
        {
            Flash::warning('<i class="fa fa-exclamation"></i> Esse participante possui vínculo com eventos. Remova os eventos para realizar a exclusão.');
        }else{
            if($participante->delete())
                Flash::success('<i class="fa fa-check"></i> Registro de <strong>'.$participante->pessoa->nm_pessoa_pes.'</strong> excluído com sucesso');
        }
        
        return redirect('participante')->withInput();
    }

    public function importacao(ParticipanteImportRequest $request)
    {
        $file = $request->file('arquivo');
        $evento = Evento::find($request->evento);

        if (($handle = fopen($file, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, ';')) !== false)
            {
                $chave_pessoa = array('ds_email_pes' => $row[0]);
                $dados_pessoa = array('nm_pessoa_pes' => $row[3]);
                $pessoa = Pessoa::updateOrCreate($chave_pessoa, $dados_pessoa);

                $chave_participante = array('id_pessoa_pes' => $pessoa->id_pessoa_pes);
                $dados_participante = array('nm_cracha_par' => $row[4]);
                $participante = Participante::updateOrCreate($chave_participante, $dados_participante);

                $chave_usuario = array('email' => $row[0]);
                $dados_usuario = array('id_pessoa_pes' => $pessoa->id_pessoa_pes, 'name' => $row[3], 'password' => Hash::make('123456'));
                $user = User::updateOrCreate($chave_usuario, $dados_usuario);

                $role = Role::where('name','participante')->first();

                if(!$user->hasRole($role->name))
                    $user->attachRole($role); 

                $participante->eventos()->sync($evento);                

            }
            fclose($handle);
            Flash::success('<i class="fa fa-check"></i> Dados inseridos com sucesso');
        }else{
            Flash::error('<i class="fa fa-times"></i> Erro no processamento do arquivo');
        }
        return redirect('participante/importar')->withInput();
    }
}