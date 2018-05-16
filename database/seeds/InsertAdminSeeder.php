<?php

use Illuminate\Database\Seeder;

class InsertAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'iamadmin',
            'email' => 'adminEmail@gmail.com',
            'password' => bcrypt('secret'),
            'is_customer' => 0,
            'status' => 1
        ]);
    }
}
