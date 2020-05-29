<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\Carrera;

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
    public function testUpdate()
    {
        $this->withoutExceptionHandling();

        $carrera=Carrera::create([
            'nombre' => 'Prueba Carrera'
        ]);

        $this -> assertCount(1,Carrera::all());

        $response = $this->put('api/Carrera/'.$carrera->id,[
            'nombre'   => 'Cambio Prueba'
        ]);

        $response->assertOK();

        $this->assertDatabaseHas('carreras', [
            'nombre' => 'Cambio Prueba'
        ]);
    }

    /**
     * @test
     *
     * 
     */ 
    public function testDestroy()
    {
        $this -> withoutExceptionHandling();

        $carrera=Carrera::create([
            'nombre' => 'Prueba Carrera'
        ]);

        $response = $this->delete('api/Carrera/'.$carrera->id);

        $response -> assertOk();

        $response = Carrera::onlyTrashed()->where('id', '=', $carrera->id)->get();

        $this->assertNotNull($response->contains('deleted_at', $response[0]->deleted_at)); 
    }
}
