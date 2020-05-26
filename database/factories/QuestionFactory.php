<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\GroupQuestion;
use Faker\Generator as Faker;

$factory->define(GroupQuestion::class, function (Faker $faker) {
    return [
        'title'  =>  $faker->realText(30),
        'answer'   =>  $faker->realText(50),
        'group_id'   =>  $faker->numberBetween(1, 25),
    ];
});
