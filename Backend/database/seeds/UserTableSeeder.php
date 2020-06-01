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
            'nombre' => 'admin',
            'escuela' => 1,
            'rol' => 'admin', 
            'foto' => null,
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $admin->assignRole('admin');

        $director=User::create([
            'nombre' => 'secretaria de escuela',
            'escuela' => 1,
            'rol' => 'secretaria de escuela', 
            'foto' => null,
            'email' => 'secretariadeescuela@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $director->assignRole('secretaria de escuela');

        $profesor=User::create([
            'nombre' => 'profesor',
            'escuela' => 1,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'profesor@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');
    }
}

        