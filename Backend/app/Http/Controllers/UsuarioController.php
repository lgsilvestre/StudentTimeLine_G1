<?php

namespace App\Http\Controllers;
use App\User;
use App\Images;
use Illuminate\Support\Facades\Response;
use Validator;
use Illuminate\Http\Request;
use App\Escuela;
use Image; 

use Tymon\JWTAuth\Facades\JWTAuth;

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
        $this->middleware(['permission:restore user'], ['only' => 'disabled', 'restore']);
    }
  
    /**
     * Metodo que se encarga de listar a todos usuarios
     * Errores code inician 100
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try{
            $credenciales = JWTAuth::parseToken()->authenticate();
            if($credenciales->rol=="admin"){
                $usuarios = User::all();
                $escuelas=Escuela::withTrashed()->orderBy('id','asc')->get();
            }else if($credenciales->rol=="secretaria de escuela"){
                $usuarios = User::Where('rol', '=' , 'profesor')->where(function ($query) use ($credenciales) {
                    return $query->where('escuela', '=' , $credenciales->escuela)
                                ->orWhere('escuela', '=' , $credenciales->escuelaAux);
                })->get();
                $escuelas=Escuela::withTrashed()->orderBy('id','asc')->get();
            }else if($credenciales->rol=="profesor"){
                return response()->json([
                    'success' => false,
                    'code' => 101,
                    'message' => 'No tiene los permisos necesarios para realizar esta operacion',
                    'data' => ['error'=>'No deberia llegar aca']
                ], 403);
            }else{
                return response()->json([
                    'success' => false,
                    'code' => 101,
                    'message' => 'Error que no deberia pasar en index',
                    'data' => ['error'=>'al momento de buscar el rol del solicitante no lo encuentra']
                ], 409);
            }
            foreach ($usuarios as $usuario) {
                $usuario->nombre_escuela= $escuelas[$usuario->escuela-1]->nombre;
                if($usuario->escuelaAux!=null){
                    $usuario->nombre_escuelaAux= $escuelas[$usuario->escuelaAux-1]->nombre;
                }else{
                    $usuario->nombre_escuelaAux= 'no posee otra escuela';
                }
            }
            return response()->json([
                'success' => true,
                'code' => 100,
                'message' => "La operacion se a realizado con exito",
                'data' => ['usuarios'=>$usuarios,
                            'solicitud' => $credenciales]
            ], 200);
        //----- Mecanismos anticaidas y reporte de errores -----
        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 101,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => ['error'=>$ex]
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
            'data' => ['error'=>'El el protocolo se llama store']
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
        $entradas = $request->only('nombre', 'escuela', 'escuelaAux', 'rol', 'foto', 'email', 'password');
        $validator = Validator::make($entradas, [
            'nombre' => ['required','string'],
            'escuela' => ['required', 'numeric'], //Cambiar lo de la foreign key dps
            'escuelaAux' => ['required', 'numeric', 'nullable'], //Cambiar lo de la foreign key dps
            'rol' => ['required','string'], 
            'foto' => ['image','file'],
            'email'=> ['required','email'],
            'password' => ['required' , 'string']
        ]);
        //respuesta cuando falla
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 301,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        try{
            $user = new User();
            $user ->nombre=$request->nombre;
            $user ->escuela=$request->escuela;
            $user ->escuelaAux=$request->escuelaAux;
            $user ->rol=$request->rol;
            $user->assignRole($request->rol);
            $user ->email=$request->email;
            $user ->password=bcrypt($request->password);
            $user->foto=$request->foto;
            $user = $user->save();
            return response()->json([
                'success' => true,
                'code' => 300,
                'message' => "Operacion realizada con exito",
                'data' => ['usuario'=>$user]
            ], 200);
        //----- Mecanismos anticaidas y reporte de errores -----
        //este catch permite responder directamente que problemas en la peticion SQL
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 302,
                'message' => "Error en la base de datos",
                'data' => ['error'=>$ex]
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
            'message' => 'el cliente debe usar un protocolo distinto',
            'data' => ['error'=>'El el protocolo se llama store']
        ], 426 );
    }

    /**
     * Metodo que permite mostrar los datos de un usuario para luego modificar
     * Este metodo se utiliza principalmente por un profesor para ver sus datos antes de eliminarlo, de igual manera para el administrador y secretaria de escuela
     * Errores code inician 500
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        try{
            $user = User::find($id);
            if($user==null){
                return response()->json([
                    'success' => false,
                    'code' => 501,
                    'message' => 'No existe ninguna usuario con esa id',
                    'data' => null
                ], 409);
            }
            $escuelas=Escuela::withTrashed()->orderBy('id','asc')->get();
            $user->nombre_escuela= $escuelas[$user->escuela-1]->nombre;
            //return response($user->foto)->header('Content-Type', 'image/png');
            return response()->json([
                'success' => true,
                'code' => 500,
                'message' => "La operacion se a realizado con exito",
                'data' => ['usuario'=>$user]
            ], 200);
        //este catch permite responder directamente que problemas en la peticion SQL
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 502,
                'message' => "Error en la base de datos",
                'data' => ['error'=>$ex]
            ], 409 );
        }
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
        $entradas = $request->only('nombre', 'escuela', 'escuelaAux', 'role', 'foto', 'email', 'password');
        $validator = Validator::make($entradas, [
            'nombre' => ['string', 'nullable'],
            'escuela' => ['numeric', 'nullable'],
            'escuelaAux' => ['numeric', 'nullable'],
            'role' => ['string', 'nullable'],
            'foto' => ['file'],
            'email' => ['email', 'nullable'],
            'password' => ['string', 'nullable']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 601,
                'message' => 'Error en datos ingresados',
                'data' =>['error'=> $validator->errors()]
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
                $usuario ->foto= $request->foto;
            }
            if($request->email!=null){
                $usuario->email = $request->email;
            }
            if($request->password!=null){
                $usuario->password =  bcrypt($request->password);
            }
            //OBTENEMOS LA CREDENCIALES DEL USUARIO QUE MANDO LA SOLICITUD
            $credenciales = JWTAuth::parseToken()->authenticate();
            //Si el usuario que solicita la informacion es un administrador
            if($credenciales->rol == "admin"){
                if($request->escuela!=null){
                    $usuario->escuela = $request->escuela;
                }
                if($request->escuelaAux!=null){
                    $usuario->escuelaAux = $request->escuelaAux;
                }
                if($request->rol!=null){
                    $usuario->rol = $request->rol;
                    $usuario->assignRole($request->rol);
                }
            }
            //Usuario secretaria de escuela o profesor
            if($credenciales->rol == "secretaria de escuela" || $credenciales->rol == "profesor"){
                if($request->escuela!=null || $request->rol!=null || $request->escuelaAux!=null){
                    $credenciales = JWTAuth::invalidate($credenciales);
                    //mandar correo por intento de haking
                    return response()->json([
                        'success' => false,
                        'code' => 603,
                        'message' => "No tienes los permisos necesarios para realizar esta operacion",
                        'data' => ['error'=>"Intento modificar 3 variables que con ese permiso seria imposible, se elimino el token"]
                    ], 403);
                }
            }
            $usuario->save();
            return response()->json([
                'success' => true,
                'code' => 600,
                'message' => "Operacion realizada con exito",
                'data' => ['usuario'=>$usuario]
            ], 200);
        //Mecanismos anticaidas y reporte de errores
        //este catch permite responder directamente que problemas en la peticion SQL
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 604,
                'message' => "Error en la base de datos",
                'data' => ['error'=>$ex]
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
                'data' => ['usuario'=>$user]
            ], 200);
        //----- Mecanismos anticaidas y reporte de errores -----
        //catch que se encarga en responder que paso en la sentencia sql
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 702,
                'message' => "Error en la base de datos",
                'data' => ['error'=>$ex]
            ], 409 );
        }
    }
    
    /**
     * 
     */
    public function disabled(){
        $usuarios = User::onlyTrashed()->get();
        $escuelas=Escuela::withTrashed()->orderBy('id','asc')->get();
        foreach ($usuarios as $usuario) {
            $usuario->nombre_escuela= $escuelas[$usuario->escuela-1]->nombre;
            if($usuario->escuelaAux!=null){
                $usuario->nombre_escuelaAux= $escuelas[$usuario->escuelaAux-1]->nombre;
            }else{
                $usuario->nombre_escuelaAux= 'no posee otra escuela';
            }
        }
        return response()->json([
            'success' => true,
            'code' => 800,
            'message' => "Operacion realizada con exito",
            'data' => ['usuarios'=>$usuarios]
        ], 200);
    }

    /**
     * 
     */
    public function restore($id){
        $usuario=User::onlyTrashed()->find($id)->restore();
        return response()->json([
            'success' => true,
            'message' => "el estudiante se recupero con exito",
            'data' => ['usuario'=>$usuario]
        ], 200);
    }


}
