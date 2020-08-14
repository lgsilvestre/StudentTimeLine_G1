<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
            'nombre' => 'Brayan Escobar',
            'escuela' => 1,
            'rol' => 'admin', 
            'foto' => null,
            'email' => 'bescobar14@alumnos.utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $admin->assignRole('admin');
        $admin=User::create([
            'nombre' => 'Felipe Milla',
            'escuela' => 1,
            'rol' => 'admin', 
            'foto' => null,
            'email' => 'fmilla15@alumnos.utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $admin->assignRole('admin');
        $admin=User::create([
            'nombre' => 'Matias Pizarro',
            'escuela' => 1,
            'rol' => 'admin', 
            'foto' => null,
            'email' => 'mpizarro16@alumnos.utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $admin->assignRole('admin');
        $admin=User::create([
            'nombre' => 'Sebastian Ibarra',
            'escuela' => 1,
            'rol' => 'admin', 
            'foto' => null,
            'email' => 'sibarra15@alumnos.utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $admin->assignRole('admin');
        $admin=User::create([
            'nombre' => 'Paulo Parraguez',
            'escuela' => 1,
            'rol' => 'admin', 
            'foto' => null,
            'email' => 'pparraguez14@alumnos.utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $admin->assignRole('admin');
        $admin=User::create([
            'nombre' => 'Javiera Mendez',
            'escuela' => 1,
            'rol' => 'admin', 
            'foto' => null,
            'email' => 'jmendez14@alumnos.utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $admin->assignRole('admin');
    }
}

        