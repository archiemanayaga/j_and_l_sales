<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\Flower;
use App\Models\Order;
use App\Models\OrderFlower;
use App\Models\Service;
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
        $data['accessories'] = Accessory::all();
    	$data['flowers'] = Flower::all();
        $data['services'] = Service::all();

    	return view('orders.index', $data);
    }

    public function store()
    {
        $arFlowersId = $this->request->get('flower_id');
        $arFlowersQuantity = array_filter($this->request->get('flower_quantity'), function($val) {
            return $val != '0';
        });
        $arFlowersPrice = $this->request->get('flower_price');
        $arAccessoriesId = $this->request->get('accessory_id');
        $arAccessoriesQuantity = array_filter($this->request->get('accessory_quantity'), function($value) {
            return $value != '0';
        });
        $arAccessoriesPrice = $this->request->get('accessory_price');

        $service = Service::find($this->request->get('service_id'));

        $order = Order::create([
            'service_id' => $service->id,
            'service_fee' => $service->fee
        ]);

        $this->storeOrderItems('flower', $order->id, [
            'quantities' => $arFlowersQuantity,
            'ids' => $arFlowersId,
            'prices' => $arFlowersPrice
        ]);

        $this->storeOrderItems('accessory', $order->id, [
            'quantities' => $arAccessoriesQuantity,
            'ids' => $arAccessoriesId,
            'prices' => $arAccessoriesPrice
        ]);

        return back();
    }

    private function storeOrderItems($model, $orderId, $data)
    {
        foreach ($data['quantities'] as $key => $quantity) {
            $id = $data['ids'][$key];
            $price = $data['prices'][$key];

            $orderItem = [
                'order_id' => $orderId,
                'price' => $price,
                'quantity' => $quantity
            ];

            if($model == 'flower') {
                $orderItem['flower_id'] = $id;
            } else {
                $orderItem['accessory_id'] = $id;
            }

            OrderFlower::create($orderItem);
        }
    }
}
