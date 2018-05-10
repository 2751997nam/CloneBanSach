<?php

use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cate = \App\Category::all()->pluck('id')->toArray();


        for($i = 0; $i < 100; $i++) {
            factory(\App\Book::class)->create([
                'img' => 'public/img/bookSeedImg'.$i.'.jpg',
                'img_name' => 'bookSeedImg'.$i.'.jpg',
            ])->each(function ($b) use ($cate) {
                $b->categories()->sync(array_intersect_key( $cate, array_flip( array_rand( $cate, 3 ) ) ));
            });
        }
    }
}
