<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Output\OutputInterface;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::beginTransaction();
        try {
            $this->call(InsertAdminSeeder::class);
//            $this->call(UserInformationSeeder::class);
//            $this->call(EmployeeSeeder::class);
//            $this->call(BookSeeder::class);
//            $this->call(Book_userSeeder::class);
//            $this->call(OrderSeeder::class);
//            $this->call(Order_itemSeeder::class);
//            $this->call(BillSeeder::class);
            DB::commit();
        }catch (Exception $e) {
            DB::rollBack();
            $output = new ConsoleOutput(\Symfony\Component\Console\Output\ConsoleOutput::VERBOSITY_VERBOSE);
            (new ConsoleApplication)->renderException($e, $output);
        }
    }
}
