<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable = [
        'service_id', 'service_fee',
    ]; 
}
