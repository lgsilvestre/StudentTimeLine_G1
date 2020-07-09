<?php

namespace App\Http\Controllers;

use App\InstanciaCurso;
use Illuminate\Http\Request;

class InstanciaCursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $insCurso = InstanciaCurso::all();
       return compact('insCurso');
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
        $insCurso = new InstanciaCurso();
        $insCurso-> semestre=$request->semestre;
        $insCurso-> curso=$request->curso;
        $insCurso->save();
        return compact('insCurso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InstanciaCurso  $instanciaCurso
     * @return \Illuminate\Http\Response
     */
    public function show(InstanciaCurso $instanciaCurso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InstanciaCurso  $instanciaCurso
     * @return \Illuminate\Http\Response
     */
    public function edit(InstanciaCurso $instanciaCurso)
    {
        //
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
        return compact('insCurso');
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
        
    }

    public function disabled(){

        $insCursos =InstanciaCurso::onlyTrashed()->get();
        return compact('insCursos');
    }

    public function restore($id){
        
        $insCurso=InstanciaCurso::onlyTrashed()->find($id)->restore();
        
        return response()->json([
            'success' => true,
            'message' => "la instancia del curso se recupero con exito",
            'data' => ['instanciaCurso'=>$insCurso]
        ], 200);
    }

}
