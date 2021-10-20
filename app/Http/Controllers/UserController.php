<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        Session::put('url','usuarios');
    }

    public function index()
    {
        $usuarios = User::orderBy('name')->get();
        return view('usuarios/index',compact('usuarios'));
    }
}