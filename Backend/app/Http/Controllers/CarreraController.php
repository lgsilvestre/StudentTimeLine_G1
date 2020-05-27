<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Carrera;

class CarreraController extends Controller
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
        $carrera = new Carrera();
        $carrera ->nombre=$request->nombre;
        $r = $carrera->save();
        return compact('carrera');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function show(Carrera $carrera)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function edit(Carrera $carrera)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $carrera = Carrera::find($id);
        if ($carrera != null) {
            $carrera-> nombre = $request->nombre;
            $carrera-> save();
            return compact('carrera');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $carrera = Carrera::find($id);
        if ($carrera != null) {
            $carrera->delete();
            return compact('carrera');
        }
    }
}
