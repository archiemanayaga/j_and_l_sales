<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'service_id', 'service_fee', 'customer_id', 'user_id'
    ];

    public function orderItems()
    {
    	return $this->hasMany(OrderFlower::class);
    }

    public function service()
    {
    	return $this->belongsTo(Service::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
