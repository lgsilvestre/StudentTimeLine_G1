<?php

namespace App\Http\Controllers;
use App\User;
use App\Images;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Validator;
use Image;

class UsuarioController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware(['permission:create user'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:read user'], ['only' => 'index']);
        $this->middleware(['permission:update user'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete user'], ['only' => 'delete']);
    }*/

    #Retorna listado de todos los usuarios
    public function index()
    {
        $users = User::all();
        #dd($users);
        return $users;
    }

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

    //Lo creé para hacer el testing de index
    public function show($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

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
            
        $validator = Validator::make($request->all(), [
            'nombre' => ['required','string'],
            'carrera' => ['required'], //Cambiar lo de la foreign key dps
            'rol' => ['required','string'], 
            'foto' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048','nullable'],
            'email'=> ['required','email'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) 
        {
            //dd($request);
            return response($validator->messages());
        }
        else
        {
            $user = new User();
            $user ->nombre=$request->nombre;
            $user ->carrera=$request->carrera;
            $user ->rol=$request->rol;
            $user ->email=$request->email;
            $user ->password=$request->password;

            if($request->hasfile('foto'))
            {
                $imagen = $request->file('foto');
                $nombreImagen = time () . '.' . $imagen->getClientOriginalExtension();
                Image::make($imagen)->resize(400,400)->save( public_path('/uploads/imagenes/' . $nombreImagen));
                $user->foto=$nombreImagen;
            }
            else
            {
                $user ->foto=null;
            }
            
            $r = $user->save();
            return compact('user');
        }    
    }
    
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user != null) {
            $user->delete();
            return compact('user');
        }
    }
}
