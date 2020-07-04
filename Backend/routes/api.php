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
    #Controlador de usuario
    Route::resource('usuario', 'UsuarioController');
    Route::get('usuario/disabled','UsuarioController@disabled');
    Route::post('usuario/restore/{id}','UsuarioController@restore');
    #Controlador de escuela
    Route::resource('escuela', 'EscuelaController'); 
    Route::get('escuela/disabled','EscuelaController@disabled');
    Route::post('escuela/restore/{id}','EscuelaController@restore');
    #Controlador de curso
    Route::resource('curso', 'CursoController');
    Route::get('curso/disabled','CursoController@disabled');
    Route::post('curso/restore/{id}','CursoController@restore');
    #Controlador de estudiante
    Route::resource('estudiante', 'EstudianteController' );
    Route::get('estudiante/disabled','EstudianteController@disabled');
    Route::post('estudiante/restore/{id}','EstudianteController@restore');
    #Controlador importar y exportar estudiante
    Route::post('estudiante/importar', 'ImportarExcelController@index');
    Route::get('estudiante/exportar', 'ExportarExcelController@index');
});

Route::group(['middleware' => [], 'prefix' => 'v1'], function () {
    // Auth
    Route::post('/auth/login', 'TokensController@login');
    Route::post('/auth/refresh', 'TokensController@refreshToken');
    Route::get('/auth/logout', 'TokensController@logoutToken');
    Route::post('/auth/restartPassword', 'TokensController@restartPassword');
});

