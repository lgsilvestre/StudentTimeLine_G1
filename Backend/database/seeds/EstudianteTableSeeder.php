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
            'matricula' => 2000407035,
            'rut' => '192170168',
            'nombre_completo' => 'Paulo Parraguez Diaz', 
            'correo' => 'p.parraguez.diaz@hotmail.cl',
            'anho_ingreso' => 2016,
            'situacion_academica' =>'regular',
            'porcentaje_avance' => 70, 
            'creditos_aprobados' => 250,
            'escuela' => 1
        ]);

        Estudiante::create([
            'matricula' => 2016407023,
            'rut' => '192170169',
            'nombre_completo' => 'Javiera Mendez Osorio', 
            'correo' => 'jamendez16@alumnos.utalca.cl',
            'anho_ingreso' => 2016,
            'situacion_academica' =>'regular',
            'porcentaje_avance' => 75,
            'creditos_aprobados' => 300,
            'escuela' => 1
        ]);

        Estudiante::create([
            'matricula' => 2000407016,
            'rut' => '192170271',
            'nombre_completo' => 'Diego Matus', 
            'correo' => 'jmatus@utalca.cl',
            'anho_ingreso' => 2015,
            'situacion_academica' =>'regular',
            'porcentaje_avance' => 75,
            'creditos_aprobados' => 300,
            'escuela' => 1
        ]);
        Estudiante::create([
            'matricula' => 2000407020,
            'rut' => '192170166',
            'nombre_completo' => 'Diego Iturriaga Iturriaga', 
            'correo' => 'diturriaga@utalca,cl',
            'anho_ingreso' => 2015,
            'situacion_academica' =>'regular',
            'porcentaje_avance' => 90,
            'creditos_aprobados' => 300,
            'escuela' => 1
        ]);
        Estudiante::create([
            'matricula' => 2000407028,
            'rut' => '192170164',
            'nombre_completo' => 'Fernanda Gallegos', 
            'correo' => 'fgallegos@utalca.cl',
            'anho_ingreso' => 2015,
            'situacion_academica' =>'regular',
            'porcentaje_avance' => 75,
            'creditos_aprobados' => 300,
            'escuela' => 1
        ]);
        Estudiante::create([
            'matricula' => 2000407029,
            'rut' => '192170160',
            'nombre_completo' => 'Ariel Cornejo ', 
            'correo' => 'acornejo@utalca.cl',
            'anho_ingreso' => 2016,
            'situacion_academica' =>'regular',
            'porcentaje_avance' => 90,
            'creditos_aprobados' => 350,
            'escuela' => 1
        ]);
        Estudiante::create([
            'matricula' => 2000407030,
            'rut' => '192170170',
            'nombre_completo' => 'Roberto Ureta', 
            'correo' => 'rureta@utalca.cl',
            'anho_ingreso' => 2015,
            'situacion_academica' =>'regular',
            'porcentaje_avance' => 89,
            'creditos_aprobados' => 300,
            'escuela' => 1
        ]);
        Estudiante::create([
            'matricula' => 2000407031,
            'rut' => '192170171',
            'nombre_completo' => 'Gabriel Gonzalo Caceres ', 
            'correo' => 'gg@utalca.cl',
            'anho_ingreso' => 2016,
            'situacion_academica' =>'regular',
            'porcentaje_avance' => 75,
            'creditos_aprobados' => 300,
            'escuela' => 1
        ]);
        Estudiante::create([
            'matricula' => 2000407032,
            'rut' => '192170172',
            'nombre_completo' => 'Ariel Valenzuela', 
            'correo' => 'avalenzuela',
            'anho_ingreso' => 2016,
            'situacion_academica' =>'regular',
            'porcentaje_avance' => 75,
            'creditos_aprobados' => 300,
            'escuela' => 1
        ]);
        Estudiante::create([
            'matricula' => 2000407033,
            'rut' => '192170173',
            'nombre_completo' => 'Matias Pizarro', 
            'correo' => 'mpizarro@utalca.cl',
            'anho_ingreso' => 2016,
            'situacion_academica' =>'regular',
            'porcentaje_avance' => 75,
            'creditos_aprobados' => 300,
            'escuela' => 1
        ]);
        Estudiante::create([
            'matricula' => 2000407034,
            'rut' => '192170174',
            'nombre_completo' => 'Brayam Escobar', 
            'correo' => 'bescobar@utalca.cl',
            'anho_ingreso' => 2015,
            'situacion_academica' =>'regular',
            'porcentaje_avance' => 75,
            'creditos_aprobados' => 300,
            'escuela' => 1
        ]);



        Estudiante::create([
            'matricula' => 2000407038,
            'rut' => '192170175',
            'nombre_completo' => 'Rodrigo Letelier', 
            'correo' => 'rletelier@utalca.cl',
            'anho_ingreso' => 2015,
            'situacion_academica' =>'regular',
            'porcentaje_avance' => 80,
            'creditos_aprobados' => 300,
            'escuela' => 1
        ]);
        Estudiante::create([
            'matricula' => 2000407036,
            'rut' => '192170176',
            'nombre_completo' => 'Jesus Moris', 
            'correo' => 'jmoris@utalca.cl',
            'anho_ingreso' => 2015,
            'situacion_academica' =>'regular',
            'porcentaje_avance' => 60,
            'creditos_aprobados' => 300,
            'escuela' => 1
        ]);
        Estudiante::create([
            'matricula' => 2000407037,
            'rut' => '192170177',
            'nombre_completo' => 'Isavo Castro', 
            'correo' => 'icastro@utalca.cl',
            'anho_ingreso' => 2016,
            'situacion_academica' =>'regular',
            'porcentaje_avance' => 85,
            'creditos_aprobados' => 370,
            'escuela' => 1
        ]);


  
    }

}
