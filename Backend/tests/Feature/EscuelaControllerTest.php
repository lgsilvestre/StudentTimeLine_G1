<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\Escuela;

class EscuelaControllerTest extends TestCase
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
        Escuela::create([
            'nombre' => 'Ingeniería Civil Industrial'
        ]);
        Escuela::create([
            'nombre' => 'Ingeniería Civil en Computación'
        ]);

        //general la petición
        $response=$this->get('api/Escuela');
        //extraigo el objeto en la posición cero del array para sacar la Escuela de industrial, asumo que se crean en orden
        $escuelaX= $response[0];

        //por la clave "nombre" saco el valor que contiene en el array asociativo.
        $this->assertEquals( $escuelaX["nombre"],'Ingeniería Civil Industrial');
       
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
        $response= $this->post('api/Escuela',['nombre'=>'ingenieria civil en puteria']);
      
        $response->assertOk();
        $response=$this->get('api/Escuela');
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

        $escuela=Escuela::create([
            'nombre' => 'Prueba Escuela'
        ]);

        $this -> assertCount(1,Escuela::all());

        $response = $this->put('api/Escuela/'.$escuela->id,[
            'nombre'   => 'Cambio Prueba'
        ]);

        $response->assertOK();

        $this->assertDatabaseHas('escuelas', [
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

        $escuela=Escuela::create([
            'nombre' => 'Prueba Escuela'
        ]);

        $response = $this->delete('api/Escuela/'.$escuela->id);

        $response -> assertOk();

        $response = Escuela::onlyTrashed()->where('id', '=', $escuela->id)->get();

        $this->assertNotNull($response->contains('deleted_at', $response[0]->deleted_at)); 
    }
}
