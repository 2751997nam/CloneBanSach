<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('book_code', 15);
            $table->string('name', 256);
            $table->float('price', 15, 2);
            $table->tinyInteger('discount');
            $table->unsignedInteger('quantity');
            $table->timestamps();
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign('order_items_order_id_foreign');
        });
        Schema::dropIfExists('order_items');

    }
}
