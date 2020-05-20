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
    
    public function testStore()
    {
        $this -> withoutExceptionHandling();

        //$user = factory(User::class)->create();

        $response = $this->post('User/', [
            'nombre'   => 'Pepito',
            'carrera' => '1',
            'rol' => 'Administrador', 
            'foto' => '1',
            'email'=> 'pepito@hotmail.com',
            'password' => 'papa123',
        ]);

        $this -> assertCount(1,User::all());

        //$test = User::first();

        $response -> assertOk();

        $this->assertDatabaseHas('users', [
            'nombre'   => 'Pepito',
            'carrera' => '1',
            'rol' => 'Administrador', 
            'foto' => '1',
            'email'=> 'pepito@hotmail.com',
            'password' => 'papa123'
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

        $user = factory(User::class)->create();

        $response = $this->delete('User/'.$user->id);

        $response -> assertOk();

        $response = User::onlyTrashed()->where('id', '=', $user->id)->get();

        $this->assertNotNull($response->contains('deleted_at', $response[0]->deleted_at)); 
    }
    
}
