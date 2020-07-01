<?php

namespace App\Http\Controllers;

use App\Curso;
use Illuminate\Http\Request;


class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Curso::all();
        return $cursos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //'nombre','plan','descripcion','escuela'
        $curso = new Curso();
        $curso->nombre = $request->nombre;
        $curso->plan = $request->plan;
        $curso->descripcion = $request->descripcion;
        $curso->escuela = $request->escuela;
        $curso->save();

        return compact('curso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso = Curso::find($id);
        return compact('curso');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $curso = Curso::find($id);
        $curso->nombre = $request->nombre;
        $curso->plan = $request->plan;
        $curso->descripcion = $request->descripcion;
        $curso->escuela = $request->escuela;
        $curso->save();
        return compact('curso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso = Curso::find($id);
        $curso->delete();

        return response()->json(['El curso '.$curso->nombre.' ha sido eliminado con éxito.']);
    }
}
