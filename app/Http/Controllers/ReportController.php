<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\Flower;
use App\Models\Order;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class ReportController extends Controller
{
    public function index()
    {
    	$start = Carbon::now()->startOfDay();
    	$end = Carbon::now()->endOfDay();

    	$orders = Order::whereBetween('created_at', [$start, $end]);
    	$ordersTotal = $orders->get()->reduce(function($curr, $order) {
    		$orderItemsTototal = $order->orderItems->reduce(function($orCurr, $orItem) {
    			$total = bcmul($orItem->price, $orItem->quantity);
    			return bcadd($orCurr, $total);
    		}, $order->service_fee);

    		return bcadd($curr, $orderItemsTototal);
    	}, 0);

    	$orderPag = $orders->orderBy('id', 'desc')->paginate(10);

    	return view('reports.index', compact('orderPag', 'ordersTotal'));
    }

    public function flower()
    {
    	$start = Carbon::now()->startOfDay();
    	$end = Carbon::now()->endOfDay();

    	$orderItems = OrderFlower::where('flower_id', '<>', null)
    		->whereBetween('created_at', [$start, $end]);
    }
}
