<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class flower extends Model
{
     protected $fillable = [
        'name', 'description', 'price', 'quantity',
    ];
}
