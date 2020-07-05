<?php

namespace App\Http\Controllers;

use App\Profesor_Con_Curso;
use Illuminate\Http\Request;

class ProfesorConCursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        $profesorCurso= new Profesor_Con_curso();
        $profesorCurso-> profesor=$request->profesor;
        $profesorCurso-> curso=$request->curso;
        $profesorCurso-> anio=$request->anio;
        $profesorCurso-> semestre=$request->semestre;
        $profesorCurso->save();
        return $profesorCurso;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profesor_Con_Curso  $profesor_Con_Curso
     * @return \Illuminate\Http\Response
     */
    public function show(Profesor_Con_Curso $profesor_Con_Curso)
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
     * @param  \App\Profesor_Con_Curso  $profesor_Con_Curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Profesor_Con_Curso $profesor_Con_Curso)
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
     * @param  \App\Profesor_Con_Curso  $profesor_Con_Curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profesor_Con_Curso $profesor_Con_Curso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profesor_Con_Curso  $profesor_Con_Curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profesor_Con_Curso $profesor_Con_Curso)
    {
        //
    }
}
