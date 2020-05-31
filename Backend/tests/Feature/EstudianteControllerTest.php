<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Estudiante;
use App\Escuela;

class EstudianteControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     *
     * 
     */
    public function testIndex()
    {
        $this -> withoutExceptionHandling();

        Escuela::create([
            'nombre' => 'Ingeniería Civil en Computación',
            'cod_carrera' => 407
        ]);

        Estudiante::create([
            'matricula' => 2016407023,
            'rut' => 99999999,
            'nombre_completo' => 'Javiera Mendez Osorio', 
            'correo' => 'jaavi.mendez8@gmail.com',
            'anho_ingreso' => 2016,
            'situacion_academica' =>'regular',
            'porcentaje_avance' => '70', 
            'creditos_aprobados' => '250',
            'escuela' => 1
        ]);

        $response = $this->get('api/Estudiante');
        $response->assertOk();
        $Estudiante= $response[0];

        $this->assertEquals( $Estudiante["matricula"], 2016407023);
    }

    /**
     * @test
     *
     * 
     */
    public function testStore()
    {         
        
    }

    /**
     * @test
     *
     * 
     */
    /*
    public function testUpdate()
    {

    }*/

    /**
     * @test
     *
     * 
     */ 
    /*
    public function testDestroy()
    {

    }*/
}
