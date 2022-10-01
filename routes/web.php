<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('tipoproduto', "App\Http\Controllers\TipoProdutoController@index")->name("tipoproduto.index");
Route::get('tipoproduto/create', "App\Http\Controllers\TipoProdutoController@create")->name("tipoproduto.create");
Route::post('tipoproduto', "App\Http\Controllers\TipoProdutoController@store")->name("tipoproduto.store");
Route::get('tipoproduto/{id}', "App\Http\Controllers\TipoProdutoController@show")->name("tipoproduto.show");
Route::get('tipoproduto/{id}/edit', "App\Http\Controllers\TipoProdutoController@edit")->name("tipoproduto.edit");
Route::put('tipoproduto/{id}', "App\Http\Controllers\TipoProdutoController@update")->name("tipoproduto.update");

Route::get('produto', "App\Http\Controllers\ProdutoController@index")->name("produto.index");
Route::get('produto/create', "App\Http\Controllers\ProdutoController@create")->name("produto.create");
Route::post('produto', "App\Http\Controllers\ProdutoController@store")->name("produto.store");
Route::get('produto/{id}', "App\Http\Controllers\ProdutoController@show")->name("produto.show");
Route::get('produto/{id}/edit', "App\Http\Controllers\ProdutoController@edit")->name("produto.edit");
Route::put('produto/{id}', "App\Http\Controllers\ProdutoController@update")->name("produto.update");


