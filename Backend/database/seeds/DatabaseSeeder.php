<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissions::class);
        $this->call(EscuelaTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(EstudianteTableSeeder::class);
        $this->call(CursoTableSeeder::class);
        $this->call(SemestreTableSeeder::class);
        $this->call(InstanciaCursoTableSeeder::class);
        $this->call(ProfesorCursoTableSeeder::class);
    }
}
