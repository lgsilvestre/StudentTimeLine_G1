<?php

namespace App\Http\Controllers;

use App\Observacion;
use Illuminate\Http\Request;

class ObservacionController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:create observacion'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:read observacion'], ['only' => 'index']);
        $this->middleware(['permission:update observacion'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete observacion'], ['only' => 'delete']);
        $this->middleware(['permission:restore observacion'], ['only' => 'disabled', 'restore']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $observaciones = Observacion::all();
            return response()->json([
                'success' => true,
                'code' => 100,
                'message' => "La operacion se a realizado con exito",
                'data' => ['observaciones'=>$observaciones]
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'success' => false,
            'code' => 201,
            'message' => 'El cliente debe usar un protocolo distinto',
            'data' => ['error'=>'El protocolo se llama Store']
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
        $entradas = $request->only('ayudante', 'estudiante','titulo', 'descripcion','creador', 'tipo','curso', 'categoria');
        $validator = Validator::make($entradas, [
            'ayudante' => ['required', 'numeric'],
            'estudiante' => [' required', 'numeric'],
            'titulo' => ['required', 'string'],
            'descripcion' => [' required', 'string'],
            'creador' => ['required', 'numeric'],
            'tipo' => [' required', 'string'],
            'curso' => [' required', 'numeric'],
            'categoria' => [' required', 'numeric']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 301,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        if(!array_key_exists ("ayudante" , $entradas)){
            $entradas['ayudante'] = null;
        }
        if(!array_key_exists ("estudiante" , $entradas)){
            $entradas['estudiante'] = null;
        }
        if(!array_key_exists ("titulo" , $entradas)){
            $entradas['titulo'] = null;
        }
        if(!array_key_exists ("descripcion" , $entradas)){
            $entradas['descripcion'] = null;
        }
        if(!array_key_exists ("creador" , $entradas)){
            $entradas['creador'] = null;
        }
        if(!array_key_exists ("tipo" , $entradas)){
            $entradas['tipo'] = null;
        }
        if(!array_key_exists ("curso" , $entradas)){
            $entradas['curso'] = null;
        }
        if(!array_key_exists ("categoria" , $entradas)){
            $entradas['categoria'] = null;
        }
        try{
            $observacion = new Observacion();
            $observacion->ayudante = $entradas['ayudante'];
            $observacion->estudiante = $entradas['estudiante'];
            $observacion->titulo = $entradas['titulo'] ;
            $observacion->descripcion = $entradas['descripcion'];
            $observacion->creador = $entradas['creador'];
            $observacion->tipo = $entradas['tipo'];
            $observacion->curso = $entradas['curso'];
            $observacion->categoria = $entradas['categoria'];
            $observacion->save();
            return response()->json([
                'success' => true,
                'code' => 100,
                'message' => "La operación se ha realizado con éxito.",
                'data' => ['observacion'=>$observacion]
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 102,
                'message' => "Error en la base de datos",
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Observacion  $observacion
     * @return \Illuminate\Http\Response
     */
    public function show(Observacion $observacion)
    {
        return response()->json([
            'success' => false,
            'code' => 401,
            'message' => 'Este recurso está bloqueado',
            'data' => ['error'=>'El protocolo se llama Index']
        ], 426);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Observacion  $observacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Observacion $observacion){
        return response()->json([
            'success' => false,
            'code' => 501,
            'message' => 'el cliente debe usar un protocolo distinto',
            'data' => ['error'=>'El el protocolo se llama Update']
        ], 426);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Observacion  $observacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $entradas = $request->only('ayudante', 'estudiante','titulo', 'descripcion','creador', 'tipo','curso', 'categoria');
        $validator = Validator::make($entradas, [
            'ayudante' => ['nullable', 'numeric'],
            'estudiante' => [' nullable', 'numeric'],
            'titulo' => ['nullable', 'string'],
            'descripcion' => [' nullable', 'string'],
            'profesor' => ['nullable', 'numeric'],
            'tipo' => [' nullable', 'string'],
            'curso' => [' nullable', 'numeric'],
            'categoria' => [' nullable', 'numeric']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 301,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        if(!array_key_exists ("ayudante" , $entradas)){
            $entradas['ayudante'] = null;
        }
        if(!array_key_exists ("estudiante" , $entradas)){
            $entradas['estudiante'] = null;
        }
        if(!array_key_exists ("titulo" , $entradas)){
            $entradas['titulo'] = null;
        }
        if(!array_key_exists ("descripcion" , $entradas)){
            $entradas['descripcion'] = null;
        }
        if(!array_key_exists ("creador" , $entradas)){
            $entradas['creador'] = null;
        }
        if(!array_key_exists ("tipo" , $entradas)){
            $entradas['tipo'] = null;
        }
        if(!array_key_exists ("curso" , $entradas)){
            $entradas['curso'] = null;
        }
        if(!array_key_exists ("categoria" , $entradas)){
            $entradas['categoria'] = null;
        }
        try{
            $observacion = Observacion::find($id);
            if ($observacion == null) {
                return response()->json([
                    'success' => false,
                    'code' => 602,
                    'message' => 'La observacion con el id '.$id.' no existe',
                    'data' => null
                ], 409);
            }
            if($entradas['ayudante']!=null){
                $observacion->ayudante = $entradas['ayudante'];
            }
            if($entradas['estudiante']!=null){
                $observacion->estudiante = $entradas['estudiante'];
            }
            if($entradas['titulo']!=null){
                $observacion->titulo = $entradas['titulo'] ;
            }
            if($entradas['descripcion']!=null){
                $observacion->descripcion = $entradas['descripcion'];
            }
            if($entradas['creador']!=null){
                $observacion->creador = $entradas['creador'];
            }
            if($entradas['tipo']!=null){
                $observacion->tipo = $entradas['tipo'];
            }
            if($entradas['curso']!=null){
                $observacion->curso = $entradas['curso'];
            }
            if($entradas['categoria']!=null){
                $observacion->categoria = $entradas['categoria'];
            }
            $observacion->save();
            return compact('observacion');
            return response()->json([
                'success' => true,
                'code' => 600,
                'message' => "Operacion realizada con exito",
                'data' => ['observacion'=>$observacion]
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Observacion  $observacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $observacion= Observacion::find($id);
            if ($observacion == null) {
                return response()->json([
                    'success' => false,
                    'code' => 701,
                    'message' => 'La observacion con el id '.$id.' no existe',
                    'data' => null
                ], 409 );
            }else{
                $observacion->delete();
                return response()->json([
                    'success' => true,
                    'code' => 700,
                    'message' => "Operacion realizada con exito",
                    'data' =>['observacion'=> $observacion]
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
     * Metodo que se encarga de listar todas las observaciones eliminadas
     * Errores code inician 800
     * @return \Illuminate\Http\Response
     */
    public function disabled(){
        try{
            $observaciones= Observacion::onlyTrashed()->get();
            return response()->json([
                'success' => true,
                'code' => 800,
                'message' => "Operacion realizada con exito",
                'data' =>['observaciones'=> $observaciones]
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
     * Metodo que se encarga recuperar una observación
     * Errores code inician 900
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        try{
            $observacion= Observacion::onlyTrashed()->find($id)->restore();
            if($observacion==false){
                return response()->json([
                    'success' => false,
                    'code' => 901,
                    'message' => "La observacion no se logro recuperar",
                    'data' => ['observacion'=>$observacion]
                ], 409);
            }
            return response()->json([
                'success' => true,
                'code' => 900,
                'message' => "La observacion recupero con exito",
                'data' => ['observacion'=>$observacion]
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
