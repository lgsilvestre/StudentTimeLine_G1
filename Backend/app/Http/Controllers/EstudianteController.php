<?php

namespace App\Http\Controllers;
use App\Estudiante;
use App\Observacion;
use App\Ayudante_Con_Curso;
use App\Profesor_Con_Curso;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

use Validator;

class EstudianteController extends Controller
{

    /**
     * Metodo que se encarga de bloquear las rutas del controlador Usuario
     */
    public function __construct()
    {
        $this->middleware(['permission:create estudiante'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:read estudiante'], ['only' => ['index','edit']]);
        $this->middleware(['permission:update estudiante'], ['only' => 'update']);
        $this->middleware(['permission:delete estudiante'], ['only' => 'delete']);
        $this->middleware(['permission:restore estudiante'], ['only' => 'disabled', 'restore']);
    }


    /**
     * Metodo que se encarga de listar a todos estudiantes
     * Errores code inician 100
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try{
            $estudiantes = Estudiante::all();
            foreach ($estudiantes as $estudiante) {
                $estudiante->escuela=$estudiante->getEscuela->nombre;
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
        if(array_key_exists ("rut" , $entradas)){
            if(gettype($entradas['rut']=="integer")){
                $entradas['rut'] = strval($entradas['rut']);
            }
        }
        $validator = Validator::make($entradas, [
            'matricula' => ['required','string'],
            'rut' => ['required', 'string'],
            'nombre_completo' => ['required', 'string'],
            'correo' => ['required','email'], 
            'anho_ingreso' => ['required','numeric'],
            'situacion_academica' => ['required','string'],
            'porcentaje_avance' => ['required', 'numeric'],
            'creditos_aprobados' => ['required','numeric'], 
            'escuela' => ['required','numeric']
        ]);
        //respuesta cuando falla
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 301,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        if(!array_key_exists ("matricula" , $entradas)){
            $entradas['matricula'] = null;
        }
        if(!array_key_exists ("rut" , $entradas)){
            $entradas['rut'] = null;
        }
        if(!array_key_exists ("nombre_completo" , $entradas)){
            $entradas['nombre_completo'] = null;
        }
        if(!array_key_exists ("correo" , $entradas)){
            $entradas['correo'] = null;
        }
        if(!array_key_exists ("anho_ingreso" , $entradas)){
            $entradas['anho_ingreso'] = null;
        }
        if(!array_key_exists ("situacion_academica" , $entradas)){
            $entradas['situacion_academica'] = null;
        }
        if(!array_key_exists ("porcentaje_avance" , $entradas)){
            $entradas['porcentaje_avance'] = null;
        }
        if(!array_key_exists ("creditos_aprobados" , $entradas)){
            $entradas['creditos_aprobados'] = null;
        }
        if(!array_key_exists ("escuela" , $entradas)){
            $entradas['escuela'] = null;
        }
        if(!array_key_exists ("foto" , $entradas)){
            $entradas['foto'] = null;
        }
        try{
            $estudiante = new Estudiante();
            $estudiante->matricula = $entradas['matricula'];
            $estudiante->rut = $entradas['rut'];
            $estudiante->nombre_completo = $entradas['nombre_completo'];
            $estudiante->correo = $entradas['correo'];
            $estudiante->anho_ingreso = $entradas['anho_ingreso'];
            $estudiante->situacion_academica = $entradas['situacion_academica'];
            $estudiante->porcentaje_avance = $entradas['porcentaje_avance'];
            $estudiante->creditos_aprobados = $entradas['creditos_aprobados'];
            $estudiante->escuela = $entradas['escuela'];
            $estudiante->foto = $entradas['foto'];
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
    public function edit($id){
      
        try{
            $estudiante = Estudiante::find($id);
            $estudiante->escuela=$estudiante->getEscuela->nombre;
            if($estudiante==null){
                return response()->json([
                    'success' => false,
                    'code' => 602,
                    'message' => 'El estudiante con el id '.$id.' no existe',
                    'data' => null
                ], 409);
            }
            $observaciones = Observacion::Where('estudiante', '=' , $estudiante['id'])->get(); 
            foreach($observaciones as $observacion){
                $observacion->estudiante=$observacion->getEstudiante->nombre_completo;
                $observacion->creador=$observacion->getCreador->nombre;
                $observacion->tipo=$observacion->getTipo->descripcion;
                if($observacion->curso!=null){
                    $observacion->curso=$observacion->getCurso->nombre;
                }
                $observacion->categoria=$observacion->getCategoria->nombre;
            }
         

            $credenciales = JWTAuth::parseToken()->authenticate();
            $cursos =[];
            if($credenciales->rol=="profesor"){
                $ayudanteEnCursos= Ayudante_Con_Curso::Where('estudiante', '=' , $estudiante['id'] )->get();
                $cursosProfesor= Profesor_Con_Curso::Where('profesor', '=' ,$credenciales->id)->get();            

                foreach($cursosProfesor as $curso){
                    foreach($ayudanteEnCursos as $ayudanteEn){
                        if($ayudanteEn->curso == $curso->curso){
                            $ayudanteEn->nombreCurso = $ayudanteEn->getInstanciacurso->getCurso->nombre;
                            $ayudanteEn->seccion = $ayudanteEn->getInstanciacurso->seccion;
                            $cursos[]=$ayudanteEn;
                        }      
                    }
                }
            }

            return response()->json([
                'success' => true,
                'code' => 600,
                'message' => "Operacion realizada con exito",
                'data' => ['estudiante'=>$estudiante,
                        'observaciones'=>$observaciones,
                        'cursos'=>$cursos]
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
     * Metodo que se encarga de modificar un estudiante
     * Errores code inician 600
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $entradas = $request->only('matricula', 'rut', 'nombre_completo', 'correo' , 'anho_ingreso', 'situacion_academica', 'porcentaje_avance', 'creditos_aprobados', 'escuela', 'foto');
        if(array_key_exists ("rut" , $entradas)){
            if(gettype($entradas['rut']=="integer")){
                $entradas['rut'] = strval($entradas['rut']);
            }
        }
        $validator = Validator::make($entradas, [
            'matricula' => ['nullable','string'],
            'rut' => ['nullable','string'],
            'nombre_completo' => ['nullable','string'],
            'correo' => ['nullable','email'],
            'anho_ingreso' => ['nullable','numeric'],
            'situacion_academica' => ['nullable', 'string'], //Cambiar lo de la foreign key dps
            'porcentaje_avance' => ['nullable', 'numeric'], //Cambiar lo de la foreign key dps
            'creditos_aprobados' => ['nullable','numeric'], 
            'escuela' => ['nullable','numeric']
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
        if(!array_key_exists ("matricula" , $entradas)){
            $entradas['matricula'] = null;
        }
        if(!array_key_exists ("rut" , $entradas)){
            $entradas['rut'] = null;
        }
        if(!array_key_exists ("nombre_completo" , $entradas)){
            $entradas['nombre_completo'] = null;
        }
        if(!array_key_exists ("correo" , $entradas)){
            $entradas['correo'] = null;
        }
        if(!array_key_exists ("anho_ingreso" , $entradas)){
            $entradas['anho_ingreso'] = null;
        }
        if(!array_key_exists ("situacion_academica" , $entradas)){
            $entradas['situacion_academica'] = null;
        }
        if(!array_key_exists ("porcentaje_avance" , $entradas)){
            $entradas['porcentaje_avance'] = null;
        }
        if(!array_key_exists ("creditos_aprobados" , $entradas)){
            $entradas['creditos_aprobados'] = null;
        }
        if(!array_key_exists ("escuela" , $entradas)){
            $entradas['escuela'] = null;
        }
        if(!array_key_exists ("foto" , $entradas)){
            $entradas['foto'] = null;
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
            if($entradas['nombre_completo'] != null){
                $estudiante->nombre_completo = $entradas['nombre_completo'];
            }
            if($entradas['situacion_academica'] != null){
                $estudiante->situacion_academica = $entradas['situacion_academica'];
            }
            if($entradas['porcentaje_avance'] != null){
                $estudiante->porcentaje_avance = $entradas['porcentaje_avance'];
            }
            if($entradas['creditos_aprobados'] != null){
                $estudiante->creditos_aprobados = $entradas['creditos_aprobados'];
            }
            if($entradas['escuela'] != null){
                $estudiante->escuela = $entradas['escuela'];
            }
            if($entradas['foto']!=null){
                $estudiante ->foto= $entradas['foto'];
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

    public function disabled(){
        try{
            $estudiantes = Estudiante::onlyTrashed()->get();
            foreach ($estudiantes as $estudiante) {
                $estudiante->escuela=$estudiante->getEscuela->nombre;
            }
            return response()->json([
                'success' => true,
                'code' => 800,
                'message' => "Operacion realizada con exito",
                'data' =>['estudiantes'=> $estudiantes]
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 801,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    public function restore($id){
        try{
            $estudiante=Estudiante::onlyTrashed()->find($id)->restore();
            if($estudiante==false){
                return response()->json([
                    'success' => false,
                    'code' => 901,
                    'message' => "La estudiante no se logro recuperar",
                    'data' => ['estudiante'=>$estudiante]
                ], 409);
            }
            return response()->json([
                'success' => true,
                'code' => 900,
                'message' => "La estudiante recupero con exito",
                'data' => ['estudiante'=>$estudiante]
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 902,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    
}
