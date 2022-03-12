<?php

use Illuminate\Support\Facades\Route;

//método get -> oferece a alguém fazer o get via browser
Route::get('/', function () {
    return view('welcome');
});


Route::get('/avisos', function () {
    return view('avisos', ['nome'=> 'Guilherme',
                                    'mostrar'=>true,
                                    'avisos' => [   ['id' => 1, 'aviso' => 'Mussum Ipsum, cacilds vidis litro abertis.'],
                                                    ['id' => 2, 'aviso' => 'Todo mundo vê os porris que eu tomo, mas ninguém vê os tombis que eu levo!.'],
                                                    ['id' => 3, 'aviso' => 'Quem num gosta di mim que vai caçá sua turmis!.']
                                    ]]);
});

Route::get('/pi', function () {
    return view('index', ['nome'=> 'Projeto PI 3º Semestre',
                                    'mostrar'=>true,
                                    'avisos' => [   ['id' => 1, 'aviso' => 'E-Commerce de roupas e brinquedos de criança usados?'],
                                                    ['id' => 2, 'aviso' => 'E-commerce de tênis/roupas raras?'],
                                                    ['id' => 3, 'aviso' => 'Se vira ai man, penseeee']
                                    ]]);
});
