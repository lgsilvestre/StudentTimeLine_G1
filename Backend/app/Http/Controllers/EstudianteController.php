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
                'data' => ['estudiantes'=>$estudiantes]
            ], 200);
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 101,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => ['error'=>$ex]
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
            'data' => ['error'=>'El el protocolo se llama store']
        ], 426 );
    }

    /**
     * Metodo que se encarga en crear un estudiante
     * Errores code inician 300
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $entradas = $request->only('matricula', 'rut', 'nombre_completo', 'correo', 'anho_ingreso', 'situacion_academica', 'porcentaje_avance', 'creditos_aprobados', 'escuela', 'foto');
        $validator = Validator::make($entradas, [
            'matricula' => ['required','string'],
            'rut' => ['required', 'string'],
            'nombre_completo' => ['required', 'numeric', 'nullable'],
            'correo' => ['required','numeric'], 
            'anho_ingreso' => ['required','numeric'],
            'situacion_academica' => ['required','string'],
            'porcentaje_avance' => ['required', 'string'],
            'creditos_aprobados' => ['required','numeric'], 
            'escuela' => ['required','numeric'],
            'foto' => ['nullable', 'file']
        ]);
        //respuesta cuando falla
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 301,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
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
            $estudiante->foto=$request->foto;
            $estudiante = $estudiante->save();
            return response()->json([
                'success' => true,
                'code' => 300,
                'message' => "Operacion realizada con exito",
                'data' => ['estudiante'=>$estudiante]
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 302,
                'message' => "Error en la base de datos",
                'data' => ['error'=>$ex]
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
            'data' => ['error'=>'El el protocolo se llama index']
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
            'data' => ['error'=>'El el protocolo se llama store']
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
        $entradas = $request->only('nombre_completo', 'situacion_academica', 'porcentaje_avance', 'creditos_aprobados', 'escuela');
        $validator = Validator::make($entradas, [
            'nombre_completo' => ['nullable','string'],
            'situacion_academica' => ['nullable', 'string'], //Cambiar lo de la foreign key dps
            'porcentaje_avance' => ['nullable', 'numeric', 'nullable'], //Cambiar lo de la foreign key dps
            'creditos_aprobados' => ['nullable','numeric'], 
            'escuela' => ['nullable','numeric'],
            'foto' => ['nullable', 'file']
        ]);
        //respuesta cuando falla
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 601,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        try{
            $estudiante = Estudiante::find($id);
            if($estudiante==null){
                return response()->json([
                    'success' => false,
                    'code' => 602,
                    'message' => 'El estudiante con el id '.$id.' no existe',
                    'data' => null
                ], 409);
            }
            if($request->nombre_completo != null){
                $estudiante->nombre_completo = $request->nombre_completo;
            }
            if($request->situacion_academica != null){
                $estudiante->situacion_academica = $request->situacion_academica;
            }
            if($request->porcentaje_avance != null){
                $estudiante->porcentaje_avance = $request->porcentaje_avance;
            }
            if($request->creditos_aprobados != null){
                $estudiante->creditos_aprobados = $request->creditos_aprobados;
            }
            if($request->escuela != null){
                $estudiante->escuela = $request->escuela;
            }
            if($request->foto!=null){
                $estudiante ->foto= $request->foto;
            }
            $estudiante->save();
            return response()->json([
                'success' => true,
                'code' => 600,
                'message' => "Operacion realizada con exito",
                'data' => ['estudiante'=>$estudiante]
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 604,
                'message' => "Error en la base de datos",
                'data' => ['error'=>$ex]
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
            if($estudiante==null){
                return response()->json([
                    'success' => false,
                    'code' => 701,
                    'message' => 'El estudiante con el id '.$id.' no existe',
                    'data' => null
                ], 409 );
            }
            $estudiante->delete();
            return response()->json([
                'success' => true,
                'code' => 700,
                'message' => "Operacion realizada con exito",
                'data' => ['usuario'=>$estudiante]
            ], 200);
        //----- Mecanismos anticaidas y reporte de errores -----
        //catch que se encarga en responder que paso en la sentencia sql
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 702,
                'message' => "Error en la base de datos",
                'data' => ['error'=>$ex]
            ], 409 );
        }
    }

    public function index_Deshabilitados(){

        $estudiantes = Estudiante::onlyTrashed()->get();
        return $estudiantes;
    }

    public function restore($id){
        
        $estudiante=Estudiante::onlyTrashed()->find($id)->restore();
        return response()->json([
            'success' => true,
            'message' => "el estudiante se recupero con exito",
            'data' => ['estudiante'=>$estudiante]
        ], 200);
    }

    
}
