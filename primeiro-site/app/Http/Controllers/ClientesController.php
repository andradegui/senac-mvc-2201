<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{

    public function __construct(){


        // //Só usuario logado pode passar
        // aqui pra todas as páginas irá pedir login
        // $this->middleware('auth');
    }

    public function listar(){

        $clientes = Clientes::all();

        //Atenção clientes/listar blade.php vira clientes.listar

        return view('clientes.listar', ['clientes'=>$clientes]);

    }

}
