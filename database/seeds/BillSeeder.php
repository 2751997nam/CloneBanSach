<?php

use Illuminate\Database\Seeder;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::where('is_customer', '=', '1')
            ->whereIn('users.id', \App\Book_user::all()->pluck('user_id'))->get();

        $employee_codes = \App\Employee::where('position_id', '=' , '3')->pluck('employee_code')->toArray();

        $orders = \App\Order::all()->pluck('id')->toArray();
        $i = 0;
        $b = \App\Bill::orderBy('id', 'desc')->first();
        $b != null ? $b = (int) $b->id + 1 : $b = 1;
        foreach ($users as $user) {
            factory(\App\Bill::class)->create([
                'bill_code' => $b < 10 ? "B00000".$b : ($b < 100 ? "B0000".$b : ($b < 1000 ? "B000".$b : ($b < 10000 ? "B00".$b : ($b < 100000 ? "B0".$b : "B".$b)))),
                'order_id' => $orders[$i],
                'employee_code' => $employee_codes[array_rand($employee_codes)],
            ]);
            $b++;
            $i++;
        }
    }
}
