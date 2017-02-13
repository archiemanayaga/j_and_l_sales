<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

use App\Http\Requests;

class ServiceController extends Controller
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
    		$services = service::where('name', 'LIKE', "%$name%")->paginate(5);
    		$services->appends($this->request->only('search'));
    	} else {
    		$services = service::paginate(5);	
    	}
    	
    	return view('services.index', compact('services'));
		//$data['flowers'] = Flower::all();
    	//$data['accessories'] = Accessory::all();
    	//$data['services'] = Service::paginate(5);

    	//return view('services.index', $data);
    	//return view('orders.index', $data);
    }
}
