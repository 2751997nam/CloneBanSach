<?php

use Faker\Generator as Faker;

$factory->define(\App\Book_user::class, function (Faker $faker) {
    return [
        'book_id' => null,
        'user_id' => null,
        'comment' => $faker->sentence(10),
        'isLike' => random_int(0, 1),
        'star' => random_int(1, 5)
    ];
});
