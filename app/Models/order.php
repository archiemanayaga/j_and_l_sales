<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'service_id', 'service_fee', 'user_id'
    ];

    public function orderItems()
    {
    	return $this->hasMany(OrderFlower::class);
    }

    public function service()
    {
    	return $this->belongsTo(Service::class);
    }
}
