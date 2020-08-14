<?php

use Illuminate\Database\Seeder;
use App\Escuela;
class EscuelaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fi=Escuela::create([
            'nombre' => 'Facultad de ingenieria',
            'cod_escuela' => 001
        ]);
    }
}
