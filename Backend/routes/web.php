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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('User', 'UsuarioController' );

/*RUTAS DE PRUEBA JAVI
#Route::get('/user/datos', 'UsuarioController@index');

#Route::get('/user/datos', 'UsuarioController@createUser');

#Route::get('/users/create', 'UsuarioController@createUser');
*/