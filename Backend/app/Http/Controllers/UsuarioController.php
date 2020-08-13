<?php

namespace App\Http\Controllers;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Profesor_Con_Curso;
use App\Log;
use \App\Mail\SendMail;
use Mail;
use App\Mail\Correo;
use App\Mail\EmergencyCallReceived;


use Tymon\JWTAuth\Facades\JWTAuth;

class UsuarioController extends Controller{

    /**
     * Metodo que se encarga de bloquear las rutas del controlador Usuario
     */
    public function __construct()
    {
        $this->middleware(['permission:create user'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:read user'], ['only' => ['index', 'indexProfesor']]);
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
            }else if($credenciales->rol=="secretaria de escuela"){
                $usuarios = User::Where('rol', '=' , 'profesor')->where(function ($query) use ($credenciales) {
                    return $query->where('escuela', '=' , $credenciales->escuela)
                                ->orWhere('escuela', '=' , $credenciales->escuelaAux);
                })->get();
            }else if($credenciales->rol=="profesor"){
                Log::create([
                    'titulo' => "Error de acceso",
                    'accion' => "listar usuario",
                    'tipo' => "Error",
                    'descripcion' => "Un profesor solicito este metodo y no puede, revise el sistema de seguridad del programa",
                    'data' => null,
                    'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
                ]);
                return response()->json([
                    'success' => false,
                    'code' => 101,
                    'message' => 'No tiene los permisos necesarios para realizar esta operacion',
                    'data' => ['error'=>'No deberia llegar aca']
                ], 403);
            }
            foreach ($usuarios as $usuario){
                $usuario->escuela= $usuario->getEscuela->nombre;
                if($usuario->escuelaAux!=null){
                    $usuario->escuelaAux = $usuario->getEscuelaAux->nombre;
                }else{
                    $usuario->escuelaAux = 'no posee otra escuela';
                }
            }
            return response()->json([
                'success' => true,
                'code' => 100,
                'message' => "La operacion se a realizado con exito",
                'data' => ['usuarios'=>$usuarios]
            ], 200);
        //----- Mecanismos anticaidas y reporte de errores -----
        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            Log::create([
                'titulo' => "Error en la base de datos",
                'accion' => "listar usuario",
                'tipo' => "Error",
                'descripcion' => "Al momento de listar los usuarios, hubo un problema en la base de datos",
                'data' => $ex,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
            return response()->json([
                'success' => false,
                'code' => 103,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    /**
     * Metodo que se encarga de listar a todos usuarios
     * Errores code inician 100
     * @return \Illuminate\Http\Response
     */
    public function indexProfesor(){
        try{
            $usuarios = User::Where('rol', '=' , 'profesor')->orderBy('escuela', 'asc')->get();
            foreach ($usuarios as $usuario){
                $usuario->nombreEscuela= $usuario->getEscuela->nombre;
                unset($usuario->foto);
                unset($usuario->created_at);
                unset($usuario->updated_at);
                unset($usuario->deleted_at);
            }
            return response()->json([
                'success' => true,
                'code' => 100,
                'message' => "La operacion se a realizado con exito",
                'data' => ['usuarios'=>$usuarios]
            ], 200);
        //----- Mecanismos anticaidas y reporte de errores -----
        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            Log::create([
                'titulo' => "Error en la base de datos",
                'accion' => "listar usuario",
                'tipo' => "Error",
                'descripcion' => "Al momento de listar los usuarios, hubo un problema en la base de datos",
                'data' => $ex,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
            return response()->json([
                'success' => false,
                'code' => 103,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    /**
     * Metodo que se encarga de listar a todos usuarios
     * Errores code inician 100
     * @return \Illuminate\Http\Response
     */
    public function listarEncargados(){
        try{
            $usuarios = User::Where(function ($query){
                return $query->where('rol', '=' , 'admin')
                            ->orWhere('rol', '=' , 'secretaria de escuela');
                })->get();
            foreach ($usuarios as $usuario){
                unset($usuario->foto);
                unset($usuario->created_at);
                unset($usuario->updated_at);
                unset($usuario->deleted_at);
            }
            return response()->json([
                'success' => true,
                'code' => 100,
                'message' => "La operacion se a realizado con exito",
                'data' => ['usuarios'=>$usuarios]
            ], 200);
        //----- Mecanismos anticaidas y reporte de errores -----
        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            Log::create([
                'titulo' => "Error en la base de datos",
                'accion' => "listar usuario",
                'tipo' => "Error",
                'descripcion' => "Al momento de listar los usuarios, hubo un problema en la base de datos",
                'data' => $ex,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
            return response()->json([
                'success' => false,
                'code' => 103,
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
            'escuelaAux' => ['numeric', 'nullable'], //Cambiar lo de la foreign key dps
            'rol' => ['required','string'], 
            'email'=> ['required','email'],
            'password' => ['required' , 'string', 'nullable']
        ]);
        //respuesta cuando falla
        if ($validator->fails()) {
            Log::create([
                'titulo' => "Error en los datos ingresados",
                'accion' => "Crear usuario",
                'tipo' => "Error",
                'descripcion' => "Los datos ingresados para realizar la creacion de un usuario fueron incorrectos",
                'data' => $validator->errors(),
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
            return response()->json([
                'success' => false,
                'code' => 301,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        if(!array_key_exists ("nombre" , $entradas)){
            $entradas['nombre'] = null;
        }
        if(!array_key_exists ("escuela" , $entradas)){
            $entradas['escuela'] = null;
        }
        if(!array_key_exists ("escuelaAux" , $entradas)){
            $entradas['escuelaAux'] = null;
        }
        if(!array_key_exists ("rol" , $entradas)){
            $entradas['rol'] = null;
        }
        if(!array_key_exists ("email" , $entradas)){
            $entradas['email'] = null;
        }
        if(!array_key_exists ("password" , $entradas)){
            $entradas['password'] = null;
        }
        if($entradas['foto']==null){
            // Nombre de la imagen
            $path = 'image.png';
            // Extensión de la imagen
            $type = pathinfo($path, PATHINFO_EXTENSION);
            // Cargando la imagen
            $data = file_get_contents(public_path('img\image.png'));
            // Decodificando la imagen en base64
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $entradas['foto'] = $base64;
        }

        //En el servidor se trabaja de esta manera
        // if($entradas['foto']==null){
        //     // Nombre de la imagen
            
        //     $path = 'image.png';
        //     // Extensi贸n de la imagen
        //     $type = pathinfo($path, PATHINFO_EXTENSION);
        //     // Cargando la imagen
        //     $data = file_get_contents("/home/proyec44/Backend/storage/image/image.png");
        //     // Decodificando la imagen en base64
        //     $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        //     $entradas['foto'] = $base64;
        // }

        try{
            $usuario = new User();
            $usuario ->nombre=$entradas['nombre'];
            $usuario ->escuela=$entradas['escuela'];
            $usuario ->escuelaAux=$entradas['escuelaAux'];
            $usuario ->rol=$entradas['rol'];
            $usuario->assignRole($entradas['rol']);
            $usuario ->email=$entradas['email'];
            $usuario ->password=bcrypt($entradas['password']);
            $usuario->foto=$entradas['foto'];
            $usuario->save();
            unset($usuario['foto']);
            Log::create([
                'titulo' => "Creacion de un usuario",
                'accion' => "Crear usuario",
                'tipo' => "Informativa",
                'descripcion' => "Se creo un usuario en la base de datos",
                'data' =>  $usuario,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
            return response()->json([
                'success' => true,
                'code' => 300,
                'message' => "Operacion realizada con exito",
                'data' => ['usuario'=>$usuario]
            ], 200);
        //----- Mecanismos anticaidas y reporte de errores -----
        //este catch permite responder directamente que problemas en la peticion SQL
        }catch(\Illuminate\Database\QueryException $ex){ 
            Log::create([
                'titulo' => "Error en la base de datos",
                'accion' => "Crear usuario",
                'tipo' => "Error",
                'descripcion' => "Al momento de crear un usuario, hubo un problema en la base de datos ",
                'data' =>  $ex,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);

            if($ex->errorInfo[1]==1264){
                return response()->json([
                    'success' => false,
                    'code' => 302,
                    'message' => "Error: El id de la escuela debe ser positivo",
                    'data' => ['error'=>$ex]
                ], 409  );
            }else if($ex->errorInfo[1]==1452){
                if(strlen(strstr($ex->errorInfo[2],'FOREIGN KEY (`escuela`) REFERENCES `escuelas` (`id`)'))>0){
                    return response()->json([
                        'success' => false,
                        'code' => 302,
                        'message' => "Error: Escuela inexistente en nuestros registros ",
                        'data' => ['error'=>$ex]
                    ], 409  );

                }
            }else if($ex->errorInfo[1]==1062){
                if(strlen(strstr($ex->errorInfo[2],'users_email_unique'))>0){
                    return response()->json([
                        'success' => false,
                        'code' => 302,
                        'message' => "Error: El correo ingresado ya existe en el sistema. \nPor favor ingrese otro",
                        'data' => ['error'=>$ex]
                    ], 409  );
                }
            }

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
            'message' => 'Error: El cliente debe usar un protocolo distinto',
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
            $usuario = User::find($id);
            if($usuario==null){
                Log::create([
                    'titulo' => "Usuario no encontrado",
                    'accion' => "Edit usuario",
                    'tipo' => "Error",
                    'descripcion' => "El usuario con el id:'.$id.' que se intenta modificar no existe, cabe decir que esto no deberia pasar",
                    'data' => $usuario,
                    'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
                ]);
                return response()->json([
                    'success' => false,
                    'code' => 501,
                    'message' => 'Error: No tenemos información referente a este usuario en nuestra base de datos',
                    'data' => null
                ], 409);
            }
            $usuario->escuela= $usuario->getEscuela->nombre;
            if($usuario->escuelaAux!=null){
                $usuario->escuelaAux = $usuario->getEscuelaAux->nombre;
            }else{
                $usuario->escuelaAux = 'no posee otra escuela';
            }
            $cursos = Profesor_Con_Curso::where('profesor', $id)->get();
            foreach ($cursos as $curso){
                $curso->curso= $curso->getCurso->nombre;
                unset($curso['created_at']);
                unset($curso['updated_at']);
                unset($curso['deleted_at']);
            }
            return response()->json([
                'success' => true,
                'code' => 500,
                'message' => "La operacion se a realizado con exito",
                'data' => ['usuario'=>$usuario,
                        'cursos'=>$cursos]
            ], 200);
        //este catch permite responder directamente que problemas en la peticion SQL
        }catch(\Illuminate\Database\QueryException $ex){ 
            Log::create([
                'titulo' => "Error en la base de datos",
                'accion' => "Edit usuario",
                'tipo' => "Error",
                'descripcion' => "Al momento de utilizar edit de usuario, hubo un problema en la base de datos ",
                'data' =>  $ex,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
            return response()->json([
                'success' => false,
                'code' => 502,
                'message' => "Error: Tenemos problemas con nuestra base de datos, intente mas tarde ",
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
            'email' => ['email', 'nullable'],
            'password' => ['string', 'nullable']
        ]);
        if ($validator->fails()){
            Log::create([
                'titulo' => "Error en los datos ingresados",
                'accion' => "Modificar usuario",
                'tipo' => "Error",
                'descripcion' => "Los datos ingresados para realizar la modificacion de un usuario fueron incorrectos",
                'data' => $validator->errors(),
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
            return response()->json([
                'success' => false,
                'code' => 601,
                'message' => 'Error: Los datos ingresados son incorrectos',
                'data' =>['error'=> $validator->errors()]
            ], 422);
        }
        if(!array_key_exists ("nombre" , $entradas)){
            $entradas['nombre'] = null;
        }
        if(!array_key_exists ("escuela" , $entradas)){
            $entradas['escuela'] = null;
        }
        if(!array_key_exists ("escuelaAux" , $entradas)){
            $entradas['escuelaAux'] = null;
        }
        if(!array_key_exists ("role" , $entradas)){
            $entradas['role'] = null;
        }
        if(!array_key_exists ("email" , $entradas)){
            $entradas['email'] = null;
        }
        if(!array_key_exists ("password" , $entradas)){
            $entradas['password'] = null;
        }
        if(!array_key_exists ("foto" , $entradas)){
            $entradas['foto'] = null;
        }
        try{
            $usuario = User::find($id);
            if($usuario==null){
                Log::create([
                    'titulo' => "Usuario no encontrado",
                    'accion' => "Modificar usuario",
                    'tipo' => "Error",
                    'descripcion' => "El usuario con la id:'.$id.' que se intenta modificar no existe, cabe decir que esto no deberia pasar",
                    'data' => $usuario,
                    'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
                ]);
                return response()->json([
                    'success' => false,
                    'code' => 602,
                    'message' => 'Error: El usuario con el id '.$id.' no existe en nuestro sistema',
                    'data' => null
                ], 409);
            }
            if($entradas['nombre']!=null){
                $usuario->nombre = $entradas['nombre'];;
            }
            if($entradas['foto']!=null){
                $usuario ->foto= $entradas['foto'];;
            }
            if($entradas['email']!=null){
                $usuario->email = $entradas['email'];;
            }
            if($entradas['password']!=null){
                $usuario->password =  bcrypt($entradas['password']);
            }
            //OBTENEMOS LA CREDENCIALES DEL USUARIO QUE MANDO LA SOLICITUD
            $credenciales = JWTAuth::parseToken()->authenticate();
            //Si el usuario que solicita la informacion es un administrador
            if($credenciales->rol == "admin"){
                if($entradas['escuela']!=null){
                    $usuario->escuela = $entradas['escuela'];
                }
                if($entradas['escuelaAux']!=null){
                    $usuario->escuelaAux = $entradas['escuelaAux'];
                }
                if($entradas['role']!=null){
                    $usuario->removeRole($usuario->rol);
                    $usuario->rol = $entradas['role'];
                    $usuario->assignRole($entradas['role']);
                }
            }
            //Usuario secretaria de escuela o profesor
            if($credenciales->rol == "secretaria de escuela" || $credenciales->rol == "profesor"){
                if($entradas['escuela']!=null || $entradas['role']!=null ||  $entradas['escuelaAux']!=null){
                    Log::create([
                        'titulo' => "Se intento inyectar codigo",
                        'accion' => "Modificar usuario",
                        'tipo' => "Intento de hackeo",
                        'descripcion' => "Intentaron de algun modo intentar cambiar parametros que con esos permisos son imposibles",
                        'data' => ['error'=>"Intento modificar 3 variables que con ese permiso seria imposible, se elimino el token"],
                        'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
                    ]);
                    //mandar correo por intento de haking
                    $credenciales = JWTAuth::invalidate($credenciales);
                    return response()->json([
                        'success' => false,
                        'code' => 603,
                        'message' => "Error: No cuenta con los permisos necesarios para realizar esta operacion",
                        'data' => ['error'=>"Intento modificar 3 variables que con ese permiso seria imposible, se elimino el token"]
                    ], 403);
                }
            }
            $usuario->save();
            unset($usuario['foto']);
            Log::create([
                'titulo' => "Modificacion de un usuario",
                'accion' => "Modificar usuario",
                'tipo' => "Informativa",
                'descripcion' => "Un usuario modifico datos con exito",
                'data' => $usuario,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
            return response()->json([
                'success' => true,
                'code' => 600,
                'message' => "Operacion realizada con exito",
                'data' => ['usuario'=>$usuario]
            ], 200);
        //Mecanismos anticaidas y reporte de errores
        //este catch permite responder directamente que problemas en la peticion SQL
        }catch(\Illuminate\Database\QueryException $ex){ 
            Log::create([
                'titulo' => "Error en la base de datos",
                'accion' => "Modificar usuario",
                'tipo' => "Error",
                'descripcion' => "Al momento de modificar un usuario, hubo un problema en la base de datos ",
                'data' =>  $ex,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);

            if($ex->errorInfo[1]==1264){
                return response()->json([
                    'success' => false,
                    'code' => 302,
                    'message' => "Error: l id de la escuela debe ser positivo",
                    'data' => ['error'=>$ex]
                ], 409  );
            }else if($ex->errorInfo[1]==1452){
                if(strlen(strstr($ex->errorInfo[2],'FOREIGN KEY (`escuela`) REFERENCES `escuelas` (`id`)'))>0){
                    return response()->json([
                        'success' => false,
                        'code' => 302,
                        'message' => "Error: Escuela inexistente en nuestros registros ",
                        'data' => ['error'=>$ex]
                    ], 409  );
 
                }
            }else if($ex->errorInfo[1]==1062){
                if(strlen(strstr($ex->errorInfo[2],'users_email_unique'))>0){
                    return response()->json([
                        'success' => false,
                        'code' => 302,
                        'message' => "Error: El correo ingresado ya existe en el sistema. \nPor favor ingrese otro",
                        'data' => ['error'=>$ex]
                    ], 409 );
                }
            }
            return response()->json([
                'success' => false,
                'code' => 302,
                'message' => "Error: No cuenta con los permisos necesarios para realizar esta operacion",
                'data' => ['error'=>$ex]
            ], 409);

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
            $usuario = User::find($id);
            if($usuario==null){
                Log::create([
                    'titulo' => "Error eliminar un usuario",
                    'accion' => "Eliminar usuario",
                    'tipo' => "Error",
                    'descripcion' => "El usuario con la id:'.$id.' que se intenta eliminar no existe, cabe decir que esto no deberia pasar",
                    'data' =>  $usuario,
                    'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
                ]);
                return response()->json([
                    'success' => false,
                    'code' => 701,
                    'message' => 'El usuario con el id '.$id.' no existe',
                    'data' => null
                ], 409 );
            }
            $usuario->delete();
            unset($usuario['foto']);
            Log::create([
                'titulo' => "Eliminacion de un usuario",
                'accion' => "Eliminar usuario",
                'tipo' => "Informativa",
                'descripcion' => "Se elimino un usuario con exito",
                'data' => $usuario,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
            return response()->json([
                'success' => true,
                'code' => 700,
                'message' => "Operacion realizada con exito",
                'data' => ['usuario'=>$usuario]
            ], 200);
        //----- Mecanismos anticaidas y reporte de errores -----
        //catch que se encarga en responder que paso en la sentencia sql
        }catch(\Illuminate\Database\QueryException $ex){ 
            Log::create([
                'titulo' => "Error en la base de datos",
                'accion' => "Eliminar usuario",
                'tipo' => "Error",
                'descripcion' => "Al momento de eliminar un usuario, hubo un problema en la base de datos",
                'data' =>  $ex,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
            return response()->json([
                'success' => false,
                'code' => 702,
                'message' => "Error: Tenemos problemas con nuestra base de datos, intente mas tarde ",
                'data' => ['error'=>$ex]
            ], 409 );
        }
    }
    
    /**
     * Metodo que se encarga de listar a todos usuarios eliminados
     * Errores code inician 800
     * @return \Illuminate\Http\Response
     */
    public function disabled(){
        try{
            $credenciales = JWTAuth::parseToken()->authenticate();
            if($credenciales->rol=="admin"){
                $usuarios = User::onlyTrashed()->get();
            }else if($credenciales->rol=="secretaria de escuela"){
                $usuarios = User::onlyTrashed()->Where('rol', '=' , 'profesor')->where(function ($query) use ($credenciales) {
                    return $query->where('escuela', '=' , $credenciales->escuela)
                                ->orWhere('escuela', '=' , $credenciales->escuelaAux);
                })->get();
            }
            foreach ($usuarios as $usuario){
                $usuario->escuela= $usuario->getEscuela->nombre;
                if($usuario->escuelaAux!=null){
                    $usuario->escuelaAux = $usuario->getEscuelaAux->nombre;
                }else{
                    $usuario->escuelaAux = 'no posee otra escuela';
                }
            }
            return response()->json([
                'success' => true,
                'code' => 800,
                'message' => "La operacion se a realizado con exito",
                'data' => ['usuarios'=>$usuarios]
            ], 200);
        //----- Mecanismos anticaidas y reporte de errores -----
        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            Log::create([
                'titulo' => "Error en la base de datos",
                'accion' => "listar usuarios eliminados",
                'tipo' => "Error",
                'descripcion' => "Al momento de listar los usuarios eliminadas, hubo un problema en la base de datos",
                'data' => $ex,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
            return response()->json([
                'success' => false,
                'code' => 803,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    /**
     * Metodo que se encarga recuperar un usuario
     * Errores code inician 900
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        try{
            $usuario=User::onlyTrashed()->where('id',$id)->first();
            unset($usuario['foto']);
            if($usuario==null){
                Log::create([
                    'titulo' => "Error al recuperar un usuario",
                    'accion' => "Recuperar usuario",
                    'tipo' => "Error",
                    'descripcion' => "Por algun motivo no se pudo recuperar el usuario",
                    'data' =>  $usuario,
                    'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
                ]);
                return response()->json([
                    'success' => false,
                    'code' => 901,
                    'message' => "El usuario no se logro recuperar",
                    'data' => ['usuario'=>$usuario]
                ], 409);
            }
            User::onlyTrashed()->where('id',$id)->restore();
            Log::create([
                'titulo' => "Recuperacion de un usuario",
                'accion' => "Recuperar usuario",
                'tipo' => "Informativa",
                'descripcion' => "Se recupero un usuario con exito",
                'data' =>  $usuario,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
            return response()->json([
                'success' => true,
                'code' => 900,
                'message' => "El usuario recupero con exito",
                'data' => ['usuario'=>$usuario]
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            Log::create([
                'titulo' => "Error en la base de datos",
                'accion' => "Recuperar usuario",
                'tipo' => "Error",
                'descripcion' => "Al momento de recuperar un usuario, hubo un problema en la base de datos ",
                'data' =>  $ex,
                'usuario' =>  JWTAuth::parseToken()->authenticate()['id']
            ]);
            return response()->json([
                'success' => false,
                'code' => 902,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    /**
     * 
     */
    public function contactar(Request $request){
        $entradas = $request->only('destinatarios', 'motivo', 'descripcion');
        $validator = Validator::make($entradas, [
            'destinatarios' => ['required'],
            'motivo' => ['required', 'string'],
            'descripcion' => ['required', 'string']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 301,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        try{
            $credenciales = JWTAuth::parseToken()->authenticate();
            $details = array(
                'opcion' => 3,
                'motivo' => $entradas['motivo'],
                'destinatario' => '',
                'autor' => $credenciales->nombre,
                'escuela' => $credenciales->getEscuela->nombre,
                'descripcion' => $entradas['descripcion'],
            );
            foreach($entradas['destinatarios'] as $destinatario){
                $usuario = User::Where('id', $destinatario)->first();
                $details['destinatario']= $usuario->nombre;
                \Mail::to($usuario['email'])->send(new SendMail($details));
            }
            return response()->json([
                'success' => true,
                'code' => 1,
                'message' => 'Se a mandado el correo exitosamente',
                'data' => null
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'code' => 4,
                'message' => 'Error',
                'data' => $e
            ], 502);
        }
    }

    /**
     * 
     */
    public function recordatorio(Request $request){
        $entradas = $request->only('descripcion', 'motivo');
        $validator = Validator::make($entradas, [
            'descripcion' => ['required', 'string'],
            'motivo' => ['required', 'string']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 301,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        try{
            $credenciales = JWTAuth::parseToken()->authenticate();
            $usuarios = User::Where('rol', 'profesor')->Where('escuela', $credenciales->escuela)->get();
            $details = array(
                'opcion' => 4,
                'motivo' => $entradas['motivo'],
                'escuela' => $credenciales->getEscuela->nombre,
                'profesor' => '',
                'descripcion' => $entradas['descripcion'],
            );
            foreach($usuarios as $usuario){
                $details['profesor']= $usuario->nombre;
                \Mail::to($usuario['email'])->send(new SendMail($details));
            }
            if($credenciales->escuelaAux!=null){
                $usuarios = User::Where('rol', 'profesor')->Where('escuela', $credenciales->escuelaAux)->get();
                $details = array(
                    'opcion' => 4,
                    'motivo' => $entradas['motivo'],
                    'escuela' => $credenciales->getEscuelaAux->nombre,
                    'profesor' => '',
                    'descripcion' => $entradas['descripcion'],
                );
                foreach($usuarios as $usuario){
                    $details['profesor']= $usuario->nombre;
                    \Mail::to($usuario['email'])->send(new SendMail($details));
                }
            }
            return response()->json([
                'success' => true,
                'code' => 1,
                'message' => 'Se a mandado el correo exitosamente',
                'data' => null
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'code' => 4,
                'message' => 'Error',
                'data' => $e
            ], 502);
        }
    }

}
