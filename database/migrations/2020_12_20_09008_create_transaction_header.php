<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionHeader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_header', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('address_id');
            $table->unsignedBigInteger('courier_id');
            $table->unsignedBigInteger('user_shop_account_id');
            $table->unsignedBigInteger('transaction_status_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamp('time_stamp') ;
            $table->string('tracking_number');
            $table->decimal('total_price', 10, 2);
            $table->foreign('address_id')->references('id')->on('address');
            $table->foreign('courier_id')->references('id')->on('courier');
            $table->foreign('user_shop_account_id')->references('id')->on('user_shop_account');
            $table->foreign('transaction_status_id')->references('id')->on('transaction_status');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_header');
    }
}
