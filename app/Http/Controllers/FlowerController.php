<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use Illuminate\Http\Request;

use App\Http\Requests;

class FlowerController extends Controller
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
    		$flowers = flower::where('name', 'LIKE', "%$name%")->paginate(5);
    		$flowers->appends($this->request->only('search'));
    	} else {
    		$flowers = flower::paginate(5);	
    	}
    	//$data['flowers'] = Flower::paginate(5);
    	
          return view('flowers.index', compact('flowers'));
    	//return view('flowers.index', $data);
    }
}
