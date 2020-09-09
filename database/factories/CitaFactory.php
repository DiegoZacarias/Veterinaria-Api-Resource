<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cita;
use Faker\Generator as Faker;

$factory->define(Cita::class, function (Faker $faker) {
    return [
        'nombre_mascota' => $faker->word,
          'nombre_dueno' => $faker->name,
          'fecha' => $faker->date($format = 'Y-m-d', $max = 'now'),
          'hora' => $faker->time($format = 'H:i', $max = 'now'),
          'sintomas' => $faker->text
    ];
});
