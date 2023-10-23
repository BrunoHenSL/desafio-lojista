<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/carteira', 'CarteiraController@listarCarteiras');
Route::get('/carteira/{id}', 'CarteiraController@mostrarSaldo');
Route::post('/carteira', 'CarteiraController@criarCarteira');
Route::post('/carteira/transferir', 'CarteiraController@transferir');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
