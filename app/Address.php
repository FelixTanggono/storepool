<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $table = 'address';
    public $timestamps = false;

    protected $fillable = [
        'name','phone_number', 'address' , 'postal_code'
    ];

    protected $guarded = ['id'];

}
