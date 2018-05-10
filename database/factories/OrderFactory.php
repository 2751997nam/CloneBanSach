<?php

use Faker\Generator as Faker;

$factory->define(\App\Order::class, function (Faker $faker) {
    return [
        'user_id' => null,
        'phone' => (string)"0" . mt_rand(10, 99) . mt_rand(1000000, 9999999),
        'name' => null,
        'email' => null,
        'address' => $faker->address,
    ];
});
