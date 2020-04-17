<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {

    $group = App\Models\Group::get()->random();

    return [
        'text'  =>  $faker->realText(400),
        'user_id'   =>  $group->id,
        'group_id'   =>  $group->user_id,
    ];
});
