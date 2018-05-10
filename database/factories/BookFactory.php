<?php

use Faker\Generator as Faker;

$factory->define(\App\Book::class, function (Faker $faker) {
    $b = \App\Book::orderBy('id', 'desc')->first();
    $count = 1;
    if($b !== null)$count = $b->id + 1;
    else $count++;
    return [
        'book_code' => $count < 10 ? "B"."000".$count:($count < 100 ? "B"."00".$count:($count < 1000?"B"."0".$count:"B".$count)),
        'name' => $faker->sentence(7),
        'price' => $faker->numberBetween(10, 300) * 1000,
        'img' => null,
        'author' => $faker->name,
        'description' => $faker->paragraph(5, 10),
        'publisher' => $faker->company,
        'quantity' => $faker->numberBetween(100, 5000),
        'discount' => $faker->numberBetween(0, 30),
        'img_name' => null,
    ];
});
