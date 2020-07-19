<?php

namespace App\Http\Controllers;

use App\Semestre;
use Illuminate\Http\Request;
use Validator;

class SemestreController extends Controller
{

    /**
     * Metodo que se encarga de bloquear las rutas del controlador Usuario
     */
    public function __construct()
    {
        $this->middleware(['permission:create semestre'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:read semestre'], ['only' => 'index']);
        $this->middleware(['permission:update semestre'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete semestre'], ['only' => 'delete']);
        $this->middleware(['permission:restore semestre'], ['only' => 'disabled', 'restore']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $semestres = Semestre::withTrashed()->orderBy('anio')->orderBy('semestre')->get();
            return response()->json([
                'success' => true,
                'code' => 100,
                'message' => "La operacion se a realizado con exito",
                'data' => ['semestres'=>$semestres]
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
            'message' => 'Este recurso está bloqueado',
            'data' => ['error'=>'El el protocolo se llama store']
        ], 426);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entradas = $request->only('anio', 'semestre');
        $validator = Validator::make($entradas, [
            'anio' => ['required', 'numeric'],
            'semestre' => [' required', 'numeric'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 301,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        if(!array_key_exists ("anio" , $entradas)){
            $entradas['anio'] = null;
        }
        if(!array_key_exists ("semestre" , $entradas)){
            $entradas['semestre'] = null;
        }
        try{
            $semestre = new Semestre();
            $semestre-> anio=$entradas['anio'];
            $semestre-> semestre=$entradas['semestre'];
            $semestre->save();
            return response()->json([
                'success' => true,
                'code' => 300,
                'message' => "Operacion realizada con exito",
                'data' => ['semestre'=>$semestre]
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
     * @param  \App\Semestre  $semestre
     * @return \Illuminate\Http\Response
     */
    public function show(Semestre $semestre)
    {
        return response()->json([
            'success' => false,
            'code' => 401,
            'message' => 'Este recurso está bloqueado',
            'data' => ['error'=>'El el protocolo se llama index']
        ], 426);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Semestre  $semestre
     * @return \Illuminate\Http\Response
     */
    public function edit(Semestre $semestre)
    {
        return response()->json([
            'success' => false,
            'code' => 501,
            'message' => 'Este recurso está bloqueado',
            'data' => ['error'=>'El el protocolo se llama update']
        ], 426);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Semestre  $semestre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $entradas = $request->only('anio', 'semestre');
        $validator = Validator::make($entradas, [
            'anio' => ['numeric', 'nullable'],
            'semestre' => ['numeric', 'nullable'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 601,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        if(!array_key_exists ("anio" , $entradas)){
            $entradas['anio'] = null;
        }
        if(!array_key_exists ("semestre" , $entradas)){
            $entradas['semestre'] = null;
        }
        try{
            $semestre = Semestre::find($id);
            if ($semestre == null) {
                return response()->json([
                    'success' => false,
                    'code' => 602,
                    'message' => 'La semestre con el id '.$id.' no existe',
                    'data' => null
                ], 409);
            }
            if($entradas['anio']!=null){
                $semestre->anio = $entradas['anio'];
            }
            if($entradas['semestre']!=null){
                $semestre->semestre = $entradas['semestre'];
            }
            $semestre->save();
            return response()->json([
                'success' => true,
                'code' => 600,
                'message' => "Operacion realizada con exito",
                'data' => ['semestre'=>$semestre]
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
     * @param  \App\Semestre  $semestre
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $semestre = Semestre::find($id);
            if ($semestre == null) {
                return response()->json([
                    'success' => false,
                    'code' => 701,
                    'message' => 'El semestre con el id '.$id.' no existe',
                    'data' => null
                ], 409 );
            }else{
                $semestre->delete();
                return response()->json([
                    'success' => true,
                    'code' => 700,
                    'message' => "Operacion realizada con exito",
                    'data' =>['semestre'=> $semestre]
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
     * 
     */
    public function disabled(){
        try{
            $semestres = Semestre::onlyTrashed()->get();
            return response()->json([
                'success' => true,
                'code' => 800,
                'message' => "Operacion realizada con exito",
                'data' =>['semestres'=> $semestres]
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
     * 
     */
    public function restore($id){
        try{
            $semestre = Semestre::onlyTrashed()->find($id)->restore();
            if($semestre==false){
                return response()->json([
                    'success' => false,
                    'code' => 901,
                    'message' => "La semestre no se logro recuperar",
                    'data' => ['semestre'=>$semestre]
                ], 409);
            }
            return response()->json([
                'success' => true,
                'code' => 900,
                'message' => "La semestre recupero con exito",
                'data' => ['semestre'=>$semestre]
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

    

