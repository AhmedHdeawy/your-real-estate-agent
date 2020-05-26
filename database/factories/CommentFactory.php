<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {

    $post = App\Models\Post::get()->random();

    return [
        'text'  =>  $faker->realText(100),
        'user_id'   =>  $post->user_id,
        'post_id'   =>  $post->id,
    ];
});
