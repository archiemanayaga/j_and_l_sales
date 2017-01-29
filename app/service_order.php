<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class service_order extends Model
{
     protected $fillable = [
        'service_id', 'order_id',
       ];
}
