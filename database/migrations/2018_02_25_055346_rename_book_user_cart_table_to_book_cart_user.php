<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameBookUserCartTableToBookCartUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_user_cart', function (Blueprint $table) {
            $table->rename('book_cart_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_cart_user', function (Blueprint $table) {
            $table->rename('book_user_cart');
        });
    }
}
