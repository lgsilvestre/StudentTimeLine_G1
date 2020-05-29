<?php

namespace App\Http\Controllers;
use App\User;
use App\Images;
use Illuminate\Support\Facades\Response;
use Validator;
use Illuminate\Http\Request;
use App\Carrera;
use Image; 

class UsuarioController extends Controller
{
    
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
            return $users;
        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 5,
                'message' => 'Error al solicitar peticiones a la base de datos'], 401);
        }
        $users = User::all();
         
        foreach ($users as $user) {
           // $user->carrera_obtencion;
            # code...
            $carrera = Carrera::where('id',$user->carrera)->first();
            $user->nombre_carrera=$carrera->nombre;
        }
        #dd($users);
        //$users1 = User::join('carreras','carreras.id','=','users.carrera')->select("users.*","carreras.nombre as nombre_carrera");

        return $users;
    }

    /**
     * Metodo que permite modificar un usuario de la base de datos
     */
    public function update(Request $request, $id)
    {
        //Se puede modificar el rol?
        //Deberia
        $credentials = $request->only('nombre', 'carrera', 'foto', 'email', 'password');
        $validator = Validator::make($credentials, [
            'nombre' => ['string', 'nullable'],
            'carrera' => ['integer', 'nullable'],
            'foto' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048','nullable'],
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
            if($request->nombre!=null){
                $usuario-> nombre = $request->nombre;
            }
            if($request->carrera!=null){
                $usuario-> carrera = $request->carrera;
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
                $usuario-> email = $request->email;
            }
            if($request->password!=null){
                $usuario-> password =  bcrypt($request->password);
            }            
            $usuario-> save();//
            return compact('usuario');//para indicar al frontend que se creo el objeto usuario, con los datos obtenidos del request
        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 5,
                'message' => 'Error al solicitar peticiones a la base de datos'], 401);
        }
       

        $validator = Validator::make($request->all(),[
            'nombre' => 'required|string',
            'carrera' => 'required|string',
            'foto' => 'image|nullable',
            'email' => 'required|email',
            'password' => 'required'
        ]);
 
        if ($validator->fails())
        {
            // It failed
            return response($validator->messages());
        }
    
        $usuario = User::find($id);
        $usuario-> nombre = $request->nombre;
        $usuario-> carrera = $request->carrera;
        $usuario-> foto = $request->foto;
        $usuario-> email = $request->email;
        $usuario-> password =  $request->password;
        $usuario-> save();//
        return compact('usuario');//para indicar al frontend que se creo el objeto usuario, con los datos obtenidos del request
    }

    /**
     * Metodo que permite obtener un usuario de la base de datos
     */
    public function show($id)
    {
        try{
            $user = User::findOrFail($id);
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
            'carrera' => ['required', 'integer'], //Cambiar lo de la foreign key dps
            'rol' => ['required','string'], 
            'foto' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048','nullable'],
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
            $user ->carrera=$request->carrera;
            $user ->rol=$request->rol;
            $user ->email=$request->email;
            $user ->password=bcrypt($request->password);
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
            $user->assignRole($request->rol);
            return compact('user');

        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 5,
                'message' => 'Error al solicitar peticiones a la base de datos'], 401);
        }
        //catch que se encarga en responder que paso en la sentencia sql
 
    }
    
    /**
     * Metodo que se encarga de eliminar un usuario con de la base de datos de manera logica
     */
    public function destroy($id)
    {
        try{
            $user = User::find($id);
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
