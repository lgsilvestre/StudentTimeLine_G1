<?php

use Illuminate\Database\Seeder;
use App\User;
class UsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seeder para rellenar usurio de prueba.
        Factory(User::Class,5)->create();

        /**$usuario = new User();
        $usuario->nombre = 'paulo parraguez daz';
        $usuario ->carrera=407;
        $usuario -> rol= 'administrador';
        $usuario ->foto =0;
        $usuario ->email ='p.parraguez.diaz@hotmail.cl';
        $usuario ->password='81697218Pauloa';
        $usuario -> save();**/
            
    }
}
