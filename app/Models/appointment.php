<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class appointment extends Model
{
	protected $fillable = [
        'customer_id', 'venue', 'status', 'attendedby', 'user_id'
    ];
    
}
