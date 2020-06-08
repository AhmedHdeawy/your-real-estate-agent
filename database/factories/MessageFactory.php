<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {

    return [
        'sender_id'     =>  $faker->numberBetween($min = 1, $max = 50),
        'receiver_id'   =>  $faker->numberBetween($min = 1, $max = 50),
        'text'  =>  $faker->realText(20),
    ];
});
