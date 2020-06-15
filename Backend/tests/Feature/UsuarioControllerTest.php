<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
//use Tests\Feature\WithoutMiddleware;
use Tests\TestCase;
use App\User;

class UsuarioControllerTest extends TestCase
{
    use RefreshDatabase;
    //use WithoutMiddleware;

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
            'escuela' => $user->escuela,
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
            'escuela' => '1',
            'rol' => 'Administrador', 
            'foto' => null,
            'email'=> 'pepito@hotmail.com',
            'password' => 'papa123',
        ]);

        $this -> assertCount(1,User::all());

        //$test = User::first();

        $response -> assertOk();

        $this->assertDatabaseHas('users', [
            'nombre'   => 'Pepito',
            'escuela' => '1',
            'rol' => 'Administrador', 
            'foto' => null,
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
    

    
    public function modificar()
    {
        #sacamos el manejo de excepciones para que me muestre el error directo
        $this->withoutExceptionHandling();
        
        #contexto, crear usuarios en la bd.. 
        #en este caso solo usaremos uno para probar.

        $usuario= Factory(User::Class)->create();  #llamar seeder del seba

        #accion, generar una peticion http a la ruta del metodo actualizar
        //$response = $this->get('/');        
        $peticion= $this->put('User/'.$usuario->id,[
            'nombre' => 'paulo parraguez diaz',
            'escuela'=>407 ,
            'rol'=> 'administrador',
            'foto' => 1,
            'email' => 'p.parraguez.diaz@hotmail.cl',
            'password'=> '81697218Paulo'
        ]);
    

        $peticion->assertOK();//confirme que no hay ningun error
        //confirma que estas contando un post en mi tabla de post
        $this->assertCount(1,User::all());//confirma si por lo menos hay un post en la tabla post

        #comprobar que la informacion guardada coincide con la del json
        $usuario =$usuario->fresh();
        $this->assertEquals($usuario->nombre,'paulo parraguez diaz');
        $this->assertEquals($usuario->escuela,407);
        $this->assertEquals($usuario->rol,'administrador');
        $this->assertEquals($usuario->foto,1);
        $this->assertEquals($usuario->email,'p.parraguez.diaz@hotmail.cl');
        $this->assertEquals($usuario->password,'81697218Paulo');
        //$response->assertStatus(200);
    }
}