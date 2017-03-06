<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class service extends Model
{
     protected $fillable = [
        'name', 'description', 'fee', 'user_id'
    ];

    public function order()
    {
    	return $this->hasMany(OrderFlower::class);
    }
}
