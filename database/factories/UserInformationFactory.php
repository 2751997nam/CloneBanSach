<?php

use Faker\Generator as Faker;

$factory->define(\App\User_information::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class)->create(['is_customer' => '1'])->id,
        'phone' => (string)"0" . mt_rand(10, 99) . mt_rand(1000000, 9999999),
        'gender' => $faker->randomElement(['nam', 'nu']),
        'dob' => $faker->date('Y-m-d', '-10 years'),
    ];
});
