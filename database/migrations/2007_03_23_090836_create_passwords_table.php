<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passwords', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            //$table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');
            $table->string('value');
            $table->string('login');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('password_role_id');
            $table->timestamps();
        });
        Schema::table('passwords', function (Blueprint $table) {
            $table->foreign('password_role_id')->references('id')->on('roles');
            //$table->foreign('category_id')->references('id')->on('password_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passwords');
    }
}
