<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

use App\Http\Requests;

class CustomerController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function search()
    {
        $query = $this->request->get('q');
        $customer = Customer::where('name', 'LIKE', "%$query%")->limit(5)->get();

        return [
            'customer' => $customer
        ];
    }
}
