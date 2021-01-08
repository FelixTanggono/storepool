<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';
    public $timestamps = false;

    protected $fillable = [
        'name','SKU', 'image' , 'buy_price' , 'sell_price' , 'stock' , 'user_id'
    ];

    protected $guarded = ['id'];

}
