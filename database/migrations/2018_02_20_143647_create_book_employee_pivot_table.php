<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookEmployeePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_employee', function (Blueprint $table) {
            $table->integer('book_id')->unsigned()->index();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->integer('employee_id')->unsigned()->index();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->primary(['book_id', 'employee_id']);
            $table->unsignedInteger('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('book_employee');
    }
}
