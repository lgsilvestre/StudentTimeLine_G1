<?php

use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoria=Categoria::create([
            'nombre' => 'Ayudantía'
        ]);

        $categoria=Categoria::create([
            'nombre' => 'Práctica'
        ]);

        $categoria=Categoria::create([
            'nombre' => 'Copia'
        ]);

        $categoria=Categoria::create([
            'nombre' => 'Otro'
        ]);

        $categoria=Categoria::create([
            'nombre' => 'En Observación - 1 por Tercera'
        ]);

        $categoria=Categoria::create([
            'nombre' => 'En observación - 1 por Segunda'
        ]);

        $categoria=Categoria::create([
            'nombre' => 'Se Retira'
        ]);

        $categoria=Categoria::create([
            'nombre' => 'Eliminado por Rendimiento'
        ]);

        $categoria=Categoria::create([
            'nombre' => 'Titulado'
        ]);

        $categoria=Categoria::create([
            'nombre' => 'Eliminado Art. 31 E'
        ]);

        $categoria=Categoria::create([
            'nombre' => 'Eliminado Art. 31 B'
        ]);
    }
}
