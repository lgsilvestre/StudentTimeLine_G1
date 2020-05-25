<?php

namespace App\Http\Controllers;

use App\User;
use Mail;
use App\Mail\Correo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Database\QueryException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Mail\EmergencyCallReceived;
//use App\Mail\SendMail;

class TokensController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 1,
                'message' => 'Error en las credenciales',
                'errors' => $validator->errors()
            ], 422);
        }

        $token = JWTAuth::attempt($credentials);

        if ($token) {

            return response()->json([
                'token' => $token,
                'user' => User::where('email', $credentials['email'])->get()->first()
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'code' => 2,
                'message' => 'Error en las credenciales',
                'errors' => $validator->errors()], 401);
        }
    }

    public function refreshToken()
    {

        $token = JWTAuth::getToken();

        try {
            $token = JWTAuth::refresh($token);
            return response()->json(['success' => true, 'token' => $token], 200);
        } catch (TokenExpiredException $ex) {
            // We were unable to refresh the token, our user needs to login again
            return response()->json([
                'code' => 3, 'success' => false, 'message' => 'Need to login again, please (expired)!'
            ]);
        } catch (TokenBlacklistedException $ex) {
            // Blacklisted token
            return response()->json([
                'code' => 4, 'success' => false, 'message' => 'Need to login again, please (blacklisted)!'
            ], 422);
        }

    }

    public function logoutToken()
    {
        //  $this->validate($request, ['token' => 'required']);
        $token = JWTAuth::getToken();

        try {
            $token = JWTAuth::invalidate($token);
            return response()->json([
                'code' => 5, 'success' => true, 'message' => "Has cerrado la sesión con exito"
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'code' => 6, 'success' => false, 'message' => 'No se a podido cerrar la sesión, por favor volver a intentar.'
            ], 422);
        }
    }

    public function restartPassword(Request $request){
        $credentials = $request->only('email');

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 1,
                'message' => 'Error en el tipo de dato',
                'errors' => $validator->errors()
            ], 422);
        }
        
        //$user = User::where('emails.email', $credentials['email'])->get()->first(); 
        //$receivers = Receiver::pluck('email');
        //Mail::to("xebaelvemgador@gmail.com")->send(new EmergencyCallReceived());

        
        Mail::send('mails.test', [], function ($mail) {
            $mail->from('sdiUtalca@gmail.com', 'Sistema de gestion de ayudantes');
            $mail->to('sdiUtalca@gmail.com', 'ayuda')->subject('Test');
        });
        return response()->json(['Confirmacion' => 'Se a mandado el correo exitosamente'], 200);
       
        /* 
        $datos = array(
            'titulo' => "Recuperacion de clave del sistema de gestion de ayudantes",
            'contenido' => "Su clave es: ".$user['email'],
        );
        Mail::send('notificacion', $datos, function ($mail) {
            $mail->to('xebaelvemgador@gmail.com')->subject('Test');
          });
        */

        /*
        if($user==null){
            //aca se manda el mail
            return response()->json(['Confirmacion' => 'Se a mandado el correo exitosamente'], 200);
        }else {
            return response()->json([
                'success' => false,
                'code' => 2,
                'message' => 'Error en las credenciales',
                'errors' => $validator->errors()], 401);
        }
        */
    }
}