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
    Route::get('/usuario/disabled','UsuarioController@disabled');
    Route::post('/usuario/restore/{id}','UsuarioController@restore');
    Route::resource('usuario', 'UsuarioController');
    #Controlador de escuela
    Route::get('/escuela/disabled','EscuelaController@disabled');
    Route::post('/escuela/restore/{id}','EscuelaController@restore');
    Route::resource('escuela', 'EscuelaController'); 
    #Controlador de curso
    Route::get('/curso/disabled','CursoController@disabled');
    Route::post('/curso/restore/{id}','CursoController@restore');
    Route::resource('/curso', 'CursoController');
    #Controlador de estudiante
    Route::get('/estudiante/disabled','EstudianteController@disabled');
    Route::post('/estudiante/restore/{id}','EstudianteController@restore');
    Route::post('/estudiante/importar', 'ImportarExcelController@index');
    Route::post('/estudiante/importar', 'ImportarExcelController@importar');
    Route::post('/estudiante/exportar', 'ExportarExcelController@exportar');
    Route::post('/estudiante/exportarPDF', 'ExportarPDFController@exportar');
    Route::resource('/estudiante', 'EstudianteController' );
    #Controlador de Profesor_Con_Curso
    Route::get('/profesorConCurso/disabled','ProfesorConCursoController@disabled');
    Route::post('/profesorConCurso/restore/{id}','ProfesorConCursoController@restore');
    Route::resource('/profesorConCurso', 'ProfesorConCursoController' );
    #Controlador de semestre
    Route::get('/semestre/disabled','SemestreController@disabled');
    Route::post('/semestre/restore/{id}','SemestreController@restore');
    Route::resource('/semestre','SemestreController');
    #controlador de instancia curso
    Route::get('/instanciaCurso/disabled','InstanciaCursoController@disabled');
    Route::post('/instanciaCurso/restore/{id}','InstanciaCursoController@restore');
    Route::resource('/instanciaCurso','InstanciaCursoController');
    #controlador de ayudanteCurso
    Route::get('/ayudanteCurso/disabled','AyudanteConCursoController@disabled');
    Route::post('/ayudanteCurso/restore/{id}','AyudanteConCursoController@restore');
    Route::resource('/ayudanteCurso','AyudanteConCursoController');
    #controlador de observaciones
    Route::get('/observaciones/disabled','ObservacionController@disabled');
    Route::post('/observaciones/restore/{id}','ObservacionController@restore');
    Route::resource('/observaciones','ObservacionController');
    #controlador de categorias
    Route::get('/categorias/disabled','CategoriaController@disabled');
    Route::post('/categorias/restore/{id}','CategoriaController@restore');
    Route::resource('/categorias','CategoriaController');
});

Route::group(['middleware' => [], 'prefix' => 'v1'], function () {
    // Auth
    Route::post('/auth/login', 'TokensController@login');
    Route::post('/auth/refresh', 'TokensController@refreshToken');
    Route::get('/auth/logout', 'TokensController@logoutToken');
    Route::post('/auth/restartPassword', 'TokensController@restartPassword');
    Route::post('/auth/sendRestartPassword', 'TokensController@sendRestartPassword');
    Route::get('/auth/respondWithToken', 'TokensController@respondWithToken');
    Route::post('/estudiante/exportar', 'ExportarExcelController@exportar');
});

#Route::get('/estudiante/exportarPDF', 'ExportarPDFController@exportar');