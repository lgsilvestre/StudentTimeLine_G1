<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Imports\EstudiantesImport;
use Excel;
use DB; //Operaciones de DB

class ImportarExcelController extends Controller
{
    function index()
    {
        $data = DB::table('estudiantes')->orderBy('id', 'asc')->get();
        return compact('data');
    }

    function importar(Request $request){
        
        $this->validate($request, [
            'select_file' => 'required|mimes:xls,xlsx'
        ]);
           
        $data = Excel::import(new EstudiantesImport, request()->file('select_file'));

        return dd('Estudiantes importados exitosamente.');
        //return back()->with('success', 'Estudiantes importados exitosamente.');
    }

}

