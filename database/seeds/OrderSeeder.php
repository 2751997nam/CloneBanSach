<?php

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
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

        foreach ($users as $user) {
            factory(\App\Order::class)->create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => isset($user->information->phone) ? $user->information->phone : "0" . mt_rand(10, 99) . mt_rand(1000000, 9999999),
            ]);
        }
    }
}
