<?php

namespace App\Http\Controllers;

use App\Ayudante_Con_Curso;
use Illuminate\Http\Request;

class AyudanteConCursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ayudanteCurso= Ayudante_Con_Curso::all();
        return compact('ayudanteCurso');
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
        $ayudanteCurso = new Ayudante_Con_Curso();
        $ayudanteCurso-> estudiante=$request->estudiante;
        $ayudanteCurso-> curso=$request->curso;
        $ayudanteCurso->save();
        return compact('ayudanteCurso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ayudante_Con_Curso  $ayudante_Con_Curso
     * @return \Illuminate\Http\Response
     */
    public function show(Ayudante_Con_Curso $ayudante_Con_Curso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ayudante_Con_Curso  $ayudante_Con_Curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Ayudante_Con_Curso $ayudante_Con_Curso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ayudante_Con_Curso  $ayudante_Con_Curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $ayudanteCurso= Ayudante_Con_Curso::find($id);
        $ayudanteCurso->estudiante= $request->estudiante;
        $ayudanteCurso->curso=$request->curso;
        $ayudanteCurso->save();
        return compact('ayudanteCurso'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ayudante_Con_Curso  $ayudante_Con_Curso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ayudanteCurso= Ayudante_Con_Curso::find($id);
        $ayudanteCurso->delete();

    }
    public function disabled(){

        $ayudanteCursos = Ayudante_Con_Curso::onlyTrashed()->get();
        return compact('ayudanteCursos');
    }

    public function restore($id){
        
        $ayudanteCurso = Ayudante_Con_Curso::onlyTrashed()->find($id)->restore();
        compact('ayudanteCurso');
    }

}
