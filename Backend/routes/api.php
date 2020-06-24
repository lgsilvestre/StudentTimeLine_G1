<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['jwt.auth'], 'prefix' => 'v1'], function () {
    Route::resource('usuario', 'UsuarioController');
    Route::resource('escuela', 'EscuelaController');
});

Route::group(['middleware' => [], 'prefix' => 'v1'], function () {
    // Auth
    Route::post('/auth/login', 'TokensController@login');
    Route::post('/auth/refresh', 'TokensController@refreshToken');
    Route::get('/auth/logout', 'TokensController@logoutToken');
    Route::resource('estudiante', 'EstudianteController' );
    Route::post('/auth/restartPassword', 'TokensController@restartPassword');
});

Route::get('send-mail','MailSend@mailsend');
Route::get('/importar_excel', 'ImportarExcelController@index');
Route::post('/importar_excel/importar', 'ImportarExcelController@importar');

