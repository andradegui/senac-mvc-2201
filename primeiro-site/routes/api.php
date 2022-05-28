<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::prefix('v1')->group(static function (){

// O middleware tipo auth.jwt é uma validação que previne que qualquer um acesse a API
Route::group(['middleware' => 'auth.jwt', 'prefix' => 'v1'], function(){
    Route::get('/vendedores', [App\Http\Controllers\VendoresController::class, 'index']); //Listar
    Route::post('/vendedores', [App\Http\Controllers\VendoresController::class, 'store']); //Criar
    Route::delete('/vendedores/{id}', [App\Http\Controllers\VendoresController::class, 'destroy']); // Deletar
    Route::get('/vendedores/{id}', [App\Http\Controllers\VendoresController::class, 'show']); //Listar específico
    Route::put('/vendedores/{id}', [App\Http\Controllers\VendoresController::class, 'update']); //Listar específico
});

Route::post('login', [App\Http\Controllers\APIController::class, 'login']);
