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

Route::get('/', 'PessoaController@index');

/* ROTAS PESSOA */
Route::get('/pessoa/create', 'PessoaController@create');
Route::post('/pessoa/add', 'PessoaController@add');
Route::get('/pessoa/{id}/edit', 'PessoaController@edit');
Route::put('/pessoa/{id}', 'PessoaController@update');
Route::delete('/pessoa/{id}', 'PessoaController@destroy');

/* ROTAS CATEGORIA */
Route::get('/categoria/create', 'CategoriaController@create');
Route::post('/categoria/add', 'CategoriaController@add');
