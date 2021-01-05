<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marketplace extends Model
{
    //
    protected $table = 'marketplace';
    public $timestamps = false;

    protected $guarded = ['id'];

    
}
