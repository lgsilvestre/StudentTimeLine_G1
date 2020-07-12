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
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Observacion  $observacion
     * @return \Illuminate\Http\Response
     */
    public function show(Observacion $observacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Observacion  $observacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Observacion $observacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Observacion  $observacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Observacion $observacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Observacion  $observacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Observacion $observacion)
    {
        //
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
