<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Excel;
use App\Estudiante;
use Validator;

class ExportarExcelController extends Controller
{
    /*private $headers = [
        'Content-Type' => 'text/csv',
    ];*/

    /**
     * Metodo que se encarga de bloquear las rutas del controlador Usuario
     */
    public function __construct()
    {
        //$this->middleware(['permission:exportar estudiante'], ['only' => ['index']]);
        //$this->middleware(['permission:exportar estudiante'], ['only' => ['exportar']]);
    }

    public function exportar(Request $request)
    {
        /*
        $request = new Request([
            'tipo'=> 2,
            'fechaInicio'=> '2020-08-12',
            'fechaFin'=>'2020-08-12',
            'id'=> 1,
            'escuela'=> 1
        ]);*/

        $entradas = $request->only('tipo', 'fechaInicio', 'fechaFin', 'escuela');

        $validator = Validator::make($entradas, [
            'tipo' => ['required','numeric'],
        ]);
 
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 301,
                'message' => 'El tipo de exportación no es válido.',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        else{
            if($entradas['tipo'] == 1)
            {
                $validator = Validator::make($entradas, [
                    'escuela' => ['required','numeric'],
                ]);
         
                if($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'code' => 301,
                        'message' => 'El ID de la Escuela no es válido.',
                        'data' => ['error'=>$validator->errors()]
                    ], 422);
                }
            }
            else if($entradas['tipo'] == 2)
            {
                $validator = Validator::make($entradas, [
                    'fechaInicio' => ['required', 'date'],
                    'fechaFin' => ['required', 'date', 'after_or_equal:fechaInicio'],
                ]);
         
                if($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'code' => 301,
                        'message' => 'Las fechas ingresadas no son válidas.',
                        'data' => ['error'=>$validator->errors()]
                    ], 422);
                }
            }
        }

        if($entradas['tipo'] == 1 || $entradas['tipo'] == 2)
        {
            return Excel::download(new DataEstudiantes($request) , 'estudiantes.xlsx');
        }
        elseif($request->tipo == 3)
        {
            return response()->json([
                'success' => false,
                'code' => 404,
                'message' => 'Esta ruta no exporta archivos PDF.',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
    }   
}

class DataEstudiantes implements FromCollection
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    function collection()
    {
        $estudiante = new Estudiante();

        $columnas = $estudiante->getTableColumns($this->request);

        $estudiantes = $estudiante->filtrarExportar($this->request);
        
        $data = new collection();
        
        foreach($columnas as $columna)
        {
            $data[0] = (object) $columna;
        }

        $data = $data->merge($estudiantes);

        return $data;
    }
}
