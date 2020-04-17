<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Group;
use App\User;
use Faker\Generator as Faker;

$factory->define(Group::class, function (Faker $faker) {
    return [
        'name'  =>  $faker->realText(30),
        'description'   =>  $faker->realText(200),
        // 'user_id'   =>  User::get()->random()->id,
        'user_id'   =>  $faker->numberBetween(1, 50),
    ];
});
