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
//use App\Mail\SendMail;

class TokensController extends Controller
{
    /**
     * Metodo que permite iniciar sesion
     */
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $validator = Validator::make($credentials, [
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
            $token = JWTAuth::attempt($credentials);
            if ($token) {
                return response()->json([
                    'success' => true,
                    'code' => 1,
                    'message' => 'Operacion realizada con exito',
                    'data' => ['token'=>$token,
                               'usuario' =>User::where('email', $credentials['email'])->get()->first()],
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
    public function restartPassword(Request $request){
        $credentials = $request->only('email');
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
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
            $user = User::where('email', $credentials['email'])->get()->first();
            if($user==null){
                return response()->json([
                    'success' => false,
                    'code' => 2,
                    'message' => 'Correo no existe',
                    'data' => 'El usuario con el correo:'.$credentials['email'].' no existe'
                ], 401);
            }
            $details = [
                'title' => 'Recuperacion de clave del sistema de gestion de ayudantes',
                'body' => "Hace poco hemos recibido una solicitud de restablecimiento de la contraseña de su cuenta: ".$user['email']. ' ACA DEBERIA IR EL LINK PARA RECUPERAR LA CLAVE'.'    '. 
                'Si no ha solicitado la contraseña puede simplemente ignorar este correo electrónico. No se efectuará ningún cambio en su cuenta. Recuerde, su correo y su contraseña le permiten acceder a nuestro sistema.',
            ];
            \Mail::to($user['email'])->send(new SendMail($details));
            return response()->json([
                'success' => true,
                'code' => 1,
                'message' => 'Se a mandado el correo exitosamente',
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