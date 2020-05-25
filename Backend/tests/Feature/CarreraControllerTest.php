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
    public function testShow()
    {

    }

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
