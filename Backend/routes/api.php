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
    Route::resource('curso', 'CursoController');
    Route::get('send-mail','MailSend@mailsend');
    #recuperar deshabilitado escuela
    Route::get('/ver_deshabilitados_escuela','EscuelaController@index_Deshabilitados');
    Route::post('/recuperar_escuela/{id}','EscuelaController@restore');
    #recueperar dehabilitado curso
    Route::get('/ver_deshabilitados_curso','CursoController@index_Deshabilitados');
    Route::post('/recuperar_curso/{id}','CursoController@restore');
    #recueperar dehabilitado usuario
    Route::get('/ver_deshabilitados_usuario','UsuarioController@index_Deshabilitados');
    Route::post('/recuperar_usuario/{id}','UsuarioController@restore');
    #recueperar dehabilitado estudiante
 

    Route::get('/importar_excel', 'ImportarExcelController@index');
    Route::post('/importar_excel/importar', 'ImportarExcelController@importar');
    Route::resource('estudiante', 'EstudianteController' );
    Route::get('/exportar_excel/exportar', 'ExportarExcelController@exportar');
});

Route::group(['middleware' => [], 'prefix' => 'v1'], function () {
    // Auth
    Route::post('/auth/login', 'TokensController@login');
    Route::post('/auth/refresh', 'TokensController@refreshToken');
    Route::get('/auth/logout', 'TokensController@logoutToken');
    Route::post('/auth/restartPassword', 'TokensController@restartPassword');
});

Route::resource('estudiante', 'EstudianteController' );
Route::get('/ver_deshabilitados_estudiante','EstudianteController@index_Deshabilitados');
Route::post('/recuperar_estudiante/{id}','EstudianteController@restore');

