<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class appointment extends Model
{
	protected $fillable = [
        'customer_id', 'venue', 'status', 'attendedby',
    ];
    
}
