<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase; //estoy indicando que trabajare con una bd de prueba, la cual estara solo en memoria
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
Use App\User;


class UpdateTest extends TestCase
{
    use RefreshDatabase;// necesitamos tener creadas las migraciones en nuestra bd de prueba temporal... la bd de prueba esta en phpunit.xml
    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function modificar()
    {
        #sacamos el manejo de excepciones para que me muestre el error directo
        $this->withoutExceptionHandling();
        
        #contexto, crear usuarios en la bd.. 
        #en este caso solo usaremos uno para probar.

        //$usuario= Factory(User::Class)->create();  llamar seeder del seba

        #accion, generar una peticion http a la ruta del metodo actualizar
        //$response = $this->get('/');        
        $peticion= $this->put('/api/user/'.$usuario->id,[
            'nombre' => 'paulo parraguez diaz',
            'carrera'=>407 ,
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
        $this->assertEquals($usuario->carrera,407);
        $this->assertEquals($usuario->rol,'administrador');
        $this->assertEquals($usuario->foto,1);
        $this->assertEquals($usuario->email,'p.parraguez.diaz@hotmail.cl');
        $this->assertEquals($usuario->password,'81697218Paulo');


        

        //$response->assertStatus(200);
    }
}
