<?php

use Faker\Generator as Faker;

$factory->define(\App\Bill::class, function (Faker $faker) {
    return [
        'bill_code' => null,
        'order_id' => null,
        'was_paid' => 1,
        'employee_code' => null,
    ];
});
