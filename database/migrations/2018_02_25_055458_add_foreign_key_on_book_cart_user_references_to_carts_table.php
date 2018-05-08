<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyOnBookCartUserReferencesToCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_cart_user', function (Blueprint $table) {
            $table->unsignedInteger('cart_id');
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
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
            $table->dropForeign('book_cart_user_cart_id_foreign');
            $table->removeColumn('cart_id');
        });
    }
}
