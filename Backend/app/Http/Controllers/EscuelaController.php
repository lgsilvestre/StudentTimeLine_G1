<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Escuela;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try{
            $escuelas = Escuela::all();
            #dd($users);
            return $escuelas;
            //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 5,
                'message' => 'Error al solicitar peticiones a la base de datos'], 401);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credentials = $request->only('nombre');
        $validator = Validator::make($credentials, [
            'nombre' => ['string', 'nullable'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 1,
                'message' => 'Error en datos ingresados',
                'errors' => $validator->errors()
            ], 422);
        }
        try{
            $escuela = new Escuela();
            if($request->nombre!=null){
                $escuela-> nombre = $request->nombre;
            }else{
                return response()->json([
                    'success' => false,
                    'code' => 5,
                    'message' => 'El dato escuela no se modifico porque el nombre viene vacio'], 401);
            }
            $r = $escuela->save();
            return compact('escuela');
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 5,
                'message' => 'Error al solicitar peticiones a la base de datos'], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Escuela  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $escuela = Escuela::findOrFail($id);
            if($escuela==null){
                return response()->json([
                    'success' => false,
                    'code' => 1,
                    'message' => 'No existe ninguna escuela con esa id'], 401);
            }
            return $escuela;
        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 5,
                'message' => 'Error al solicitar peticiones a la base de datos'], 401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Escuela  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json([
            'success' => false,
            'code' => 5,
            'message' => 'Este metodo no se encuentra implementado, por favor utilizar otro'], 401);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id){
        $credentials = $request->only('nombre');
        $validator = Validator::make($credentials, [
            'nombre' => ['string', 'nullable'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 1,
                'message' => 'Error en datos ingresados',
                'errors' => $validator->errors()
            ], 422);
        }
        try{
            $escuela = Escuela::find($id);
            if ($escuela == null) {
                return response()->json([
                    'success' => false,
                    'code' => 5,
                    'message' => 'La escuela con el id '.$id.' no existe'], 401);
            }
            if($request->nombre!=null){
                $escuela-> nombre = $request->nombre;
            }else{
                return response()->json([
                    'success' => false,
                    'code' => 5,
                    'message' => 'El dato escuela no se modifico porque el nombre viene vacio'], 401);
            }
            $escuela-> save();
            return compact('escuela');
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 5,
                'message' => 'Error al solicitar peticiones a la base de datos'], 401);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        try{
            $escuela = Escuela::find($id);
            if ($escuela != null) {
                $escuela->delete();
                return compact('escuela');
            }else{
                return response()->json([
                    'success' => false,
                    'code' => 2,
                    'message' => 'La escuela con el id '.$id.' no existe'], 401);
            }
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 5,
                'message' => 'Error al solicitar peticiones a la base de datos'], 401);
        }
    }
}
