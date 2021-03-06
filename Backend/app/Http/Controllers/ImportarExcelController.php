<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Imports\EstudiantesImport;
use Excel;
use App\Estudiante;
use DB; //Operaciones de DB
use Validator;
use App\Log;
use Maatwebsite\Excel\HeadingRowImport;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\EstudianteController;


class ImportarExcelController extends Controller
{

    /**
     * Metodo que se encarga de bloquear las rutas del controlador Usuario
     */
    
    public function __construct()
    {
        $this->middleware(['permission:importar estudiante'], ['only' => ['index', 'importar']]);
    }

    function index()
    {
        $data = DB::table('estudiantes')->orderBy('id', 'asc')->get();
        return compact('data');
    }

    function importar(Request $request){
        if ($request->hasfile('file')) 
        {
            $this->validate($request, [
                'file' => 'required|mimes:xls,xlsx'
            ]);

            //Log::info($request->file('file'));
            $path = $request->file('file');
            $data = Excel::toArray(new EstudiantesImport, $path);
            $headerRow = head($data)[0];
            
            $i=0;
            $orden = [];
            
            //dump($headerRow);
            $error=[];
            $flag = true;
            if(!in_array ("COD_CARRERA" , $headerRow)){
                $error[0] = 'Falta la columna COD_CARRERA';
                $flag = false;
            }
            if(!in_array ("MATRICULA" , $headerRow)){
                $error[1] = 'Falta la columna MATRICULA';
                $flag = false;
            }
            if(!in_array ("RUN" , $headerRow)){
                $error[2] = 'Falta la columna RUN';
                $flag = false;
            }
            if(!in_array ("NBE_ALUMNO" , $headerRow)){
                $error[3] = 'Falta la columna NBE_ALUMNO';
                $flag = false;
            }
            if(!in_array ("CORREO" , $headerRow)){
                $error[4] = 'Falta la columna CORREO';
                $flag = false;
            }
            if(!in_array ("ANHO_INGRESO" , $headerRow)){
                $error[5] = 'Falta la columna ANHO_INGRESO';
                $flag = false;
            }
            if(!in_array ("SIT_ACTUAL" , $headerRow)){
                $error[6] = 'Falta la columna SIT_ACTUAL';
                $flag = false;
            }
            if(!in_array ("CRED_APROBADOS" , $headerRow)){
                $error[7] = 'Falta la columna CRED_APROBADOS';
                $flag = false;
            }
            if(!in_array ("PORC_AVANCE" , $headerRow)){
                $error[8] = 'Falta la columna PORC_AVANCE';
                $flag = false;
            }
            if($flag == false){
                return response()->json([
                    'success' => false,
                    'code' => 2,
                    'message' => 'Archivo Excel no posee el formato requerido.',
                    'data' => ['error'=>$error]
                ], 422); 
            }
            
            foreach ($headerRow as $valor) {
                if($valor == 'COD_CARRERA'){
                    $orden[] = $i;
                }
                elseif($valor == 'MATRICULA'){
                    $orden[] = $i;
                }
                elseif($valor == 'RUN'){
                    $orden[] = $i;
                }
                elseif($valor == 'NBE_ALUMNO'){
                    $orden[] = $i;
                }
                elseif($valor == 'CORREO'){
                    $orden[] = $i;
                }
                elseif($valor == 'ANHO_INGRESO'){
                    $orden[] = $i;
                }
                elseif($valor == 'SIT_ACTUAL'){
                    $orden[] = $i;
                }
                elseif($valor == 'CRED_APROBADOS'){
                    $orden[] = $i;
                }
                elseif($valor == 'PORC_AVANCE'){
                    $orden[] = $i;
                }
                $i+=1;
            }
            //dump($orden);

            $credenciales = JWTAuth::parseToken()->authenticate();
            $escuela = $credenciales['escuela'];
            //'escuela'  => $row[$orden[0]],
            //$controller = (new UsuarioController())->store();

            $i=0;

            $matriculas=array();
            $resultados=array();
            foreach ($data[0] as $key => $row)
            {
                if($row[$orden[1]]!=null){
                    $insert_data = new Request(array(
                        'matricula'  => $row[$orden[1]],
                        'rut'  => $row[$orden[2]],
                        'nombre_completo'  => $row[$orden[3]],
                        'correo'  => $row[$orden[4]],
                        'anho_ingreso'  => $row[$orden[5]],
                        'situacion_academica'  => $row[$orden[6]],
                        'porcentaje_avance'  => $row[$orden[7]],
                        'creditos_aprobados'  => $row[$orden[8]],
                        'escuela'  => $escuela,    
                    ));
                    $i+=1;
                    if((!empty($insert_data)) && ($i>1))
                    {
                        try{
                            $estudiante = Estudiante::Where('matricula', $insert_data['matricula'])->first();
                        //----- Mecanismos anticaidas y reporte de errores -----
                        //catch que se encarga en responder que paso en la sentencia sql
                        }catch(\Illuminate\Database\QueryException $ex){ 
                            return response()->json([
                                'success' => false,
                                'code' => 3,
                                'message' => "Error en la base de datos",
                                'data' => ['error'=>$ex]
                            ], 409 );
                        }
                        if($estudiante == null){
                            $controller = (new EstudianteController())->store($insert_data);
                            array_push($matriculas , $insert_data['matricula'] );
                            array_push($resultados , $controller->original['message']);
                        }else{
                            $controller = (new EstudianteController())->update($insert_data, $estudiante->id);
                            array_push($matriculas , $insert_data['matricula'] );
                            array_push($resultados , $controller->original['message']);
                        }
                    }
                }
                $i+=1;
            }
            $resultado = array_combine($matriculas, $resultados);
            $credenciales = JWTAuth::parseToken()->authenticate();
            Log::create([
                'titulo' => "Se han importado estudiantes",
                'accion' => "Importar estudiantes",
                'tipo' => "Informativo",
                'descripcion' => "Se han importado estudiantes en la escuela:".$credenciales['escuela'],
                'data' => $resultado,
                'usuario' =>  $credenciales['id']
            ]);
            return response()->json([
                'success' => true,
                'code' => 1,
                'message' => "Operacion realizada con exito",
                'data' => ['data'=>$resultado]
            ], 200);
        }
    }
        
}



