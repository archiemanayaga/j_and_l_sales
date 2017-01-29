<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class accessory extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'quantity',
    ];
}
