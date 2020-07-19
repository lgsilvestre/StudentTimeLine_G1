<?php

namespace App\Imports;

use App\Estudiante;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

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
                'matricula'  => $row['MATRICULA'],
                'rut'  => $row['RUN'],
                'nombre_completo'  => $row['NBE_ALUMNO'],
                'correo'  => $row['CORREO'],
                'anho_ingreso'  => $row['ANHO_INGRESO'],
                'situacion_academica'  => $row['SIT_ACTUAL'],
                'porcentaje_avance'  => $row['PORC_AVANCE'],
                'creditos_aprobados'  => $row['CRED_APROBADOS'],
                'escuela'  => $row['COD_CARRERA'],
        ]);
    }



    /**
     * @return int
     */
    public function startRow(): int
    {
        return 6;
    }

    public function headingRow(): int
    {
        return 6;
    }
}
