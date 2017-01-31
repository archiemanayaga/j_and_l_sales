<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_flowers extends Model
{
     protected $fillable = [
        'order_id', 'flower_id', 'accessory_id', 'quantity', 'accessory_price', 'flower_price',
    ];
}
