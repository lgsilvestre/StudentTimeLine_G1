<?php

namespace App\Http\Controllers;

use App\Curso;
use Illuminate\Http\Request;
use Validator;

use Tymon\JWTAuth\Facades\JWTAuth;

class CursoController extends Controller
{

    /**
     * Metodo que se encarga de bloquear las rutas del controlador Usuario
     */
    public function __construct()
    {
        $this->middleware(['permission:create curso'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:read curso'], ['only' => 'index']);
        $this->middleware(['permission:update curso'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete curso'], ['only' => 'delete']);
        $this->middleware(['permission:restore curso'], ['only' => 'disabled', 'restore']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try{
            $credenciales = JWTAuth::parseToken()->authenticate();
            if($credenciales->rol=="admin"){
                $cursos = Curso::all();
            }else if($credenciales->rol=="secretaria de escuela"){
                $cursos = Curso::where(function ($query) use ($credenciales) {
                    return $query->where('escuela', '=' , $credenciales->escuela)
                                ->orWhere('escuela', '=' , $credenciales->escuelaAux);
                })->get();
            }else if($credenciales->rol=="profesor"){
                $cursos = Curso::where('escuela', '=' , $credenciales->escuela)->get();
            }else{
                return response()->json([
                    'success' => false,
                    'code' => 102,
                    'message' => 'Error que no deberia pasar en index',
                    'data' => ['error'=>'al momento de buscar el rol del solicitante no lo encuentra']
                ], 409);
            }
            return response()->json([
                'success' => true,
                'code' => 100,
                'message' => "La operacion se a realizado con exito",
                'data' => ['cursos'=>$cursos]
            ], 200);
        //----- Mecanismos anticaidas y reporte de errores -----
        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 103,
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //'nombre','plan','descripcion','escuela'
        $curso = new Curso();
        $curso->nombre = $request->nombre;
        $curso->plan = $request->plan;
        $curso->descripcion = $request->descripcion;
        $curso->escuela = $request->escuela;
        $curso->save();
        return response()->json([
            'success' => true,
            'code' => 100,
            'message' => "La operacion se a realizado con exito",
            'data' => ['curso'=>$curso]
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Curso
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $entradas = $request->only('cod_escuela', 'nombre');
        $validator = Validator::make($entradas, [
            'cod_escuela' => ['numeric', 'nullable'],
            'nombre' => ['string', 'nullable'],
            'cod_escuela' => ['numeric', 'nullable'],
            'nombre' => ['string', 'nullable']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 601,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        try{
            $curso = Curso::find($id);
            if ($curso == null) {
                return response()->json([
                    'success' => false,
                    'code' => 602,
                    'message' => 'La curso con el id '.$id.' no existe',
                    'data' => null
                ], 409);
            }
            if($entradas['nombre']!=null){
                $curso->nombre = $entradas['nombre'];
            }
            if($entradas['plan']!=null){
                $curso->plan = $entradas['plan'];
            }
            if($entradas['descripcion']!=null){
                $curso->descripcion = $entradas['descripcion'];
            }
            if($entradas['escuela']!=null){
                $curso->escuela = $entradas['escuela'];
            }
            $curso-> save();
            return response()->json([
                'success' => true,
                'code' => 600,
                'message' => "Operacion realizada con exito",
                'data' => ['curso'=>$curso]
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
     * Metodo que se encarga de eliminar un curso
     * Errores code inician 700
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        try{
            $curso = Curso::find($id);
            if ($curso == null) {
                return response()->json([
                    'success' => false,
                    'code' => 701,
                    'message' => 'El curso con el id '.$id.' no existe',
                    'data' => null
                ], 409 );
            }else{
                $curso->delete();
                return response()->json([
                    'success' => true,
                    'code' => 700,
                    'message' => "Operacion realizada con exito",
                    'data' =>['curso'=> $curso]
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
            $cursos = Curso::onlyTrashed()->get();
            return response()->json([
                'success' => true,
                'code' => 800,
                'message' => "Operacion realizada con exito",
                'data' =>['cursos'=> $cursos]
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
     * Metodo que se encarga de recuperar un curso
     * Errores code inician 900
     */
    public function restore($id){
        try{
            $curso=Curso::onlyTrashed()->find($id)->restore();
            if($curso==false){
                return response()->json([
                    'success' => false,
                    'code' => 901,
                    'message' => "La escuela no se logro recuperar",
                    'data' => ['curso'=>$curso]
                ], 409);
            }
            return response()->json([
                'success' => true,
                'code' => 900,
                'message' => "La escuela recupero con exito",
                'data' => ['curso'=>$curso]
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
