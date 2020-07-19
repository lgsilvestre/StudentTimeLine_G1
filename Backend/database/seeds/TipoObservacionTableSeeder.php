<?php

use Illuminate\Database\Seeder;
use App\TipoObservacion;

class TipoObservacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoObservacion::create([
            'descripcion' => 'Positiva'
        ]);

        TipoObservacion::create([
            'descripcion' => 'Negativa'
        ]);

        TipoObservacion::create([
            'descripcion' => 'Informativa'
        ]);

        TipoObservacion::create([
            'descripcion' => 'Otro'
        ]);
    }
}
