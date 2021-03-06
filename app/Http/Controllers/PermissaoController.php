<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class permissaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        Session::put('url','permissoes');
    }

    public function index()
    {
        $permissions = Permission::all();
        return view('permissoes/index',compact('permissions'));
    }
}