<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'carrera'=> $faker->randomDigit,
        'rol'=> "administrador",
        'foto' => 0,
        'email' => $faker->unique()->safeEmail,
        'password'=> 'pepito123'//$faker->password
         
            
        //
    ];
});
