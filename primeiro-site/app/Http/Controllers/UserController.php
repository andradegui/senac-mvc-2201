<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use DB;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::orderBy('id', 'DESC')->paginate(5);

        return view('users.index', compact('data'))->with('i', ($request->input('page', 1) -1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()//mostra o form p ser preecnhido, só atualiza no frontend os dados
    {
        $roles = Role::pluck('name', 'name')->all();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//só atualiza no backend os dados
    {
        $this->validate($request, [ 'name'=> 'required',
                                    'email' => 'required|email|unique:users,email',
                                    'password' => 'required|same:confirm-password',
                                    'roles' => 'required']);

        $input = $request->all();

        $input['password'] = Hash::make($input['password']);//criptografando a senha

        $user = User::create($input);//cria novo user

        $user->assignRole($request->input('roles'));//atribuindo um perfil pra esse usuario

        return redirect()->route('users.index')->with('sucess', 'Usuario criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('users.show', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)//só atualiza no front
    {
        $user = User::find($id);//primeiro procura o user

        $roles = Role::pluck('name', 'name')->all();

        $userRole = $user->role->pluck('name', 'name')->all();


        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)//atualiza no backend os dados
    {
        $this->validate($request, [ 'name'=> 'required',
                                    'email' => 'required|email|unique:users,email',
                                    'password' => 'required|same:confirm-password',
                                    'roles' => 'required']);


        $input = $request->all();


        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }
        else{
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);

        $user->update($input);


        DB::table('model_has_roles')->where('model_id', $id)->delete();

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)//método delete
    {
        User::find($id)->delete();

        return redirect()->route('users.index')->with('sucess', 'Usuário removido com sucesso');
    }
}
