<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Escuela;
use Validator;

class EscuelaController extends Controller
{

    /**
     * Metodo que se encarga de bloquear las rutas del controlador Escuela
     */
    public function __construct()
    {
        $this->middleware(['permission:create escuela'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:read escuela'], ['only' => 'index']);
        $this->middleware(['permission:update escuela'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete escuela'], ['only' => 'delete']);
    }

    /**
     * Metodo que se encarga de listar a todos escuelas
     * Errores code inician 100
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try{
            $escuelas = Escuela::all();
            return response()->json([
                'success' => true,
                'code' => 100,
                'message' => "La operacion se a realizado con exito",
                'data' => ['escuelas'=>$escuelas]
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
     * Metodo que se encarga de crear una escuela
     * Errores code inician 300
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credentials = $request->only('nombre');
        $validator = Validator::make($credentials, [
            'cod_carrera' => ['number'],
            'nombre' => ['string'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 301,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        try{
            $escuela = new Escuela();
            $escuela->nombre = $request->nombre;
            $escuela->cod_carrera = $request->cod_carrera;
            $escuela = $escuela->save();
            return response()->json([
                'success' => true,
                'code' => 300,
                'message' => "Operacion realizada con exito",
                'data' => ['escuela'=>$escuela]
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 302,
                'message' => "Error en la base de datos",
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    /**
     * Metodo que no sirve deberia redireccionar cuando funciona dentro de laravel
     * Este metodo esta inactivo asi que se manda un error correspondiente
     * Errores code inician 400
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        return response()->json([
            'success' => false,
            'code' => 401,
            'message' => 'Este recurso está bloqueado',
            'data' => ['error'=>'El el protocolo se llama index']
        ], 423);
    }

    /**
     * Metodo que no sirve deberia redireccionar cuando funciona dentro de laravel
     * Este metodo esta inactivo asi que se manda un error correspondiente
     * Errores code inician 500
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        return response()->json([
            'success' => false,
            'code' => 501,
            'message' => 'el cliente debe usar un protocolo distinto',
            'data' => ['error'=>'El el protocolo se llama store']
        ], 426);
    }

    /**
     * Metodo que se encarga de modificar una escuela
     * Errores code inician 600
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $credentials = $request->only('nombre');
        $validator = Validator::make($credentials, [
            'cod_carrera' => ['number', 'nullable'],
            'nombre' => ['string', 'nullable'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 1,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        try{
            $escuela = Escuela::find($id);
            if ($escuela == null) {
                return response()->json([
                    'success' => false,
                    'code' => 602,
                    'message' => 'La escuela con el id '.$id.' no existe',
                    'data' => null
                ], 409);
            }
            if($request->nombre!=null){
                $escuela->nombre = $request->nombre;
            }
            if($request->cod_carrera!=null){
                $escuela->cod_carrera = $request->cod_carrera;
            }
            $escuela-> save();
            return response()->json([
                'success' => true,
                'code' => 600,
                'message' => "Operacion realizada con exito",
                'data' => ['escuela'=>$escuela]
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
     * Metodo que se encarga de eliminar una escuela
     * Errores code inician 700
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        try{
            $escuela = Escuela::find($id);
            if ($escuela == null) {
                $escuela->delete();
                return response()->json([
                    'success' => false,
                    'code' => 701,
                    'message' => 'El escuela con el id '.$id.' no existe',
                    'data' => null
                ], 409 );
            }else{
                return response()->json([
                    'success' => true,
                    'code' => 700,
                    'message' => "Operacion realizada con exito",
                    'data' =>['escuela'=> $escuela]
                ], 200);
            }
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 702,
                'message' => "Error en la base de datos",
                'data' => ['error'=>$ex]
            ], 409 );
        }
    }
}
