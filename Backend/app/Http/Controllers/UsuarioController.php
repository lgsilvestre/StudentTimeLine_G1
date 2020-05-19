<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

//Cambiar después a UserController
class UsuarioController extends Controller
{
    #Retorna listado de todos los usuarios
    public function index()
    {
        $users = User::all();
        #dd($users);
        return $users;
    }

    //Lo creé para hacer el testing de index
    public function show($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    #public function createUser(Request $request)
    //Store
    public function store(Request $request)
    {
        /*
        $request = new Request([
            'nombre'   => 'Pepito',
            'carrera' => '1',
            'rol' => 'Administrador', 
            'foto' => '1',
            'email'=> 'pepito@hotmail.com',
            'password' => 'papa123',
        ]);*/

        $user = new User();
        $user ->nombre=$request->nombre;
        $user ->carrera=$request->carrera;
        $user ->rol=$request->rol;
        $user ->foto=$request->foto;
        $user ->email=$request->email;
        $user ->password=$request->password;
        $r = $user ->save();
        dd($r);
        //return $user ;
    }
}
