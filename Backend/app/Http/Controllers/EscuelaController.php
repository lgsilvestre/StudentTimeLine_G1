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
        $this->middleware(['permission:restore escuela'], ['only' => 'disabled', 'restore']);
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
        $entradas = $request->only('cod_escuela', 'nombre');
        $validator = Validator::make($entradas, [
            'cod_escuela' => ['required', 'numeric'],
            'nombre' => [' required', 'string'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 301,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        if(!array_key_exists ("cod_escuela" , $entradas)){
            $entradas['cod_escuela'] = null;
        }
        if(!array_key_exists ("nombre" , $entradas)){
            $entradas['nombre'] = null;
        }
        try{
            $escuela = new Escuela();
            $escuela->cod_escuela = $entradas['cod_escuela'];
            $escuela->nombre = $entradas['nombre'];
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
        ], 426);
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
            'data' => ['error'=>'El el protocolo se llama Update']
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
        $entradas = $request->only('cod_escuela', 'nombre');
        $validator = Validator::make($entradas, [
            'cod_escuela' => ['numeric', 'nullable'],
            'nombre' => ['string', 'nullable'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 601,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        if(!array_key_exists ("cod_escuela" , $entradas)){
            $entradas['cod_escuela'] = null;
        }
        if(!array_key_exists ("nombre" , $entradas)){
            $entradas['nombre'] = null;
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
            if($entradas['cod_escuela']!=null){
                $escuela->cod_escuela = $entradas['cod_escuela'];
            }
            if($entradas['nombre']!=null){
                $escuela->nombre = $entradas['nombre'];
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
                'code' => 603,
                'message' => "Error en la base de datos",
                'data' => ['error'=>$ex]
            ], 409 );
        }
    }

    /**
     * Metodo que se encarga de eliminar una escuela
     * Errores code inician 700
     * @param  \App\Escuela  $Escuela
     * @return \Illuminate\Http\Escuela
     */
    public function destroy($id){
        try{
            $escuela = Escuela::find($id);
            if ($escuela == null) {
                return response()->json([
                    'success' => false,
                    'code' => 701,
                    'message' => 'El escuela con el id '.$id.' no existe',
                    'data' => null
                ], 409 );
            }else{
                $escuela->delete();
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

    /**
     * Metodo que se encarga de listar las escuelas eliminadas
     * Errores code inician 800
     */
    public function disabled(){
        try{
            $escuelas = Escuela::onlyTrashed()->get();
            return response()->json([
                'success' => true,
                'code' => 800,
                'message' => "Operacion realizada con exito",
                'data' =>['escuela'=> $escuelas]
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

    /**
     * Metodo que se encarga de recuperar una escuela
     * Errores code inician 900
     */
    public function restore($id){
        try{
            $escuela=Escuela::onlyTrashed()->find($id)->restore();
            if($escuela==false){
                return response()->json([
                    'success' => false,
                    'code' => 901,
                    'message' => "La escuela no se logro recuperar",
                    'data' => ['escuela'=>$escuela]
                ], 409);
            }
            return response()->json([
                'success' => true,
                'code' => 900,
                'message' => "La escuela recupero con exito",
                'data' => ['escuela'=>$escuela]
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
