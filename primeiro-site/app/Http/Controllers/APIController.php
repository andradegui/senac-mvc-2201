<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Excepetion\JWTException;
use App\Models\User;

class APIController extends Controller
{
    public $loginAfterSignUp = true;

    public function login(Request $request){
        $token = null;
        $campos_json = json_decode($request->getContent(), JSON_OBJECT_AS_ARRAY);
        // return response()->json(['debug' => $campos_json]);
        $credenciais = ['email'     => $campos_json['email'],
                        'password'  => $campos_json['password']];


        try{

            if(!$token = JWTAuth::attempt($credenciais)){
                return response()->json([   'success' => false, //retorno 400 não autorizado
                                            'error' => 'Credenciais inválidas'], 401);
            }

        }catch(JWTException $e){ //retorno 500 problema com o servidor
            return response()->json([ 'error' => 'Token não criado'], 500);
        }
        //Caso retornar sucesso (token ok, retorno 200 = código ok)
        return response()->json([   'success' => true,
                                    'token' => $token], 200);
    }
}
