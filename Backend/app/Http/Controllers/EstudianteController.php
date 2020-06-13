<?php

namespace App\Http\Controllers;
use App\Estudiante;
use App\Escuela;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Metodo que se encarga de listar a todos estudiantes
     * Errores code inician 100
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try{
            $estudiantes = Estudiante::all();
            $escuelas=Escuela::orderBy('id','asc')->get();
            foreach ($estudiantes as $estudiante) {
                $estudiante->escuela=$escuelas[$estudiante->escuela-1]->nombre;
            }
            return response()->json([
                'success' => true,
                'code' => 100,
                'message' => "La operacion se a realizado con exito",
                'data' => $estudiantes
            ], 200);
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 101,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => $ex
            ], 409);
        }
    }

    /**
     * Metodo que no sirve deberia redireccionar cuando funciona dentro de laravel
     * Este metodo esta inactivo asi que se manda un error correspondiente
     * Errores code inician 200
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return response()->json([
            'success' => false,
            'code' => 201,
            'message' => 'el cliente debe usar un protocolo distinto',
            'data' => 'El el protocolo se llama store'
        ], 426 );
    }

    /**
     * Metodo que se encarga en crear un estudiante
     * Errores code inician 300
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try{
            $estudiante = new Estudiante();
            $estudiante -> matricula=$request->matricula;
            $estudiante -> rut=$request->rut;
            $estudiante -> nombre_completo=$request->nombre_completo;
            $estudiante -> correo=$request->correo;
            $estudiante -> anho_ingreso=$request->anho_ingreso;
            $estudiante -> situacion_academica=$request->situacion_academica;
            $estudiante -> porcentaje_avance=$request->porcentaje_avance;
            $estudiante -> creditos_aprobados=$request->creditos_aprobados;
            $estudiante -> escuela=$request->escuela;
            $estudiante = $estudiante->save();
            return response()->json([
                'success' => true,
                'code' => 300,
                'message' => "Operacion realizada con exito",
                'data' => $estudiante
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 302,
                'message' => "Error en la base de datos",
                'data' => $ex
            ], 409  );
        }
    }

    /**
     * Metodo que no sirve deberia redireccionar cuando funciona dentro de laravel
     * Este metodo esta inactivo asi que se manda un error correspondiente
     * Errores code inician 400
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show(Estudiante $estudiante){
        return response()->json([
            'success' => false,
            'code' => 401,
            'message' => 'Este recurso está bloqueado',
            'data' => 'El el protocolo se llama index'
        ], 423 );
    }

    /**
     * Metodo que no sirve deberia redireccionar cuando funciona dentro de laravel
     * Este metodo esta inactivo asi que se manda un error correspondiente
     * Errores code inician 500
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit(Estudiante $estudiante){
        return response()->json([
            'success' => false,
            'code' => 501,
            'message' => 'el cliente debe usar un protocolo distinto',
            'data' => 'El el protocolo se llama store'
        ], 426);
    }

    /**
     * Metodo que se encarga de modificar un estudiante
     * Errores code inician 600
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        try{
            $estudiante = Estudiante::find($id);
            $estudiante->nombre_completo = $request->nombre_completo;
            $estudiante->situacion_academica = $request->situacion_academica;
            $estudiante->porcentaje_avance = $request->porcentaje_avance;
            $estudiante->creditos_aprobados = $request->creditos_aprobados;
            $estudiante->escuela = $request->escuela;
            $estudiante->save();
            return response()->json([
                'success' => true,
                'code' => 600,
                'message' => "Operacion realizada con exito",
                'data' => $estudiante
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 604,
                'message' => "Error en la base de datos",
                'data' => $ex
            ], 409 );
        }
    }

    /**
     * Metodo que se encarga de eliminar un estudiante
     * Errores code inician 700
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        try{
            $estudiante = Estudiante::find($id);
            $estudiante->delete();
            return response()->json([
                'success' => true,
                'code' => 700,
                'message' => "Operacion realizada con exito",
                'data' => $estudiante
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 702,
                'message' => "Error en la base de datos",
                'data' => $ex
            ], 409 );
        }
    }
}
