<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

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

$factory->define(\App\Models\ProcedureTime::class, function (Faker $faker) {
    return [
        'start' => $faker->time(),
        'end' => $faker->time(),
        'day' => rand(0, 6),
        'day_off' => $faker->boolean(70),
    ];
});
