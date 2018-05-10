<?php

use Faker\Generator as Faker;

$factory->define(\App\Employee::class, function (Faker $faker) {
    $pos = \App\Position::where('name', '!=' , 'thư ký')->where('name', '!=', 'giám đốc')->pluck('id')->toArray();
    $ran = array_rand($pos);
    $position = \App\Position::find($pos[$ran]);

    $b = \App\Employee::orderBy('id', 'desc')->first();
    $count = 1;
    if($b !== null) $count = $b->id + 1;
    else $count++;
    return [
        'id' => factory(\App\User::class)->create(['is_customer' => '0'])->id,
        'employee_code' => $count < 10 ? "E"."000".$count:($count < 100 ? "E"."00".$count:($count < 1000?"E"."0".$count:"E".$count)),
        'salary_level' => $position->base_salary_level,
        'dob' => $faker->date('Y-m-d', '-20 years'),
        'position_id' => $position->id,
        'level' => '1'
    ];
});
