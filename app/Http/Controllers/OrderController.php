<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use App\Models\Accessory;
use Illuminate\Http\Request;

use App\Http\Requests;

class OrderController extends Controller
{

	protected $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

    public function index()
    {
    	$data['flowers'] = Flower::all();
    	$data['accessories'] = Accessory::all();

    	return view('orders.index', $data);
    }

    public function store()
    {
		dd($this->request->all());
    }
}
