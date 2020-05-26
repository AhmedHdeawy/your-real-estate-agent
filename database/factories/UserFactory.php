<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'username'  =>  $faker->userName . $faker->randomNumber(4),
        'age'   =>  $faker->numberBetween(12, 120),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'phone' =>  $faker->phoneNumber,
        'gender' =>  random_int(1, 1000) % 2 == 0 ? '1' : '0',
        'password' => 'password',
        'remember_token' => Str::random(10),
    ];
});
