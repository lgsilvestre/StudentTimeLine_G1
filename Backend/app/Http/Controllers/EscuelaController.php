<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Escuela;

class EscuelaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
    
        $escuelas = Escuela::all();
        #dd($users);
        return $escuelas;
        
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
        $escuela = new Escuela();
        $escuela ->nombre=$request->nombre;
        $r = $escuela->save();
        return compact('escuela');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Escuela  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Escuela  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $escuela = Escuela::find($id);
        if ($escuela != null) {
            $escuela-> nombre = $request->nombre;
            $escuela-> save();
            return compact('escuela');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $escuela = Escuela::find($id);
        if ($escuela != null) {
            $escuela->delete();
            return compact('escuela');
        }
    }
}
