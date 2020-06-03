<?php

namespace App\Http\Controllers;
use App\Estudiante;
use App\Escuela;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudiantes = Estudiante::all();
        $escuelas=Escuela::orderBy('id','asc')->get();
        foreach ($estudiantes as $estudiante) {
            $estudiante-> escuela = $escuelas[$estudiante->escuela-1]->nombre;
        }
        return $estudiantes;
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
        $estudiante = new Estudiante();
        $estudiante -> matricula=$request->matricula;
        $estudiante -> rut=$request->rut;
        $estudiante -> nombre_completo=$request->nombre_completo;
        $estudiante -> correo=$request->correo;
        $estudiante -> anho_ingreso=$request->anho_ingreso;
        $estudiante -> situacion_academica=$request->situacion_academica;
        $estudiante -> porcentaje_avance=$request->porcentaje_avance;
        $estudiante -> creditos_aprobados=$request->creditos_aprobados;
        $estudiante -> escuela=$request->escuela;
        $r = $estudiante->save();
        return compact('estudiante');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show(Estudiante $estudiante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit(Estudiante $estudiante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estudiante $estudiante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estudiante $estudiante)
    {
        //
    }
}
