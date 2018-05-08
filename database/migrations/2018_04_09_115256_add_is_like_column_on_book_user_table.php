<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsLikeColumnOnBookUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('book_user', 'isLike')) {
            Schema::table('book_user', function (Blueprint $table) {
                $table->tinyInteger('isLike')->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('book_user', 'isLike')) {
            Schema::table('book_user', function (Blueprint $table) {
                $table->removeColumn('isLike');
            });
        }

    }
}
