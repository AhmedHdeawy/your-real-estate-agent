<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Reply;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {

    $comment = App\Models\Comment::get()->random();
    $user = $comment->post->group->members->random();

    return [
        'text'  =>  $faker->realText(30),
        'user_id'   =>  $user->id,
        'comment_id'   =>  $comment->id,
    ];
});
