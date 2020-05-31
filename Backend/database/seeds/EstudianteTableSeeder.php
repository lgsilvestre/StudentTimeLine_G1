<?php

use Illuminate\Database\Seeder;
use App\Estudiante;
class EstudianteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estudiante::create([
            'matricula' => 2016407035,
            'rut' => 192170168,
            'nombre_completo' => 'paulo parraguez diaz', 
            'correo' => 'p.parraguez.diaz@hotmail.cl',
            'anho_ingreso' => 2016,
            'situacion_academica' =>'regular',
            'porcentaje_avance' => '70', 
            'creditos_aprobados' => '250',
            'escuela' => 1

        ]);

        Estudiante::create([
            'matricula' => 2016407015,
            'rut' => 192170169,
            'nombre_completo' => 'javiero melendez melendez', 
            'correo' => 'jmelendez@gmail.com',
            'anho_ingreso' => 2016,
            'situacion_academica' =>'regular',
            'porcentaje_avance' => '75', 
            'creditos_aprobados' => '300',
            'escuela' => 1

        ]);
        

    
     
            

    }
}
