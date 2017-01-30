<?php

namespace App\Http\Controllers;

use App\Flower;
use App\Accessory;
use Illuminate\Http\Request;

use App\Http\Requests;

class OrderController extends Controller
{
    public function index()
    {
    	$data['flowers'] = Flower::all();
    	$data['accessories'] = Accessory::all();

    	return view('orders.index', $data);
    }
}
