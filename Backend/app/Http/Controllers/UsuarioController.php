<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = User::find($id);
        $usuario-> nombre = $request->nombre;
        $usuario-> carrera = $request->carrera;
        $usuario-> foto = $request->foto;
        $usuario-> email = $request->email;
        $usuario-> password =  $request->password;
        $usuario-> save();//
        return compact('usuario');//para indicar al frontend que se creo el objeto usuario, con los datos obtenidos del request

    }


}
