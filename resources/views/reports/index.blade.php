@extends('layouts.default')

@section('head')
	@parent
@endsection

@section('content')
	@include('includes.header')
	<div class="container order-page">
		<div class="row">
			{{-- Orders List --}}
			<div class="col-sm-8 col-sm-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Orders</h3>
					</div>

					<table class="table">
						<thead>
							<th>OR No.</th>
							<th class="text-right">Service Fee</th>
							<th class="text-right">Total Price</th>
						</thead>
						<tbody>
							@foreach($orderPag as $order)
								<tr>
									<td>{{$order->id}}</td>
									<td class="text-right">{{$order->service_fee}}</td>
									<td class="text-right">{{$order->orderItems->reduce(function($curr, $item) {
											$total = bcmul($item->price, $item->quantity);
											return bcadd($curr, $total);
										}, 0)}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>

					<div class="panel-footer text-right">
						Total: {{$ordersTotal}}
					</div>	
				</div>
			</div>
			
			<div class="col-sm-8 col-sm-offset-2 text-right">
				{{ $orderPag->links() }}
			</div>
		</div>
	</div>
@endsection

@section('foot')
	@parent
@endsection