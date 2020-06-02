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
        try{
            $escuela = new Escuela();
            $escuela ->nombre=$request->nombre;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Escuela  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id){
        try{
            $escuela = Escuela::find($id);
            if ($escuela != null) {
                $escuela-> nombre = $request->nombre;
                $escuela-> save();
                return compact('escuela');
            }
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
            }
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 5,
                'message' => 'Error al solicitar peticiones a la base de datos'], 401);
        }
    }
}
