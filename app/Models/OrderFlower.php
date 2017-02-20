<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderFlower extends Model
{
	protected $table = 'order_flowers';
    protected $fillable = [
        'order_id', 'flower_id', 'accessory_id', 'quantity', 'price',
    ];
}
