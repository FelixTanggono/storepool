<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserShop extends Model
{
    //
    protected $table = 'user_shop';
    public $timestamps = false;

    protected $guarded = ['id'];

}
