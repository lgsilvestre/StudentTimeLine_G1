<?php

namespace App\Imports;

use App\Estudiante;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class EstudiantesImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Estudiante([
                'matricula'  => $row['0'],
                'rut'  => $row['1'],
                'nombre_completo'  => $row['2'],
                'correo'  => $row['3'],
                'anho_ingreso'  => $row['4'],
                'situacion_academica'  => $row['5'],
                'porcentaje_avance'  => $row['6'],
                'creditos_aprobados'  => $row['7'],
                'escuela'  => $row['8'],
        ]);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
