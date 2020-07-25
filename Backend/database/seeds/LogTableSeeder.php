<?php

use Illuminate\Database\Seeder;
use App\Log;
class LogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items []= array("Inicio" => "se a inicualizado el sistema de ayudantes de la universidad de talca");
        json_encode($items);  
        Log::create([
            'titulo' => "Inicializacion del sistema",
            'descripcion' => json_encode($items),
            'usuario' => '1'
        ]);
    }
}
