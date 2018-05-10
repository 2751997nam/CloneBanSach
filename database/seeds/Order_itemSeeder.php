<?php

use Illuminate\Database\Seeder;

class Order_itemSeeder extends Seeder
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
        $orders = \App\Order::all()->pluck('id')->toArray();
        $i = 1004;
        foreach ($users as $user) {
            foreach($user->books as $book ){
                factory(\App\Order_item::class)->create([
                    'order_id' => $orders[$i],
                    'book_code' => $book->book_code,
                    'name' => $book->name,
                    'price' => $book->price,
                    'discount' => $book->discount,
                ]);
            }
            $i++;
        }
    }
}
