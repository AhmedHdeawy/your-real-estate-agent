<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\GroupMember;
use Faker\Generator as Faker;

$factory->define(GroupMember::class, function (Faker $faker) {

    $group = App\Models\Group::get()->random();
    $user = App\User::get()->random();

    return [
        'user_id'   =>  $user->id,
        'group_id'   =>  $group->id,
    ];
});
