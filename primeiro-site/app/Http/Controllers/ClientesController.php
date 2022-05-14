<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{   
    private int $qtd_por_pagina = 5;

    public function __construct(){

        $this->middleware('permission:cliente-list|cliente-create|cliente-edit|cliente-delete',
                ['only' => ['index', 'store']]);

        $this->middleware('permission:cliente-create',
                ['only' => ['create', 'store']]);

        $this->middleware('permission:cliente-edit',
                ['only' => ['edit', 'update']]);


        $this->middleware('permission:cliente-delete',
                ['only' => ['destroy']]);
    }

    public function index(Request $request){
        $clientes = Clientes::orderBy('id', 'DESC')->paginate($this->qtd_por_pagina);

        return view('clientes.index', compact('clientes'))->with('i', ($request->input('page', 1) - 1) * $this->qtd_por_pagina);
    }

    public function create(Request $request){
        return view('clientes.create');
    }

    public function store(Request $request){

        $this->validate($request, ['nome' => 'required',
                                   'email' => 'required |email|unique:clientes,email',
                                   'telefone' => 'required',
                                   'endereco' => 'required',
                                   ]);

        $input = $request->all();        

        $cliente = Clientes::create($input); 
        
        if(!$cliente){
            return redirect()->route('clientes.index')->with('error', 'Erro ao criar cliente');
        }

        return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso');
    }

    public function show($id){
        $cliente = Clientes::find($id);

        return view('clientes.show', compact('cliente'));
    }

    public function edit($id){
        $cliente = Clientes::find($id);                

        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id){
        $this->validate($request, ['nome' => 'required',
                                   'email' => 'required',
                                   'telefone' => 'required',
                                   'endereco' => 'required',
                                   ]);

        $cliente = Clientes::find($id);        
        $input = $request->all();
        $cliente->update($input);

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado');
    }

    public function destroy($id){
        Clientes::find($id)->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente apagado com sucesso!');
    }


}
