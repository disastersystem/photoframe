<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Trip::class, function (Faker\Generator $faker) {
    return [
        'title'                 => $faker->city,
        'user_id'               => factory('App\User')->create()->id,
        'leaving'               => $faker->date($format = 'Y-m-d', $max = 'now'),
        'returning'             => $faker->date($format = 'Y-m-d', $max = 'now'),
        'program'               => $faker->realText($maxNbChars = 600, $indexSize = 2),
        'other'                 => $faker->realText($maxNbChars = 600, $indexSize = 2),
        'recruitment_type'      => $faker->numberBetween(0, 1),
        'airplane_tickets_help' => $faker->numberBetween(0, 1),
        'double_price'          => $faker->numberBetween(100, 10000),
        'single_price'          => $faker->numberBetween(100, 10000),
        'discount'              => $faker->numberBetween(0, 100)
    ];
});

$factory->define(App\TripActivity::class, function (Faker\Generator $faker) {
    return [
        'trip_id'   => factory('App\Trip')->create()->id,
        'title'     => $faker->city,
        'price'     => $faker->numberBetween(100, 1500),
        'discount'  => $faker->numberBetween(0, 100)
    ];
});
