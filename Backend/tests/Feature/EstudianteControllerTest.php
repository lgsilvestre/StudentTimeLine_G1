<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Estudiante;
use App\Escuela;

class EstudianteControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

     
    public function testUpdate()
    {
        
        $this -> withoutExceptionHandling();

        Escuela::create([
            'nombre' => 'Ingeniería Civil en Computación',
            'cod_carrera' =>407

        ]);
        Escuela::create([
            'nombre' => 'Ingeniería Civil en p',
            'cod_carrera' =>408

        ]);
        $estudiante =Estudiante::create([
            'matricula' =>2016407015,
            'rut' =>'192170169',
            'nombre_completo' =>'javiero melendez melendez', 
            'correo' =>'jmelendez@gmail.com',
            'anho_ingreso' =>2016,
            'situacion_academica' =>'regular',
            'porcentaje_avance' =>75,
            'creditos_aprobados' =>300,
            'escuela' =>1
        ]);
 

        $response = $this->put('api/Estudiante/'.$estudiante->matricula,[
            'nombre_completo' => 'javiera mendez osorio',
            'situacion_academica'=>'titulada',
            'porcentaje_avance'=>100,
            'creditos_aprobados'=>1500,
            'escuela'=>1]
        );

        $response -> assertOk();

        $this->assertDatabaseHas('estudiantes', [
            'nombre_completo' => 'javiera mendez osorio',
            'situacion_academica'=>'titulada',
            'porcentaje_avance'=>100,
            'creditos_aprobados'=>1500,
            'escuela'=>1]
        );


        $response->assertStatus(200); 

    }
}
