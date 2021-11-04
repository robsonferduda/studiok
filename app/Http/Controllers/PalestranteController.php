<?php

namespace App\Http\Controllers;

use Hash;
use Validator;
use App\Role;
use App\User;
use App\Evento;
use App\Pessoa;
use App\Palestrante;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PalestranteRequest;

class PalestranteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        Session::put('url','palestrante');
    }

    public function index()
    {
        $eventos = Evento::all();
        $palestrantes = Palestrante::all();
        return view('palestrantes/index', compact('eventos','palestrantes'));
    }

    public function listar($apelido)
    {
        $evento = Evento::where('ds_apelido_eve',$apelido)->first();
        Session::put('evento',$evento);
        $eventos = Evento::all();
        $palestrantes = Palestrante::all();
        Session::put('edicao',$apelido);

        return view('palestrantes/index', compact('eventos','palestrantes'));
    }

    public function show($id)
    {
        $palestrante = Palestrante::find($id);
        return view('palestrantes/perfil', compact('palestrante'));
    }

    public function create()
    {
        $eventos = Evento::all();
        return view('palestrantes/create', compact('eventos'));
    }

    public function edit($id)
    {
        $palestrante = Palestrante::find($id);
        return view('palestrantes/editar', compact('palestrante'));
    }

    public function store(PalestranteRequest $request)
    {
        $pessoa = Pessoa::where('ds_email_pes',$request->ds_email_pes)->first();
        if($pessoa)
            $palestrante = Palestrante::where('id_pessoa_pes', $pessoa->id_pessoa_pes)->first();
        else
            $palestrante = null;

        if(!$pessoa and !$palestrante){

            $chave_pessoa = array('ds_email_pes' => $request->ds_email_pes);
            $dados_pessoa = array('nm_pessoa_pes' => $request->nm_pessoa_pes);
            $pessoa = Pessoa::updateOrCreate($chave_pessoa, $dados_pessoa);

            $chave_palestrante = array('id_pessoa_pes' => $pessoa->id_pessoa_pes);
            $palestrante = Palestrante::updateOrCreate($chave_palestrante, $request->all());

            $chave_usuario = array('email' => $request->ds_email_pes);
            $dados_usuario = array('id_pessoa_pes' => $pessoa->id_pessoa_pes, 'name' => $request->nm_pessoa_pes, 'password' => Hash::make('123456'));
            $user = User::updateOrCreate($chave_usuario, $dados_usuario);

            $role = Role::where('name','palestrante')->first();

            if(!$user->hasRole($role->name))
                $user->attachRole($role);

            Flash::success('<i class="fa fa-check"></i> Palestrante cadastrado com sucesso');

        }elseif($pessoa and !$palestrante){

            $chave_palestrante = array('id_pessoa_pes' => $pessoa->id_pessoa_pes);
            $palestrante = Palestrante::updateOrCreate($chave_palestrante, $request->all());

            $user = User::where('id_pessoa_pes', $pessoa->id_pessoa_pes)->first();

            $role = Role::where('name','palestrante')->first();

            if(!$user->hasRole($role->name))
                $user->attachRole($role);

            Flash::success('<i class="fa fa-check"></i> Palestrante cadastrado com sucesso');

        }else{

            Flash::warning('<i class="fa fa-check"></i> Palestrante já cadastrado no sistema');
        }

        return redirect('palestrante')->withInput();
        
    }

    public function update(Request $request, Palestrante $palestrante)
    {
        //dd($request->all());
        $dados_pessoa = array('nm_pessoa_pes' => $request->nm_pessoa_pes,'ds_email_pes' => $request->ds_email_pes);

        $palestrante->update($request->all());
        $palestrante->pessoa()->update($dados_pessoa);

        //Atualiza Usuário
        $user = User::where('id_pessoa_pes',$palestrante->pessoa->id_pessoa_pes)->first();
        $dados = array('name' => $request->nm_pessoa_pes,
                       'email' => $request->ds_email_pes);

        $user->update($dados);

        Flash::success('<i class="fa fa-check"></i> Dados atualizados com sucesso');

        return redirect('palestrante')->withInput();
    }

    public function destroy(Request $request, Palestrante $palestrante)
    {
        if($palestrante->delete())
            Flash::success('<i class="fa fa-check"></i> Palestrante '.$palestrante->pessoa->nm_pessoa_pes.' excluído com sucesso');
        else
            Flash::success('<i class="fa fa-check"></i> Erro ao excluir o palestrante');
        return redirect('palestrante')->withInput();        
    }

    public function uploadFoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_picture' => 'required|image|max:1000',
        ]);

        if ($validator->fails()) {
            
            return $validator->errors();            
        }

        $return = "";

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            // Rename image
            $filename = time().'.'.$image->guessExtension();
            $path = $request->file('profile_picture')->storeAs('profile_pictures', $filename, 'public');
            $return = array('file' => $filename, 'msg' => 'success');            
        }
        
        return response($return,200);
    }

}