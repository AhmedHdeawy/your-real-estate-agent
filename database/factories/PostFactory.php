<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {

    $member = App\Models\GroupMember::get()->random();

    return [
        'text'  =>  $faker->realText(400),
        'group_id'   =>  $member->group_id,
        'user_id'   =>  $member->user_id,
    ];
});
