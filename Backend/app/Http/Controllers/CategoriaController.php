<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:create categoria'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:read categoria'], ['only' => 'index']);
        $this->middleware(['permission:update categoria'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete categoria'], ['only' => 'delete']);
        $this->middleware(['permission:restore categoria'], ['only' => 'disabled', 'restore']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $categorias = Categoria::all();
            return response()->json([
                'success' => true,
                'code' => 100,
                'message' => "La operacion se a realizado con exito",
                'data' => ['categorias'=>$categorias]
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
        $entradas = $request->only('nombre');
        $validator = Validator::make($entradas, [
            'nombre' => ['required', 'string']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 301,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        if(!array_key_exists ("nombre" , $entradas)){
            $entradas['nombre'] = null;
        }
        try{
            $categoria= new Categoria();
            $categoria->nombre = $entradas['nombre'];
            $categoria->save();
            return response()->json([
                'success' => true,
                'code' => 100,
                'message' => "La operación se ha realizado con éxito",
                'data' => ['categoria'=>$categoria]
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
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        return response()->json([
            'success' => false,
            'code' => 401,
            'message' => 'Este recurso está bloqueado',
            'data' => ['error'=>'El protocolo se llama Index']
        ], 423);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        return response()->json([
            'success' => false,
            'code' => 401,
            'message' => 'Este recurso está bloqueado',
            'data' => ['error'=>'El protocolo se llama Update']
        ], 426);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $entradas = $request->only('nombre');
        $validator = Validator::make($entradas, [
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
        if(!array_key_exists ("nombre" , $entradas)){
            $entradas['nombre'] = null;
        }
        try{
            $categoria = Categoria::find($id);
            if ($categoria == null) {
                return response()->json([
                    'success' => false,
                    'code' => 602,
                    'message' => 'La categoria con el id '.$id.' no existe',
                    'data' => null
                ], 409);
            }
            if($entradas['nombre']!=null){
                $categoria->nombre = $entradas['nombre'];
            }
            $categoria->save();
            return response()->json([
                'success' => true,
                'code' => 600,
                'message' => "Operacion realizada con exito",
                'data' => ['categoria'=>$categoria]
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
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $categoria = Categoria::find($id);
            if ($categoria == null) {
                return response()->json([
                    'success' => false,
                    'code' => 701,
                    'message' => 'El categoria con el id '.$id.' no existe',
                    'data' => null
                ], 409 );
            }else{
                $categoria->delete();
                return response()->json([
                    'success' => true,
                    'code' => 700,
                    'message' => "Operacion realizada con exito",
                    'data' =>['categoria'=> $categoria]
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
     * Metodo que se encarga de listar todas las categorias eliminadas
     * Errores code inician 800
     * @return \Illuminate\Http\Response
     */
    public function disabled(){
        try{
            $categorias= Categoria::onlyTrashed()->get();
            return response()->json([
                'success' => true,
                'code' => 800,
                'message' => "Operacion realizada con exito",
                'data' =>['categorias'=> $categorias]
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
     * Metodo que se encarga recuperar una categoria
     * Errores code inician 900
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        try{
            $categoria= Categoria::onlyTrashed()->find($id)->restore();
            if($categoria==false){
                return response()->json([
                    'success' => false,
                    'code' => 901,
                    'message' => "La categoria no se logro recuperar",
                    'data' => ['categoria'=>$categoria]
                ], 409);
            }
            return response()->json([
                'success' => true,
                'code' => 900,
                'message' => "La categoria se logro recuperar",
                'data' => ['categoria'=>$categoria]
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
