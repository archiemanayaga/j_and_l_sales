<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\Flower;
use App\Models\Order;
use App\Models\OrderFlower;
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
    		->whereBetween('created_at', [$start, $end])
            ->get()
            ->groupBy('flower_id')
            ->map(function($item, $key) {
                $newItem = [];
                $newItem['id'] = $key;
                $newItem['name'] = $item->first()->flowers->name;
                $newItem['price'] = $item->first()->flowers->price;
                $newItem['quantity'] = $item->reduce(function($curr, $flower) {
                    return $curr + floatval($flower->quantity);
                });
                $newItem['total_price'] = $item->reduce(function($curr, $flower) {
                    return $curr + (floatval($flower->quantity) * floatval($flower->price));
                });
                $newItem['orderItems'] = $item->first()->flowers->orderItems;


                return collect($newItem);
            });

        $orderItemsTotal = $orderItems->reduce(function($curr, $item) {
            return $curr + floatval($item['total_price']);
        });

        return view('reports.flower', compact('orderItems', 'orderItemsTotal'));
    }

    public function accessory()
    {
        $start = Carbon::now()->startOfDay();
        $end = Carbon::now()->endOfDay();

        $orderItems = OrderFlower::where('accessory_id', '<>', null)
            ->whereBetween('created_at', [$start, $end])
            ->get()
            ->groupBy('accessory_id')
            ->map(function($item, $key) {
                $newItem = [];
                $newItem['id'] = $key;
                $newItem['name'] = $item->first()->accessories->name;
                $newItem['price'] = $item->first()->accessories->price;
                $newItem['quantity'] = $item->reduce(function($curr, $flower) {
                    return $curr + floatval($flower->quantity);
                });
                $newItem['total_price'] = $item->reduce(function($curr, $flower) {
                    return $curr + (floatval($flower->quantity) * floatval($flower->price));
                });
                $newItem['orderItems'] = $item->first()->accessories->orderItems;


                return collect($newItem);
            });

        $orderItemsTotal = $orderItems->reduce(function($curr, $item) {
            return $curr + floatval($item['total_price']);
        });

        return view('reports.accessory', compact('orderItems', 'orderItemsTotal'));
    }

    public function service()
    {
        $start = Carbon::now()->startOfDay();
        $end = Carbon::now()->endOfDay();

        $orders = Order::whereBetween('created_at', [$start, $end]);
        /*$ordersTotal = $orders->get()->reduce(function($curr, $order) {
            $orderItemsTototal = $order->orderItems->reduce(function($orCurr, $orItem) {
                $total = bcmul($orItem->price, $orItem->quantity);
                return bcadd($orCurr, $total);
            }, $order->service_fee);

            return bcadd($curr, $orderItemsTototal);
        }, 0);*/
        $services = $orders->get()
            ->groupBy('service_id')
            ->map(function($item, $key) {
                $newItem = [];
                $newItem['id'] = $key;
                $newItem['name'] = $item->first()->service->name;
                $newItem['fee'] = $item->first()->service_fee;
                $newItem['quantity'] = $item->count();
                $newItem['total_fee'] = $item->reduce(function($curr, $service) {
                    return $curr + floatval($service->service_fee);
                });
                $newItem['orders'] = $item;
                return collect($newItem);
            });

        $servicesTotal = $services->reduce(function($curr, $item) {
            return $curr + floatval($item['total_fee']);
        });


        return view('reports.service', compact('services', 'servicesTotal'));
    }
}
