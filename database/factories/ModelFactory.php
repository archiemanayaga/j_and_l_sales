<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Flower::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'description' => $faker->text,
        'price' => rand(10, 100),
        'quantity' => rand(5, 50),
    ];
});

$factory->define(App\Accessory::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'description' => $faker->text,
        'price' => rand(5, 15),
        'quantity' => rand(5, 30),
    ];
});
