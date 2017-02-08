<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use Illuminate\Http\Request;

use App\Http\Requests;

class AccessoryController extends Controller
{
	protected $request;

	public function __construct(Request $request) 
	{
		$this->request = $request;
	}

    public function index()
    {
    	if($this->request->has('search')) {
    		$name = $this->request->get('search');
    		$accessories = Accessory::where('name', 'LIKE', "%$name%")->paginate(5);
    		$accessories->appends($this->request->only('search'));
    	} else {
    		$accessories = Accessory::paginate(5);	
    	}

    	return view('accessories.index', compact('accessories'));
    }
}
