<?php

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

$faker = \Faker\Factory::create('pt_BR');

$factory->define(App\User::class, function (Faker $faker) {
    return [
        "name" => $faker->name,
        "email" => $faker->unique()->safeEmail,        
        "cpf" => $faker->cpf(false),
        "password" => str_random(10) 
    ];
});
