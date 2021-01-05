<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserShopAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_shop_account', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_shop_id');
            $table->unsignedBigInteger('marketplace_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('email');
            $table->string('password');
            $table->foreign('user_shop_id')->references('id')->on('user_shop');
            $table->foreign('marketplace_id')->references('id')->on('marketplace');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_shop_account');
    }
}
