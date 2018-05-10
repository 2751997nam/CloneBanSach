<?php

use Faker\Generator as Faker;

$factory->define(\App\Order_item::class, function (Faker $faker) {
    return [
        'order_id' => null,
        'book_code' => null,
        'name' => null,
        'price' => null,
        'quantity' => $faker->numberBetween(1, 10),
        'discount' => null,
    ];
});
