<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameBookCartUserTableToCartAndRenameCartIdToCartCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_cart_user', function (Blueprint $table) {
            DB::query("ALTER TABLE `book_cart_user` 
                CHANGE COLUMN `cart_id` `cart_code` VARCHAR(15) NOT NULL ,
                ADD UNIQUE INDEX `cart_id_UNIQUE` (`cart_code` ASC), RENAME TO  `cart` ");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart', function (Blueprint $table) {
            DB::query("ALTER TABLE `cart` 
                CHANGE COLUMN `cart_code` `cart_id` INT(10) NOT NULL ,
                ADD UNIQUE INDEX `cart_code_UNIQUE` (`cart_id` ASC), RENAME TO  `book_cart_user` ");
        });
    }
}
