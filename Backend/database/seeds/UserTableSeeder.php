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
            'email' => 'secretariadeescuela@utalca.cl',
            'password' => bcrypt('1234')
        ]);
        $director->assignRole('secretaria de escuela');

        $director=User::create([
            'nombre' => 'secretaria de escuela 2',
            'escuela' => 3,
            'escuelaAux' => 8,
            'rol' => 'secretaria de escuela', 
            'foto' => null,
            'email' => 'secretariadeescuela2@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $director->assignRole('secretaria de escuela');

        $director=User::create([
            'nombre' => 'test de doble escuela',
            'escuela' => 1,
            'escuelaAux' => 8,
            'rol' => 'secretaria de escuela', 
            'foto' => null,
            'email' => 'test@gmail.com',
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

        $profesor=User::create([
            'nombre' => 'wilfred',
            'escuela' => 8,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'wilfred@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'El Moustro Milton',
            'escuela' => 8,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'Milton@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');


        $profesor=User::create([
            'nombre' => 'Jorge Andres Hinojosa Rehbein',
            'escuela' => 4,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'jhinojosa@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'Ambrosio Juan Martinich Leal',
            'escuela' => 4,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'ambrosio@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'Daniel Mora Melia',
            'escuela' => 5,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'damora@utalca.cl',
            'password' => bcrypt('12345678')
        ]);

        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'Ernesto Del Rosario Santibañez Gonzalez',
            'escuela' => 2,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'esantibanez@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'Matthew Bardeen',
            'escuela' => 1,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'mbardeen@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'Renzo Angles Rojas',
            'escuela' => 1,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'rangles@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'Claudio Tenreiro',
            'escuela' => 8,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'ctenreiro@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'Eduardo André Alvarez Miranda',
            'escuela' => 2,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'ealvarez@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'Jans Humberto Alzate Morales',
            'escuela' => 1,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'jalzate@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'Enzo Alejandro Arellano Ramos',
            'escuela' => 5,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'earellano@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'Mauricio Antonio Arenas Salinas',
            'escuela' => 1,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'marenas@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'Carlos Rodrigo Baier Fuentes',
            'escuela' => 4,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'cbaier@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        #-----
        $profesor=User::create([
            'nombre' => 'Javier Andrés Muñoz Vidal',
            'escuela' => 3,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'jamunoz@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'Leonardo Jose Albornoz',
            'escuela' => 3,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'lalbornoz@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'Armando Isaias Duran',
            'escuela' => 5,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'aduran@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'Ruth Maria Beatriz Garrido',
            'escuela' => 1,
            'rol' => 'secretaria de escuela', 
            'foto' => null,
            'email' => 'rgarrido@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('secretaria de escuela');

        $profesor=User::create([
            'nombre' => 'Kenji Naito Chiang',
            'escuela' => 6,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'knaito@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'Gabriel Armando Nuñez',
            'escuela' => 1,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'ganunez@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'Pablo Ignacio Rojas Valdes',
            'escuela' => 1,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'pabrojas@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'Daniel Esteban Díaz Besoanin',
            'escuela' => 7,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'ddiaz@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'Cristian Marcelo Mardones Neculqueo',
            'escuela' => 3,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'cmardonesn@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'Cesar Alejandro Astudillo Hernandez',
            'escuela' => 1,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'castudillo@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');

        $profesor=User::create([
            'nombre' => 'Julio Miguel Caballero Ruiz',
            'escuela' => 1,
            'rol' => 'profesor', 
            'foto' => null,
            'email' => 'jcaballero@utalca.cl',
            'password' => bcrypt('12345678')
        ]);
        $profesor->assignRole('profesor');
    }
}

        