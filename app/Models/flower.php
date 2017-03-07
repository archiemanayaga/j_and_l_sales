<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class flower extends Model
{
     protected $fillable = [
        'name', 'description', 'price', 'quantity', 'user_id'
    ];

    public function orderItems()
    {
    	return $this->hasMany(OrderFlower::class);
    }

    public function setNameAttribute($value)
    {
    	$this->attributes['name'] = ucwords($value);
    }
}
