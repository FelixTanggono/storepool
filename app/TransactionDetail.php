<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    //
    protected $table = 'transaction_detail';
    public $timestamps = false;

    protected $guarded = ['id'];


   //cannot be changed
}
