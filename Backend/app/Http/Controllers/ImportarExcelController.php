<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Imports\EstudiantesImport;
use Excel;
use DB; //Operaciones de DB
use Log;

class ImportarExcelController extends Controller
{
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

            foreach ($data[0] as $key => $row)
            {
                //dump($row);
                    
                $insert_data[] = array(
                    'matricula'  => $row[0],
                    'rut'  => $row[1],
                    'nombre_completo'  => $row[2],
                    'correo'  => $row[3],
                    'anho_ingreso'  => $row[4],
                    'situacion_academica'  => $row[5],
                    'porcentaje_avance'  => $row[6],
                    'creditos_aprobados'  => $row[7],
                    'escuela'  => $row[8],
                );
                //dump($insert_data);
            }

            if(!empty($insert_data))
            {
                DB::table('estudiantes')->insert($insert_data);
            }
            return response()->json($data,200);
            //return back()->with('success', 'Estudiantes importados exitosamente.');
        }
    }

}

