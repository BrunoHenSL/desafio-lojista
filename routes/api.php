<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuariosController;

//rotas da carteira dos 2 tipos
// Route::get('/carteira', 'CarteiraController@listarCarteiras');
// Route::get('/carteira/{id}', 'CarteiraController@mostrarSaldo');
// Route::post('/carteira', 'CarteiraController@criarCarteira');
// Route::post('/carteira/transferir', 'CarteiraController@transferir');

//rota de transferencia
// Route::post('/transfer', 'TransferenciaController@transferirDinheiro');

//rota do usuario
Route::get('/usuarios', [
    UsuariosController::class, 'listarUsuarios']
);

