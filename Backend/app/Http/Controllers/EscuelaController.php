<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Escuela;
use Validator;

use App\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

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
            Log::create([
                'titulo' => "Error en la base de datos",
                'accion' => "listar escuela",
                'tipo' => "Error",
                'descripcion' => "Al momento de listar las escuelas, hubo un problema en la base de datos",
                'data' => $ex,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
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
            Log::create([
                'titulo' => "Error en los datos ingresados",
                'accion' => "Crear escuela",
                'tipo' => "Error",
                'descripcion' => "Los datos ingresados para realizar la creacion de una escuela fueron incorrectos",
                'data' => $validator->errors(),
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
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
            $escuela->save();
            Log::create([
                'titulo' => "Creacion de una escuela",
                'accion' => "Crear escuela",
                'tipo' => "Informativa",
                'descripcion' => "Se creo una escuela en la base de datos",
                'data' =>  $escuela,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
            return response()->json([
                'success' => true,
                'code' => 300,
                'message' => "Operacion realizada con exito",
                'data' => ['escuela'=>$escuela]
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            Log::create([
                'titulo' => "Error en la base de datos",
                'accion' => "Crear escuela",
                'tipo' => "Error",
                'descripcion' => "Al momento de crear una escuela, hubo un problema en la base de datos ",
                'data' =>  $ex,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
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
            Log::create([
                'titulo' => "Error en los datos ingresados",
                'accion' => "Modificar escuela",
                'tipo' => "Error",
                'descripcion' => "Los datos ingresados para realizar la modificacion de la escuela fueron incorrectos",
                'data' => $validator->errors(),
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
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
                Log::create([
                    'titulo' => "Escuela no encontrado",
                    'accion' => "Modificar escuela",
                    'tipo' => "Error",
                    'descripcion' => "La escuela con la id:'.$id.' que se intenta modificar no existe, cabe decir que esto no deberia pasar",
                    'data' => $escuela,
                    'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
                ]);
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
            $escuela->save();
            Log::create([
                'titulo' => "Modificacion de una escuela",
                'accion' => "Modificar escuela",
                'tipo' => "Informativa",
                'descripcion' => "Un usuario modifico una escuela con exito",
                'data' => $escuela,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
            return response()->json([
                'success' => true,
                'code' => 600,
                'message' => "Operacion realizada con exito",
                'data' => ['escuela'=>$escuela]
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            Log::create([
                'titulo' => "Error en la base de datos",
                'accion' => "Modificar escuela",
                'tipo' => "Error",
                'descripcion' => "Al momento de modificar un escuela, hubo un problema en la base de datos ",
                'data' =>  $ex,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
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
                Log::create([
                    'titulo' => "Error eliminar un escuela",
                    'accion' => "Eliminar escuela",
                    'tipo' => "Error",
                    'descripcion' => "La escuela con la id:'.$id.' que se intenta eliminar no existe, cabe decir que esto no deberia pasar",
                    'data' =>  $escuela,
                    'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
                ]);
                return response()->json([
                    'success' => false,
                    'code' => 701,
                    'message' => 'El escuela con el id '.$id.' no existe',
                    'data' => null
                ], 409 );
            }else{
                $escuela->delete();
                Log::create([
                    'titulo' => "Eliminacion de una escuela",
                    'accion' => "Eliminar escuela",
                    'tipo' => "Informativa",
                    'descripcion' => "Se elimino una escuela con exito",
                    'data' => $escuela,
                    'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
                ]);
                return response()->json([
                    'success' => true,
                    'code' => 700,
                    'message' => "Operacion realizada con exito",
                    'data' =>['escuela'=> $escuela]
                ], 200);
            }
        }catch(\Illuminate\Database\QueryException $ex){ 
            Log::create([
                'titulo' => "Error en la base de datos",
                'accion' => "Eliminar escuela",
                'tipo' => "Error",
                'descripcion' => "Al momento de eliminar una escuela, hubo un problema en la base de datos",
                'data' =>  $ex,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
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
            Log::create([
                'titulo' => "Error en la base de datos",
                'accion' => "listar escualas eliminados",
                'tipo' => "Error",
                'descripcion' => "Al momento de listar las escualas eliminadas, hubo un problema en la base de datos",
                'data' => $ex,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
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
            $escuela=Escuela::onlyTrashed()->find($id)->get();
            $resultado = $escuela->restore();
            if($resultado==false){
                Log::create([
                    'titulo' => "Error al recuperar una escuela",
                    'accion' => "Recuperar escuela",
                    'tipo' => "Error",
                    'descripcion' => "Por algun motivo no se pudo recuperar la escuela",
                    'data' =>  $resultado,
                    'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
                ]);
                return response()->json([
                    'success' => false,
                    'code' => 901,
                    'message' => "La escuela no se logro recuperar",
                    'data' => ['escuela'=>$escuela]
                ], 409);
            }
            Log::create([
                'titulo' => "Recuperacion de una escuela",
                'accion' => "Recuperar escuela",
                'tipo' => "Informativa",
                'descripcion' => "Se recupero una escuela con exito",
                'data' =>  $escuela,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
            return response()->json([
                'success' => true,
                'code' => 900,
                'message' => "La escuela recupero con exito",
                'data' => ['escuela'=>$escuela]
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            Log::create([
                'titulo' => "Error en la base de datos",
                'accion' => "Recuperar escuela",
                'tipo' => "Error",
                'descripcion' => "Al momento de recuperar una escuela, hubo un problema en la base de datos ",
                'data' =>  $ex,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
            return response()->json([
                'success' => false,
                'code' => 902,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }
}
