<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_cart_user', function (Blueprint $table) {
            $table->dropForeign('book_cart_user_cart_id_foreign');
        });
        Schema::dropIfExists('carts');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });
        Schema::table('book_cart_user', function (Blueprint $table) {
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
        });
    }
}
