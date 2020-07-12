<?php

namespace App\Http\Controllers;

use App\Observacion;
use Illuminate\Http\Request;

class ObservacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $observaciones = Observacion::all();
        return $observaciones;
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
        $observacion = new Observacion();
        $observacion->ayudante = $request->ayudante;
        $observacion->estudiante = $request->estudiante;
        $observacion->titulo = $request->titulo;
        $observacion->descripcion = $request->descripcion;
        $observacion->profesor = $request->profesor;
        $observacion->tipo = $request->tipo;
        $observacion->curso = $request->curso;
        $observacion->categoria = $request->categoria;
        $observacion->save();
        return response()->json([
            'success' => true,
            'code' => 100,
            'message' => "La operación se ha realizado con éxito.",
            'data' => ['observacion'=>$observacion]
        ], 200);
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
        ], 423);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Observacion  $observacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Observacion $observacion)
    {
        return response()->json([
            'success' => false,
            'code' => 401,
            'message' => 'Este recurso está bloqueado',
            'data' => ['error'=>'El protocolo se llama Update']
        ], 423);
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
        $observacion = Observacion::find($id);
        $observacion->ayudante = $request->ayudante;
        $observacion->estudiante = $request->estudiante;
        $observacion->titulo = $request->titulo;
        $observacion->descripcion = $request->descripcion;
        $observacion->profesor = $request->profesor;
        $observacion->tipo = $request->tipo;
        $observacion->curso = $request->curso;
        $observacion->categoria = $request->categoria;
        $observacion->save();
        return compact('observacion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Observacion  $observacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $observacion= Observacion::find($id);
        $observacion->delete();
        return $observacion;
    }

    /**
     * Metodo que se encarga de listar todas las observaciones eliminadas
     * Errores code inician 800
     * @return \Illuminate\Http\Response
     */
    public function disabled(){

    }

    /**
     * Metodo que se encarga recuperar una observación
     * Errores code inician 900
     * @return \Illuminate\Http\Response
     */
    public function restore($id){

    }
}
