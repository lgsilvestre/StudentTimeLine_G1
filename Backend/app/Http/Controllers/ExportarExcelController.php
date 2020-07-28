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
        $request = new Request([
            'tipo'=> 2,
            'fechaInicio'=> '2020-07-19',
            'fechaFin'=>'2020-07-21',
            'id'=> 1,
            'escuela'=> 1
        ]);

        if($request->tipo == 1 || $request->tipo == 2)
        {
            return Excel::download(new DataEstudiantes($request) , 'estudiantes.xlsx');
        }
        elseif($request->tipo == 3)
        {
            #Error, los pdf se exportan en otra ruta
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
