<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UsuarioControllerTest extends TestCase
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

        //Utilizo factory para crear datos de prueba.
        $user = factory(User::class)->create();

        $response = $this->get('User/'.$user->id);
        //$user = User::first();
        $response -> assertOk();
        
        #No puse todos los atributos del usuario
        $this->assertDatabaseHas('users', [
            'nombre' => $user->nombre,
            'carrera' => $user->carrera,
            'email' => $user->email,
            'password' => $user->password
        ]);
    }

    /**
     * @test
     *
     *
     */
    /*
    public function testCreate()
    {

    }*/

}
