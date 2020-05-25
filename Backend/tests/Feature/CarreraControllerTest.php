<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Carrera;
//Importar Modelo

class CarreraControllerTest extends TestCase
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
        //genero datos de pruebas en la bd temporal en memoria.
        Carrera::create([
            'nombre' => 'Ingeniería Civil Industrial'
        ]);
        Carrera::create([
            'nombre' => 'Ingeniería Civil en Computación'
        ]);

        //general la petición
        $response=$this->get('api/Carrera');
        //extraigo el objeto en la posición cero del array para sacar la carrera de industrial, asumo que se crean en orden
        $carreraX= $response[0];

        //por la clave "nombre" saco el valor que contiene en el array asociativo.
        $this->assertEquals( $carreraX["nombre"],'Ingeniería Civil Industrial');
       
    }

    /**
     * @test
     *
     * 
     */
    public function testStore()
    {  
        $this -> withoutExceptionHandling();
        //generamos la petición
        $response= $this->post('api/Carrera',['nombre'=>'ingenieria civil en puteria']);
      
        $response->assertOk();
        $response=$this->get('api/Carrera');
        $this->assertEquals($response[0]["nombre"], 'ingenieria civil en puteria');

        
    }

    /**
     * @test
     *
     * 
     */
    //public function testShow()
    //{

    //}

    /**
     * @test
     *
     * 
     */
    //public function testUpdate()
    //{

    //}

    /**
     * @test
     *
     * 
     */
    //public function testDestroy()
    //{

    //}
}
