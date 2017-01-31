<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use Illuminate\Http\Request;

use App\Http\Requests;

class FlowerController extends Controller
{
    public function index()
    {
    	$data['flowers'] = Flower::paginate(5);
    	

    	return view('flowers.index', $data);
    }
}
