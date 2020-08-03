<?php

namespace App\Http\Controllers;

use App\User;
use Mail;
use App\Mail\Correo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Exceptions\HttpResponseException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Mail\EmergencyCallReceived;
use \App\Mail\SendMail;

class TokensController extends Controller
{
    /**
     * Metodo que permite iniciar sesion
     */
    public function login(Request $request){
        $credenciales = $request->only('email', 'password');
        $validator = Validator::make($credenciales, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 2,
                'message' => 'Error en las credenciales',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        try{
            $token = JWTAuth::attempt($credenciales);
            if ($token) {
                return response()->json([
                    'success' => true,
                    'code' => 1,
                    'message' => 'Operacion realizada con exito',
                    'data' => ['token'=>$token,
                            'usuario' =>User::where('email', $credenciales['email'])->get()->first()],
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'code' => 3,
                    'message' => 'Error en las credenciales',
                    'data' => ['error'=>$validator->errors()]
                ], 401);
            }
        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 4,
                'message' => 'Error al solicitar peticiones a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    /**
     * Metodo que permite refrescar un token
     */
    public function refreshToken(){
        $token = JWTAuth::getToken();
        try {
            $token = JWTAuth::refresh($token);
            return response()->json([
                'success' => true,
                'code' => 1,
                'message' => 'Operacion realizada con exito',
                'data' => ['token'=>$token],
            ], 200);
        } catch (TokenExpiredException $ex) {
            // We were unable to refresh the token, our user needs to login again
            return response()->json([
                'success' => false,
                'code' => 2,
                'message' => 'Necesita iniciar secion otra vez, porfavor (Expirado)!',
                'data' => null
            ], 422);
        } catch (TokenBlacklistedException $ex) {
            // Blacklisted token
            return response()->json([
                'success' => false,
                'code' => 3,
                'message' => 'Necesita iniciar secion otra vez, porfavor (Lista negra)!',
                'data' => null
            ], 422);
        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 4,
                'message' => 'Error al solicitar peticiones a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    /**
     * Metodo que permite cerrar sesion
     */
    public function logoutToken()
    {
        //  $this->validate($request, ['token' => 'required']);
        $token = JWTAuth::getToken();
        try {
            $token = JWTAuth::invalidate($token);
            return response()->json([
                'success' => true,
                'code' => 1,
                'message' => "Has cerrado la sesión con exito",
                'data' => null
            ], 200);
        //este catch permite responder directamente que problemas en la peticion de Token
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'code' => 2,
                'message' => "No se a podido cerrar la sesión, por favor volver a intentar",
                'data' => null
            ], 422);
        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 3,
                'message' => 'Error al solicitar peticiones a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    /**
     * Metodo que se encarga en recuperar la contraseña
     */
    public function sendRestartPassword(Request $request){
        $credenciales = $request->only('email');
        $validator = Validator::make($credenciales, [
            'email' => 'required|email'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 2,
                'message' => 'Error en el tipo de dato',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        try{
            $user = User::where('email', $credenciales['email'])->get()->first();
            if($user==null){
                return response()->json([
                    'success' => false,
                    'code' => 3,
                    'message' => 'Correo no existe',
                    'data' => 'El usuario con el correo:'.$credenciales['email'].' no existe'
                ], 401);
            }
            $codigo = bin2hex(random_bytes(20));
            $details = array(
                'opcion' => 1,
                'usuario' => $user['nombre'],
                'direccion' => 'http://localhost:8080/ReinicioContraseña/'.$codigo
            );
            \Mail::to($user['email'])->send(new SendMail($details));
            $user->codigoRecuperacion = $codigo;
            $user->fechaRecuperacion = date("Y-m-d H:i:s", strtotime('+24 hours'));
            $user->save();
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
     * Metodo que se encarga en recuperar la contraseña
     * entradas:
     * Correo
     * clave
     */
    public function restartPassword(Request $request){
        $credenciales = $request->only('password', 'codigo');
        $validator = Validator::make($credenciales, [
            'password' => 'required|string',
            'codigo' => 'required|string'
        ]);
        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'code' => 2,
                'message' => 'Error en el tipo de dato',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        try{
            $user = User::where('codigoRecuperacion', $credenciales['codigo'])->get()->first();
            if($user==null){
                return response()->json([
                    'success' => false,
                    'code' => 2,
                    'message' => 'Correo no existe',
                    'data' => 'El usuario con el codigo: '.$credenciales['codigo'].' no existe'
                ], 401);
            }
            $current = date("Y-m-d H:i:s");
            if (strtotime($current) > strtotime($user->fechaRecuperacion)) {
                return response()->json([
                    'success' => false,
                    'code' => 1,
                    'message' => 'El código de recuperación de contraseña ha expirado. Por favor intenta de nuevo.',
                    'data' => null
                ], 400);
            }
            if( $credenciales['codigo']!=$user->codigoRecuperacion){
                return response()->json([
                    'success' => false,
                    'code' => 1,
                    'message' => 'El codigo no es compatible',
                    'data' => null
                ], 400);
            }
            $user->password= bcrypt($credenciales['password']);
            $user->codigoRecuperacion=null;
            $user->fechaRecuperacion=null;
            $user->save();
            return response()->json([
                'success' => true,
                'code' => 1,
                'message' => 'Se a restablecido su contraseña con exito',
                'data' => null
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'code' => 2,
                'message' => 'Error',
                'data' => $e
            ], 502);
        }
    }
}