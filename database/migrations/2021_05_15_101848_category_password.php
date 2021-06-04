<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryPassword extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_password', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('password_id');
            $table->unsignedBigInteger('password_category_id');
        });
        Schema::table('category_password', function (Blueprint $table) {
            $table->foreign('password_category_id')->references('id')->on('password_categories');
            $table->foreign('password_id')->references('id')->on('passwords');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
