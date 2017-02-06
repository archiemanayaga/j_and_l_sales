<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use Illuminate\Http\Request;

use App\Http\Requests;

class AccessoryController extends Controller
{
    public function index()
    {
    	$data['accessories'] = Accessory::paginate(5);
    	

    	return view('accessories.index', $data);
    	//return "hai zianne";
    }
}
