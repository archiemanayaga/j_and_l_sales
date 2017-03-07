@extends('layouts.default')

@section('head')
	@parent
	<style>
		.order-item {
			cursor: pointer;
		}
	</style>
@endsection

@section('content')
	@include('includes.header')
	<div class="container order-page">
		<div class="row">
			{{-- Orders List --}}
			<div class="col-sm-8 col-sm-offset-2">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Orders</h3>
					</div>

					<table class="table table-striped table-hover">
						<thead>
							<th>OR No.</th>
							<th>Customer</th>
							<th>Service Name</th>
							<th class="text-right">Service Fee</th>
							<th class="text-right">Total Price</th>
						</thead>
						<tbody>
							@foreach($orderPag as $order)
								<tr class="order-item">
									<td>{{$order->id}}</td>
									<td>{{$order->customer->name}}</td>
									<td>{{$order->service->name}}</td>
									<td class="text-right">{{$order->service_fee}}</td>
									<td class="text-right">{{$order->orderItems->reduce(function($curr, $item) {
											$total = bcmul($item->price, $item->quantity);
											return bcadd($curr, $total);
										}, 0)}}</td>
								</tr>
								<tr class="order-item-detail hidden">
									<td colspan="5">
										<h4>Order Item Details</h4>
										<table class="table">
											<thead>
												<tr>
													<th>#</th>
													<th>Item Name</th>
													<th>Type</th>
													<th>Quantity</th>
													<th>Price</th>
												</tr>
											</thead>
											<tbody>
												@foreach($order->orderItems as $item)
													<tr>
														<td>{{$item->id}}</td>
														<td>
															@if(!is_null($item->flowers))
																{{ $item->flowers->name }}
															@elseif(!is_null($item->accessories))
																{{ $item->accessories->name }}
															@endif
														</td>
														<td>
															@if(!is_null($item->flowers))
																Flower
															@elseif(!is_null($item->accessories))
																Accessory
															@endif
														</td>
														<td>
															{{$item->quantity}}
														</td>
														<td>
															{{$item->price}}
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									</td>
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
	<script>
		$(function() {
			$('.order-item').on('click', function() {
				var $showedDetails = $('tr.order-item-detail.not-hidden');

				if($showedDetails.length > 0) {
					if($(this).next().hasClass('hidden')) {
						$showedDetails.removeClass('not-hidden').addClass('hidden');
						$(this).next().removeClass('hidden').addClass('not-hidden');
					} else {
						$(this).next().removeClass('not-hidden').addClass('hidden');
					}
				} else {
					$(this).next().removeClass('hidden').addClass('not-hidden');
				}
			});
		});
	</script>
@endsection