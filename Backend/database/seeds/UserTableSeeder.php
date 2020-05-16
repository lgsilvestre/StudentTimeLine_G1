<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=User::create([
            'name' => 'administrador',
            'email' => 'administrador@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $admin->assignRole('administrador');

        $director=User::create([
            'name' => 'secretaria de escuela',
            'email' => 'secretariadeescuela@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $director->assignRole('director');

        $profesor=User::create([
            'name' => 'profesor',
            'email' => 'profesor@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        
    }
}
