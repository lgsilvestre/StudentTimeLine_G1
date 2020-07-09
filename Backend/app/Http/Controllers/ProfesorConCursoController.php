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
        #Podríamos retornar los nombres en lugar del id del profesor y del curso.
        $CursosyProfesores = Profesor_Con_Curso::all();
        return compact('CursosyProfesores');
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
        $profesorCurso->save();
        return compact('profesorCurso');
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
    public function update(Request $request, $id)
    {
        $CursoProfesor = Profesor_Con_Curso::find($id);
        $CursoProfesor->profesor = $request->profesor ;
        $CursoProfesor->curso = $request->curso;
        $CursoProfesor->save();
        return compact('CursoProfesor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profesor_Con_Curso  $profesor_Con_Curso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $profesorCurso = Profesor_Con_Curso::find($id);
        $profesorCurso->delete();
        return $profesorCurso;
    }
    public function disabled(){

        $profesoresCursos= Profesor_Con_Curso::onlyTrashed()->get();
        return compact('profesoresCursos');
    }

    public function restore($id){
        
        $profesorCurso= Profesor_Con_Curso::onlyTrashed()->find($id)->restore();
        
        return response()->json([
            'success' => true,
            'message' => "profesor-Curso recupero con exito",
            'data' => ['profesorCurso'=>$profesorCurso]
        ], 200);
    }



}
