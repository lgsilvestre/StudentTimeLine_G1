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
        $this->middleware(['permission:exportar estudiantes'], ['only' => ['index']]);
    }

    public function index(Request $request) 
    {
        $request = 1;

        return Excel::download(new DataEstudiantes($request) , 'estudiantes.xlsx');
    }

}

class DataEstudiantes implements FromCollection
{
    protected $request;

    public function __construct(int $request)
    {
        $this->request = $request;
    }

    function collection()
    {
        $estudiante = new Estudiante();

        $columnas = $estudiante->getTableColumns();

        $estudiantes = $estudiante->filtrarEscuela($this->request);

        $data = new collection();

        foreach($columnas as $columna)
        {
            $data[0] = (object) $columna;
        }

        $data = $data->merge($estudiantes);

        return $data;
    }
}
