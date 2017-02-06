<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

use App\Http\Requests;

class ServiceController extends Controller
{
    public function index()
    {
		//$data['flowers'] = Flower::all();
    	//$data['accessories'] = Accessory::all();
    	$data['services'] = Service::paginate(5);

    	return view('services.index', $data);
    	//return view('orders.index', $data);
    }
}
