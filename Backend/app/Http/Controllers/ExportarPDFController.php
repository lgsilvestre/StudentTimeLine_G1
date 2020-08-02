<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Estudiante;
use Validator;
use PDF;

class ExportarPDFController extends Controller
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
        
        $request = new Request([
            'tipo'=> 3,
            'fechaInicio'=> '2020-07-19',
            'fechaFin'=>'2020-07-21',
            'id'=> 1,
            'escuela'=> 1
        ]);
        
        $estudiante = $this->obtenerDatosEstudiante($request);

        $observaciones = $this->obtenerDatosObs($request);

        $pdf = PDF::loadView('pdf_view', compact('estudiante','observaciones') ); 
        return $pdf->download('Estudiante.pdf');
    }

    public function obtenerDatosEstudiante(Request $request)
    {
        $estudiante = new Estudiante();

        //$columnas = $estudiante->getTableColumns($request);

        $infoEstudiante = $estudiante->obtenerInfoEstudiante($request);
    
        /*
        $data = new collection();

        foreach($columnas as $columna)
        {
            $data[0] = (object) $columna;
        }

        $data = $data->merge($infoEstudiante);*/

        return $infoEstudiante;
    }

    public function obtenerDatosObs(Request $request)
    {
        $estudiante = new Estudiante();

        //$columnasObs = array("nombre_columna" =>['profesor', 'curso','categoria', 'titulo', 'descripcion', 'tipo']);

        $observaciones = $estudiante->filtrarExportar($request);
    
        /*
        $data = new collection();

        foreach($columnasObs as $columna)
        {
            $data[0] = (object) $columna;
        }

        $data = $data->merge($observaciones);*/

        return $observaciones;
    }
}

