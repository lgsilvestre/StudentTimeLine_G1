<?php

namespace App\Http\Controllers;
use App\User;
use App\Images;
use Illuminate\Support\Facades\Response;
use Validator;
use Illuminate\Http\Request;
use App\Escuela;
use Image; 


class UsuarioController extends Controller
{
    /**
     * Metodo que se encarga de bloquear las rutas del controlador Usuario
     */
    public function __construct()
    {
        $this->middleware(['permission:create user'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:read user'], ['only' => 'index']);
        $this->middleware(['permission:update user'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete user'], ['only' => 'delete']);
    }
  
    /**
     * Metodo que se encarga de listar a todos usuarios
     * Errores code inician 100
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try{
            $users = User::all();
            $escuelas=Escuela::orderBy('id','asc')->get();
            foreach ($users as $user) {
                $user->nombre_carrera= $escuelas[$user->escuela-1]->nombre;
            }
            return response()->json([
                'success' => true,
                'code' => 100,
                'message' => "La operacion se a realizado con exito",
                'data' => $users
            ], 200);
        //----- Mecanismos anticaidas y reporte de errores -----
        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 101,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => $ex
            ], 409);
        }
    }

    /**
     * Metodo que no sirve deberia redireccionar cuando funciona dentro de laravel
     * Este metodo esta inactivo asi que se manda un error correspondiente
     * Errores code inician 200
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return response()->json([
            'success' => false,
            'code' => 201,
            'message' => 'el cliente debe usar un protocolo distinto',
            'data' => 'El el protocolo se llama store'
        ], 426 );
    }

    /**
     * Metodo que se encarga de crear un usuario
     * Errores code inician 300
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){            
        //validador que se encarga de revisar que los datos sean del tipo de dato que se solicito
        //tambien verifica que vengan como por ejemplo el email y el password
        $validator = Validator::make($request->all(), [
            'nombre' => ['required','string'],
            'escuela' => ['required', 'numeric'], //Cambiar lo de la foreign key dps
            'rol' => ['required','string'], 
            'foto' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048','nullable'],
            'email'=> ['required','email'],
            'password' => ['required' , 'string']
        ]);
        //respuesta cuando falla
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 301,
                'message' => 'Error en datos ingresados',
                'data' => $validator->errors()
            ], 422);
        }
        try{
            $user = new User();
            $user ->nombre=$request->nombre;
            $user ->escuela=$request->escuela;
            $user ->rol=$request->rol;
            $user->assignRole($request->rol);
            $user ->email=$request->email;
            $user ->password=bcrypt($request->password);
            if($request->hasfile('foto')){
                $imagen = $request->file('foto');
                $nombreImagen = time () . '.' . $imagen->getClientOriginalExtension();
                Image::make($imagen)->resize(400,400)->save( public_path('/uploads/imagenes/' . $nombreImagen));
                $user->foto=$nombreImagen;
            }else{
                $user ->foto=null;
            }
            $r = $user->save();
            return response()->json([
                'success' => true,
                'code' => 300,
                'message' => "Operacion realizada con exito",
                'data' => $user
            ], 200);
        //----- Mecanismos anticaidas y reporte de errores -----
        //este catch permite responder directamente que problemas en la peticion SQL
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 302,
                'message' => "Error en la base de datos",
                'data' => $ex
            ], 409  );
        }
    }

    /**
     * Metodo que no sirve deberia redireccionar cuando funciona dentro de laravel
     * Este metodo esta inactivo asi que se manda un error correspondiente
     * Errores code inician 400
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        return response()->json([
            'success' => false,
            'code' => 401,
            'message' => 'Este recurso está bloqueado',
            'data' => 'El el protocolo se llama index'
        ], 423 );
    }

    /**
     * Metodo que no sirve deberia redireccionar cuando funciona dentro de laravel
     * Este metodo esta inactivo asi que se manda un error correspondiente
     * Errores code inician 500
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        return response()->json([
            'success' => false,
            'code' => 501,
            'message' => 'el cliente debe usar un protocolo distinto',
            'data' => 'El el protocolo se llama store'
        ], 426 );
    }

    /**
     * Metodo que se encarga de modificar un usuario
     * Errores code inician 600
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $credentials = $request->only('nombre', 'escuela', 'rol', 'foto', 'email', 'password');
        $validator = Validator::make($credentials, [
            'nombre' => ['string', 'nullable'],
            'escuela' => ['numeric', 'nullable'],
            'rol' => ['string', 'nullable'],
            'foto' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048','nullable'],
            'email' => ['email', 'nullable'],
            'password' => ['string', 'nullable']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 601,
                'message' => 'Error en datos ingresados',
                'data' => $validator->errors()
            ], 422);
        }
        try{
            $usuario = User::find($id);
            if($usuario==null){
                return response()->json([
                    'success' => false,
                    'code' => 602,
                    'message' => 'El usuario con el id '.$id.' no existe',
                    'data' => null
                ], 409);
            }
            if($request->nombre!=null){
                $usuario->nombre = $request->nombre;
            }
            if($request->foto!=null){
                if($request->hasfile('foto')){
                    $imagen = $request->file('foto');
                    $nombreImagen = time () . '.' . $imagen->getClientOriginalExtension();
                    Image::make($imagen)->resize(400,400)->save( public_path('/uploads/imagenes/' . $nombreImagen));
                    $usuario->foto=$nombreImagen;
                }
            }
            if($request->email!=null){
                $usuario->email = $request->email;
            }
            if($request->password!=null){
                $usuario->password =  bcrypt($request->password);
            }
            if($request->escuela!=null){
                $usuario->escuela = $request->escuela;
            }
            if($request->rol!=null){
                $usuario->rol = $request->rol;
                $usuario->assignRole($request->rol);
            }
            $usuario->save();
            return response()->json([
                'success' => true,
                'code' => 600,
                'message' => "Operacion realizada con exito",
                'data' => $usuario
            ], 200);
        //Mecanismos anticaidas y reporte de errores
        //este catch permite responder directamente que problemas en la peticion SQL
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 604,
                'message' => "Error en la base de datos",
                'data' => $ex
            ], 409 );
        }
    }

    
    /**
     * Metodo que se encarga de eliminar un usuario
     * Errores code inician 700
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        try{
            $user = User::find($id);
            if($user==null){
                return response()->json([
                    'success' => false,
                    'code' => 701,
                    'message' => 'El usuario con el id '.$id.' no existe',
                    'data' => null
                ], 409 );
            }
            $user->delete();
            return response()->json([
                'success' => true,
                'code' => 700,
                'message' => "Operacion realizada con exito",
                'data' => $user
            ], 200);
        //----- Mecanismos anticaidas y reporte de errores -----
        //catch que se encarga en responder que paso en la sentencia sql
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 702,
                'message' => "Error en la base de datos",
                'data' => $ex
            ], 409 );
        }
    }
}
