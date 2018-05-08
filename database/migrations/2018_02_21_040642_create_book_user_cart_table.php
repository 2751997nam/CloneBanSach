<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookUserCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_user_cart', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('book_id')->unsigned();

            $table->integer('user_id')->unsigned();

            $table->unsignedInteger('quantity');
            $table->tinyInteger('was_paid')->default(0);
            $table->timestamps();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_user_cart');
    }
}
