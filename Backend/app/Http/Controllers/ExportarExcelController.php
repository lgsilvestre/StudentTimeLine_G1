<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Excel;
use App\Estudiante;
use DB;
use Validator;

class ExportarExcelController extends Controller
{

    /**
     * Metodo que se encarga de bloquear las rutas del controlador Usuario
     */
    
    public function __construct()
    {
        //$this->middleware(['permission:exportar estudiantes'], ['only' => ['index']]);
        //$this->middleware(['permission:exportar estudiantes'], ['only' => ['exportar']]);
    }

    public function exportar(Request $request) 
    {
        //VAN A SER 3 TIPOS, TODOS, POR FECHA, INDIVIDUAL, NECESITO TIPO, FECHAINICIO, FECHAFIN, ID ESTUDIANTE
        //validar parametros null
        /*
        //todos los estudiantes plus cant observaciones totales
        $estudiantes2 = DB::table('estudiantes')
                        ->select('matricula','rut','nombre_completo','correo','anho_ingreso','situacion_academica','porcentaje_avance','creditos_aprobados','escuela', DB::Raw('COUNT(observaciones.id) AS cant_observaciones'))
                        ->join('observaciones', 'estudiantes.id','=', 'observaciones.estudiante')
                        ->groupBy('matricula','rut','nombre_completo','correo','anho_ingreso','situacion_academica','porcentaje_avance','creditos_aprobados','escuela')
                        ->get();

        //todos los estudiantes que tienen observaciones entre 2 fechas
        $estudiantes21 = DB::table('estudiantes')
        ->join('observaciones', 'estudiantes.id','=', 'observaciones.estudiante')
        ->whereBetween('observaciones.created_at',['2020-07-20','2020-07-21'])
        ->get();

        $estudiantes3 = DB::table('estudiantes')
        ->join('observaciones', 'estudiantes.id','=', 'observaciones.estudiante')
        ->where('estudiantes.id','=','2')
        ->get();
        return $estudiantes3;
        */

        #CAMBIAR NOMBRE ARCHIVO
        //return Excel::download(new DataEstudiantes($request) , 'estudiantes.xlsx');
        return Excel::download(new DataEstudiantes($request) , 'estudiantes.xlsx');
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

        $columnas = $estudiante->getTableColumns();

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
