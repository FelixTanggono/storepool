<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    //
    protected $table = 'courier';
    public $timestamps = false;

    protected $guarded = ['id'];

}
