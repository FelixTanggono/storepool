<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_header_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('item_name'); 
            $table->string('item_SKU'); 
            
            $table->decimal('quantity', 10, 2);
            $table->decimal('total_buyprice', 10, 2);
            $table->decimal('total_sellprice', 10, 2);
            $table->decimal('discount', 3, 1)->default(0);
            $table->foreign('transaction_header_id')->references('id')->on('transaction_header');
            $table->foreign('item_id')->references('id')->on('item');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_detail');
    }
}
