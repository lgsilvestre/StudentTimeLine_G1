<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try{
            $logs = Log::all();
            foreach($logs as $log){
                $log->usuario=$log->getUser->nombre;
                $log->rol=$log->getUser->rol;
                $log->escuela=$log->getUser->getEscuela->nombre;
            }
            return response()->json([
                'success' => true,
                'code' => 100,
                'message' => "Operacion realizada con exito",
                'data' =>['logs'=> $logs]
            ], 200);
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 101,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }
}
