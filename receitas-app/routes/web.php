<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[\App\Http\Controllers\registroController::Class,'paginaInicial']);
Route::get('/cadastrar',[\App\Http\Controllers\registroController::Class,'cad']);
Route::get('/cadastrar/salvar',[\App\Http\Controllers\registroController::Class,'inserir']);
Route::get('/consultar',[\App\Http\Controllers\registroController::Class,'consultar']);
Route::put('/atualizar/{id}', [\App\Http\Controllers\registroController::class, 'atualizar']);
Route::get('/excluir/{id}', [\App\Http\Controllers\registroController::class, 'excluir']);