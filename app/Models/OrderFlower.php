<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderFlower extends Model
{
	protected $table = 'order_flowers';
    protected $fillable = [
        'order_id', 'flower_id', 'accessory_id', 'quantity', 'price',
    ];

    public function flowers()
    {
    	return $this->belongsTo(Flower::class, 'flower_id');
    }

    public function accessories()
    {
    	return $this->belongsTo(Accessory::class, 'accessory_id');
    }
}
