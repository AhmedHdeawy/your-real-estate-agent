<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Like;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {

    $post = App\Models\Post::get()->random();
    $user = $post->group->members->random();

    return [
        'user_id'   =>  $user->id,
        'post_id'   =>  $post->id,
    ];
});
