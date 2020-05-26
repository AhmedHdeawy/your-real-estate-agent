<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Group;
use App\User;
use Faker\Generator as Faker;

$factory->define(Group::class, function (Faker $faker) {

    $country = generateCS()[0];
    $state =  generateCS()[1];
    $user = App\User::get()->random();

    return [
        'name'  =>  $faker->realText(30),
        'description'   =>  $faker->realText(200),
        'address'   =>  $faker->address,
        'city'   =>  $faker->city,
        'lat'   =>  $faker->latitude($min = 10, $max = 30),
        'lng'   =>  $faker->longitude($min = 30, $max = 60),
        'user_id'   =>  $user->id,
        'country_id'   =>  $country->id,
        'state_id'   =>  $state->id,
    ];
});


function generateCS()
{
    $country = \App\Models\Country::inRandomOrder()->first();

    if ($country->states->isEmpty()) {
        return $this->generateCS();
    }

    $state = \App\Models\State::where('country_id', $country->id)->inRandomOrder()->first();


    return [$country, $state];
}
