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
  
    #Retorna listado de todos los usuarios
    public function index()
    {
        try{

            $users = User::all();
            $escuelas=Escuela::orderBy('id','asc')->get();
            foreach ($users as $user) {
                $user->nombre_carrera= $escuelas[$user->escuela-1]->nombre;
            }
            
            return $users;
        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 5,
                'message' => 'Error al solicitar peticiones a la base de datos'], 401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return response()->json([
            'success' => false,
            'code' => 5,
            'message' => 'Este metodo no se encuentra implementado, por favor utilizar otro'], 401);
    }

    /**
     * Metodo que permite modificar un usuario de la base de datos
     */
    public function update(Request $request, $id)
    {
        //Se puede modificar el rol?
        //Deberia
        $credentials = $request->only('nombre', 'escuela', 'rol', 'foto', 'email', 'password');
        $validator = Validator::make($credentials, [
            'nombre' => ['string', 'nullable'],
            'escuela' => ['numeric', 'nullable'],
            'rol' => ['string', 'nullable'],
            'foto' => ['image','mimes:jpeg,png,jpg,gif,svg','nullable'],
            'email' => ['email', 'nullable'],
            'password' => ['string', 'nullable']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 1,
                'message' => 'Error en datos ingresados',
                'errors' => $validator->errors()
            ], 422);
        }
        try{
            // las siguientes validaciones es por el motivo que el administrador puede modificar todos o uno de los elementos
            //esto espesificamente evita tener errores de modificaciones en la base de datos por elementos no nules
            $usuario = User::find($id);
            if($usuario==null){
                return response()->json([
                    'success' => false,
                    'code' => 2,
                    'message' => 'El usuario con el id '.$id.' no existe'], 401);
            }
            if($request->nombre!=null){
                $usuario->nombre = $request->nombre;
            }
            if($request->escuela!=null){
                $usuario->escuela = $request->escuela;
            }
            if($request->rol!=null){
                $usuario->rol = $request->rol;
                $usuario->assignRole($request->rol);
            }
            if($request->foto!=null){
                if($request->hasfile('foto')){
                    $imagen = base64_encode(file_get_contents($request->file('foto')));
                    $usuario -> foto = $imagen;
                }
            }
            if($request->email!=null){
                $usuario->email = $request->email;
            }
            if($request->password!=null){
                $usuario->password =  bcrypt($request->password);
            }            
            $usuario -> save();//
            return compact('usuario');//para indicar al frontend que se creo el objeto usuario, con los datos obtenidos del request
        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 5,
                'message' => 'Error al solicitar peticiones a la base de datos'], 401);
        }
    }

    /**
     * Metodo que permite obtener un usuario de la base de datos
     */
    public function show($id)
    {
        try{
            $user = User::findOrFail($id);
            //$user->foto = base64_decode($user["foto"]); //Lo uso para decodificar la imagen y poder verla en postman
            if($user==null){
                return response()->json([
                    'success' => false,
                    'code' => 1,
                    'message' => 'No existe ninguna usuario con esa id'], 401);
            }
        //return response($user->foto)->header('Content-Type', 'image/png'); //El front tendrá que decodificar la imagen
        return $user;
        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 5,
                'message' => 'Error al solicitar peticiones a la base de datos'], 401);
        }
    }

    /**
     * Metodo que permite crear un usuario en la base de datos
     */
    public function store(Request $request)
    {            
        //validador que se encarga de revisar que los datos sean del tipo de dato que se solicito
        //tambien verifica que vengan como por ejemplo el email y el password
        $validator = Validator::make($request->all(), [
            'nombre' => ['required','string'],
            'escuela' => ['required', 'numeric'], //Cambiar lo de la foreign key dps
            'rol' => ['required','string'], 
            'foto' => ['image','mimes:jpeg,png,jpg,gif,svg','nullable'],
            'email'=> ['required','email'],
            'password' => ['required' , 'string']
        ]);
        //respuesta cuando falla
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 1,
                'message' => 'Error en datos ingresados',
                'errors' => $validator->errors()
            ], 422);
        }
        try{
            $user = new User();
            $user ->nombre=$request->nombre;
            $user ->escuela=$request->escuela;
            $user ->rol=$request->rol;
            $user ->email=$request->email;
            $user ->password=bcrypt($request->password);
            if($request->hasfile('foto')){
                //Sirve para almacenar la imagen del usuario de manera local
                /*
                $imagen = $request->file('foto');
                $nombreImagen = time () . '.' . $imagen->getClientOriginalExtension();
                Image::make($imagen)->resize(400,400)->save( public_path('/uploads/imagenes/' . $nombreImagen));
                $user->foto=$nombreImagen;*/

                //Ahora se guarda en la BD
                $imagen = base64_encode(file_get_contents($request->file('foto')));
                $user -> foto = $imagen;
            }else{
                $user-> foto = null;
            }
            $r = $user->save();
            $user->assignRole($request->rol);
            return compact('user');

        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 5,
                'message' => 'Error al solicitar peticiones a la base de datos'], 401);
        } 
    }
    
    /**
     * Metodo que se encarga de eliminar un usuario con de la base de datos de manera logica
     */
    public function destroy($id)
    {
        try{
            $user = User::find($id);
            if($user==null){
                return response()->json([
                    'success' => false,
                    'code' => 2,
                    'message' => 'El usuario con el id '.$id.' no existe'], 401);
            }
            $user->delete();
            return compact('user');
        //catch que se encarga en responder que paso en la sentencia sql
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 5,
                'message' => 'Error al solicitar peticiones a la base de datos'], 401);
        }
    }
}
