<?php

namespace App\Http\Controllers;

use App\Semestre;
use Illuminate\Http\Request;

class SemestreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semestre = Semestre::all();
        return compact('semestre');
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
            'code' => 401,
            'message' => 'Este recurso está bloqueado',
            'data' => ['error'=>'El el protocolo se llama store']
        ], 423);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $semestre = new Semestre();
        $semestre-> anio=$request->anio;
        $semestre-> semestre=$request->semestre;
        $semestre->save();
        return compact('semestre');
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
        ], 423);
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
            'code' => 401,
            'message' => 'Este recurso está bloqueado',
            'data' => ['error'=>'El el protocolo se llama update']
        ], 423);
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
        $semestre = Semestre::find($id);
        $semestre->anio = $request->anio;
        $semestre->semestre = $request->semestre;
        $semestre->save();
        return compact('semestre');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Semestre  $semestre
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $semestre = Semestre::find($id);
        $semestre->delete();
        return compact('semestre');
    }

    public function disabled(){

        $semestres = Semestre::onlyTrashed()->get();
        return compact('semestres');
    }

    public function restore($id){
        $semestre = Semestre::onlyTrashed()->find($id)->restore();
        return response()->json([
            'success' => true,
            'message' => 'el semestre se recupero con exito',
            'data' => ['semstre'=>$semestre]
        ], 200);
    }

}

    

