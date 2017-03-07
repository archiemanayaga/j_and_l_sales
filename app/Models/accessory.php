<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class accessory extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'user_id'
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
