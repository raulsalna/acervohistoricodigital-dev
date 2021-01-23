<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Box\Box;
use Faker\Generator as Faker;
use Carbon\Carbon;


$factory->define(Box::class, function (Faker $faker) {
  return [
    'fileName' => $faker->randomElement([
      'BoxNational',
      'BoxInternational',
      'BoxAcervo',
      'BoxArt',
    ]) . " " . $faker->randomNumber($nbDigits = 3, $strict = true),
    'place' => $faker->randomElement([
      'Triangular',
      'Matias Romero',
      'Claustro',
      'Cancilleria',
      'Estado',
      'Embajada',
    ]),
    'depositRoom' => $faker->randomElement([
      'Gallery',
      'Sotano',
      'Primer Piso',
      'Primer Segundo',
      'Psio 21',
      'Lobby',
    ]),
    'corridor' => $faker->randomElement([
      'Corredor Uno',
      'Corredor Dos',
      'Corredor Tres',
      'Corredor Cuatro',
      'Corredor Cinco',
      'Corredor Central',
    ]),
    'shelf' => $faker->randomElement([
      'Estante Uno',
      'Estante Dos',
      'Estante Tres',
      'Estante Cuatro',
      'Estante Cinco',
      'Estante Central',
    ]),
    'strep' => $faker->randomElement([
      'Entrepaño Uno',
      'Entrepaño Dos',
      'Entrepaño Tres',
      'Entrepaño Cuatro',
      'Entrepaño Cinco',
      'Entrepaño Central',
    ]),
    'box' => $faker->randomElement([1,2,3,5,6]),
    //
  ];
});
