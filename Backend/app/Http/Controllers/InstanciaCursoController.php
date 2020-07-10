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
       $insCurso = InstanciaCurso::all();
       return response()->json([
            'success' => true,
            'code' => 700,
            'message' => "Operacion realizada con exito",
            'data' =>['insCurso'=> $insCurso]
        ], 200);
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
        $insCurso = new InstanciaCurso();
        $insCurso-> semestre=$request->semestre;
        $insCurso-> curso=$request->curso;
        $insCurso->save();
        return response()->json([
            'success' => true,
            'code' => 300,
            'message' => "Operacion realizada con exito",
            'data' => ['insCurso'=>$insCurso]
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InstanciaCurso  $instanciaCurso
     * @return \Illuminate\Http\Response
     */
    public function show(InstanciaCurso $instanciaCurso){
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
        $insCurso = InstanciaCurso::find($id);
        $insCurso->semestre = $request->semestre;
        $insCurso->curso = $request->curso;
        $insCurso->save();
        return response()->json([
            'success' => true,
            'code' => 600,
            'message' => "Operacion realizada con exito",
            'data' => ['insCurso'=>$insCurso]
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InstanciaCurso  $instanciaCurso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $insCurso =InstanciaCurso::find($id);
        $insCurso->delete();
        return response()->json([
            'success' => true,
            'code' => 700,
            'message' => "Operacion realizada con exito",
            'data' =>['insCurso'=> $insCurso]
        ], 200);
        
    }

    public function disabled(){

        $insCursos =InstanciaCurso::onlyTrashed()->get();
        return response()->json([
            'success' => true,
            'code' => 800,
            'message' => "Operacion realizada con exito",
            'data' =>['insCursos'=> $insCursos]
        ], 200);
    }

    public function restore($id){
        
        $insCurso=InstanciaCurso::onlyTrashed()->find($id)->restore();
        return response()->json([
            'success' => true,
            'code' => 900,
            'message' => "La escuela recupero con exito",
            'data' => ['insCurso'=>$insCurso]
        ], 200);
    }

}
