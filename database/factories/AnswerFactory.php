<?php

use Faker\Generator as Faker;

$factory->define(App\Answer::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph(rand(3, 9), true),
        'user_id' => App\User::pluck('id'->random()),
        'body' => rand(0, 5)
    ];
});
