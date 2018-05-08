<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeletePublishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publishers', function (Blueprint $table) {
            Schema::dropIfExists('publishers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('publishers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('address', 100)->nullable();
            $table->string('phone_numer', 15)->nullable();
            $table->timestamps();
        });
    }
}
