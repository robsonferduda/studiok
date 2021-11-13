<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['primeiroAcesso']]);
        Session::put('url','usuarios');
    }

    public function index()
    {
        $usuarios = User::orderBy('name')->get();
        return view('usuarios/index',compact('usuarios'));
    }

    public function perfil()
    {
        return view('perfil');
    }

    public function primeiroAcesso()
    {
        return view('auth/passwords/primeiro-acesso');
    }
}