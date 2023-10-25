<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//rotas da carteira dos 2 tipos
Route::get('/carteira', 'CarteiraController@listarCarteiras');
Route::get('/carteira/{id}', 'CarteiraController@mostrarSaldo');
Route::post('/carteira', 'CarteiraController@criarCarteira');
Route::post('/carteira/transferir', 'CarteiraController@transferir');

//rota de transferencia
Route::post('/transfer', 'TransferenciaController@transferirDinheiro');

//rota do usuários (estou testando desta forma a sintaxe, pois a anteriores não estou conseguindo êxito ao puxar elas)
Route::get('/usuarios', [UsuariosController::class, 'index']);
Route::get('/usuarios/{id}', [UsuariosController::class, 'show']);

