<?php

namespace App\Http\Controllers;

use App\Ayudante_Con_Curso;
use Illuminate\Http\Request;

class AyudanteConCursoController extends Controller
{
    /**
     * 
     */
    public function __construct()
    {
        $this->middleware(['permission:create ayudante con curso'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:read ayudante con curso'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:update ayudante con curso'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete ayudante con curso'], ['only' => 'delete']);
        $this->middleware(['permission:restore ayudante con curso'], ['only' => 'disabled', 'restore']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $ayudantesCurso= Ayudante_Con_Curso::all();
            return response()->json([
                'success' => true,
                'code' => 100,
                'message' => "La operacion se a realizado con exito",
                'data' => ['ayudantesCurso'=>$ayudantesCurso]
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'success' => false,
            'code' => 201,
            'message' => 'el cliente debe usar un protocolo distinto',
            'data' => ['error'=>'El el protocolo se llama store']
        ], 426 );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entradas = $request->only('estudiante', 'curso');
        // $validator = Validator::make($entradas, [
        //     'estudiante' => ['required', 'numeric'],
        //     'curso' => [' required', 'numeric'],
        // ]);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'success' => false,
        //         'code' => 301,
        //         'message' => 'Error en datos ingresados',
        //         'data' => ['error'=>$validator->errors()]
        //     ], 422);
        // }
        // if(!array_key_exists ("estudiante" , $entradas)){
        //     $entradas['estudiante'] = null;
        // }
        // if(!array_key_exists ("curso" , $entradas)){
        //     $entradas['curso'] = null;
        // }
        try{
            $ayudanteCurso = new Ayudante_Con_Curso();
            $ayudanteCurso-> estudiante=$entradas['estudiante'];
            $ayudanteCurso-> curso=$entradas['curso'];
            $ayudanteCurso->save();
            return response()->json([
                'success' => true,
                'code' => 300,
                'message' => "Operacion realizada con exito",
                'data' => ['ayudanteCurso'=>$ayudanteCurso]
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            if($ex->errorInfo[1]==1452){
                if(strlen(strstr($ex->errorInfo[2],'FOREIGN KEY (`estudiante`)'))>0){
                    return response()->json([
                        'success' => false,
                        'code' => 302,
                        'message' => "Error: El estudiante solicitado no está registrado ",
                        'data' => ['error'=>$ex]
                    ], 409  );
 
                }else if (strlen(strstr($ex->errorInfo[2],'FOREIGN KEY (`curso`)'))>0){
                    return response()->json([
                        'success' => false,
                        'code' => 302,
                        'message' => "Error: El curso solicitado no está registrado ",
                        'data' => ['error'=>$ex]
                    ], 409  );

                }
            }else if($ex->errorInfo[1]==1062){
                if(strlen(strstr($ex->errorInfo[2],'ayudante__con__cursos_estudiante_curso_unique'))>0){
                    return response()->json([
                        'success' => false,
                        'code' => 302,
                        'message' => "Error: El estudiante solicitado ya es ayudante del curso",
                        'data' => ['error'=>$ex]
                    ], 409  );
                }
            }

            return response()->json([
                'success' => false,
                'code' => 302,
                'message' => "Error en la base de datos",
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ayudante_Con_Curso  $ayudante_Con_Curso
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $ayudantesCurso= Ayudante_Con_Curso::Where('curso', $id)->get();
            foreach($ayudantesCurso as $ayudanteCurso){
                $ayudanteCurso->estudiante=$ayudanteCurso->getEstudiante->nombre_completo;
            }
            return response()->json([
                'success' => true,
                'code' => 100,
                'message' => "La operacion se a realizado con exito",
                'data' => ['ayudantesCurso'=>$ayudantesCurso]
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ayudante_Con_Curso  $ayudante_Con_Curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Ayudante_Con_Curso $ayudante_Con_Curso)
    {
        return response()->json([
            'success' => false,
            'code' => 501,
            'message' => 'el cliente debe usar un protocolo distinto',
            'data' => ['error'=>'El el protocolo se llama store']
        ], 426);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ayudante_Con_Curso  $ayudante_Con_Curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $entradas = $request->only('estudiante', 'curso');
        $validator = Validator::make($entradas, [
            'estudiante' => ['numeric', 'nullable'],
            'curso' => ['numeric', 'nullable'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 601,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        if(!array_key_exists ("estudiante" , $entradas)){
            $entradas['estudiante'] = null;
        }
        if(!array_key_exists ("curso" , $entradas)){
            $entradas['curso'] = null;
        }
        try{
            $ayudanteCurso= Ayudante_Con_Curso::find($id);
            if ($ayudanteCurso == null) {
                return response()->json([
                    'success' => false,
                    'code' => 602,
                    'message' => 'El ayudante con curso con el id '.$id.' no existe',
                    'data' => null
                ], 409);
            }
            if($entradas['estudiante']!=null){
                $ayudanteCurso->estudiante= $entradas['estudiante'];
            }
            if($entradas['curso']!=null){
                $ayudanteCurso->curso=$entradas['curso'];
            }
            $ayudanteCurso->save();
            return response()->json([
                'success' => true,
                'code' => 600,
                'message' => "Operacion realizada con exito",
                'data' => ['ayudanteCurso'=>$ayudanteCurso]
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){
            if($ex->errorInfo[1]==1452){
                if(strlen(strstr($ex->errorInfo[2],'FOREIGN KEY (`estudiante`)'))>0){
                    return response()->json([
                        'success' => false,
                        'code' => 302,
                        'message' => "Error: El estudiante solicitado no está registrado ",
                        'data' => ['error'=>$ex]
                    ], 409  );
 
                }else if (strlen(strstr($ex->errorInfo[2],'FOREIGN KEY (`curso`)'))>0){
                    return response()->json([
                        'success' => false,
                        'code' => 302,
                        'message' => "Error: El curso solicitado no está registrado ",
                        'data' => ['error'=>$ex]
                    ], 409  );
                }
            }else if($ex->errorInfo[1]==1062){
                if(strlen(strstr($ex->errorInfo[2],'ayudante__con__cursos_estudiante_curso_unique'))>0){
                    return response()->json([
                        'success' => false,
                        'code' => 302,
                        'message' => "Error: El estudiante solicitado ya es ayudante del curso",
                        'data' => ['error'=>$ex]
                    ], 409  );
                }
            }
                   
            return response()->json([
                'success' => false,
                'code' => 603,
                'message' => "Error en la base de datos",
                'data' => ['error'=>$ex]
            ], 409 );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ayudante_Con_Curso  $ayudante_Con_Curso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $ayudanteCurso= Ayudante_Con_Curso::find($id);
            if ($ayudanteCurso == null) {
                return response()->json([
                    'success' => false,
                    'code' => 701,
                    'message' => 'El ayudante con curso con el id '.$id.' no existe',
                    'data' => null
                ], 409 );
            }else{
                $ayudanteCurso->forceDelete();
                return response()->json([
                    'success' => true,
                    'code' => 700,
                    'message' => "Operacion realizada con exito",
                    'data' =>['ayudanteCurso'=> $ayudanteCurso]
                ], 200);
            }
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
        try{
            $ayudantesCurso = Ayudante_Con_Curso::onlyTrashed()->get();
            return response()->json([
                'success' => true,
                'code' => 800,
                'message' => "Operacion realizada con exito",
                'data' =>['ayudanteCursos'=> $ayudantesCurso]
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 801,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    /**
     * Metodo que se encarga de recuperar una ayudanteCurso
     * Errores code inician 900
     */
    public function restore($id){
        try{
            $ayudanteCurso = Ayudante_Con_Curso::onlyTrashed()->find($id)->restore();
            if($ayudanteCurso==false){
                return response()->json([
                    'success' => false,
                    'code' => 901,
                    'message' => "El ayudante con curso no se logro recuperar",
                    'data' => ['ayudanteCurso'=>$ayudanteCurso]
                ], 409);
            }
            return response()->json([
                'success' => true,
                'code' => 900,
                'message' => "El ayudante con curso se recupero con exito",
                'data' => ['ayudanteCurso'=>$ayudanteCurso]
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 902,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

}
