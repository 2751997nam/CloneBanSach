<?php

use Illuminate\Database\Seeder;

class Book_userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = \App\Book::all()->pluck('id')->toArray();
        $users = \App\User::where('is_customer', '=', '1')->pluck('id')->toArray();
        foreach($users as $user) {
            $rand = random_int(1, 3);
            $arrayBooks = array();
            $rand > 1 ? $arrayBooks = array_intersect_key( $books, array_flip( array_rand( $books, $rand ) ) )
                        : $arrayBooks = $books[array_rand($books)];
            if ($rand > 1)
                foreach($arrayBooks as $arrayBook) {
                    factory(\App\Book_user::class)->create([
                        'book_id' => $arrayBook,
                        'user_id' => $user,
                    ]);
                }
            else factory(\App\Book_user::class)->create([
                'book_id' => $arrayBooks,
                'user_id' => $user,
            ]);
        }
    }
}
