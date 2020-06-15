<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

#'nombre', 'carrera', 'rol', 'foto', 'email','password',
$factory->define(User::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'carrera' => "Computación",
        'rol' => 'Administrador',
        'foto' => null,
        'email' => $faker->unique()->safeEmail,
        'password' => 'passwordTest',
    ];
});
