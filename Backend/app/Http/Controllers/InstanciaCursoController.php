<?php

namespace App\Http\Controllers;

use App\InstanciaCurso;
use Illuminate\Http\Request;
use Validator;

class InstanciaCursoController extends Controller
{

    /**
     * Metodo que se encarga de bloquear las rutas del controlador Usuario
     */
    public function __construct(){
        $this->middleware(['permission:create instancia curso'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:read instancia curso'], ['only' => 'index']);
        $this->middleware(['permission:update instancia curso'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete instancia curso'], ['only' => 'delete']);
        $this->middleware(['permission:restore instancia curso'], ['only' => 'disabled', 'restore']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try{
            $insCurso = InstanciaCurso::all();
            return response()->json([
                'success' => true,
                'code' => 700,
                'message' => "Operacion realizada con exito",
                'data' =>['insCurso'=> $insCurso]
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
        $entradas = $request->only('semestre', 'curso', 'seccion');
        $validator = Validator::make($entradas, [
            'semestre' => ['required', 'numeric'],
            'curso' => [' required', 'numeric'],
            'seccion' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 301,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        if(!array_key_exists ("semestre" , $entradas)){
            $entradas['semestre'] = null;
        }
        if(!array_key_exists ("curso" , $entradas)){
            $entradas['curso'] = null;
        }
        if(!array_key_exists ("seccion" , $entradas)){
            $entradas['seccion'] = null;
        }
        try{
            $insCurso = new InstanciaCurso();
            $insCurso-> semestre=$entradas['semestre'];
            $insCurso-> curso=$entradas['curso'];
            $insCurso-> seccion=$entradas['seccion'];
            $insCurso->save();
            return response()->json([
                'success' => true,
                'code' => 300,
                'message' => "Operacion realizada con exito",
                'data' => ['insCurso'=>$insCurso]
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
     * @param  \App\InstanciaCurso  $instanciaCurso
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        try{
            $insCurso = InstanciaCurso::Where('semestre', '=' , $id)->get();
            return response()->json([
                'success' => true,
                'code' => 400,
                'message' => "Operacion realizada con exito",
                'data' => ['insCurso'=>$insCurso]
            ], 200);
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 401,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InstanciaCurso  $instanciaCurso
     * @return \Illuminate\Http\Response
     */
    public function edit(InstanciaCurso $instanciaCurso){
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
     * @param  \App\InstanciaCurso  $instanciaCurso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $entradas = $request->only('semestre', 'curso', 'seccion');
        $validator = Validator::make($entradas, [
            'semestre' => ['nullable', 'numeric'],
            'curso' => [' nullable', 'numeric'],
            'seccion' => [' nullable', 'string'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 301,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        if(!array_key_exists ("semestre" , $entradas)){
            $entradas['semestre'] = null;
        }
        if(!array_key_exists ("curso" , $entradas)){
            $entradas['curso'] = null;
        }
        if(!array_key_exists ("seccion" , $entradas)){
            $entradas['seccion'] = null;
        }
        try{
            $insCurso = InstanciaCurso::find($id);
            if ($insCurso == null) {
                return response()->json([
                    'success' => false,
                    'code' => 602,
                    'message' => 'La instancia de escuela con el id '.$id.' no existe',
                    'data' => null
                ], 409);
            }
            if($entradas['semestre']!=null){
                $insCurso->semestre = $entradas['semestre'];
            }
            if($entradas['curso']!=null){
                $insCurso->curso = $entradas['curso'];
            }
            if($entradas['seccion']!=null){
                $insCurso->seccion = $entradas['seccion'];
            }
            $insCurso->save();
            return response()->json([
                'success' => true,
                'code' => 600,
                'message' => "Operacion realizada con exito",
                'data' => ['insCurso'=>$insCurso]
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
     * @param  \App\InstanciaCurso  $instanciaCurso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $insCurso =InstanciaCurso::find($id);
            if ($insCurso == null) {
                return response()->json([
                    'success' => false,
                    'code' => 701,
                    'message' => 'La instancia de curso con el id '.$id.' no existe',
                    'data' => null
                ], 409 );
            }
            $insCurso->delete();
            return response()->json([
                'success' => true,
                'code' => 700,
                'message' => "Operacion realizada con exito",
                'data' =>['insCurso'=> $insCurso]
            ], 200);
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
            $insCursos =InstanciaCurso::onlyTrashed()->get();
            return response()->json([
                'success' => true,
                'code' => 800,
                'message' => "Operacion realizada con exito",
                'data' =>['insCursos'=> $insCursos]
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
            $insCurso=InstanciaCurso::onlyTrashed()->find($id)->restore();
            if($insCurso==false){
                return response()->json([
                    'success' => false,
                    'code' => 901,
                    'message' => "La instancia de curso no se logro recuperar",
                    'data' => ['escuela'=>$insCurso]
                ], 409);
            }
            return response()->json([
                'success' => true,
                'code' => 900,
                'message' => "La escuela recupero con exito",
                'data' => ['insCurso'=>$insCurso]
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
