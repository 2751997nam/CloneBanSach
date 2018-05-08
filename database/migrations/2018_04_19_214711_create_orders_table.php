<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('name', 256);
            $table->string('phone', 15);
            $table->string('email', 256)->nullable();
            $table->string('address', 500);
            $table->timestamps();
            //$table->foreign('id')->references('id')->on('bills')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('orders', function (Blueprint $table) {
//            $table->dropForeign('orders_id_foreign');
//        });
        Schema::dropIfExists('orders');
    }
}
