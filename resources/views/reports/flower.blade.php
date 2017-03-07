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
						<h3 class="panel-title">Flowers</h3>
					</div>

					<table class="table table-striped table-hover">
						<thead>
							<th>#</th>
							<th>Name</th>
							<th class="text-right">Orig Price</th>
							<th class="text-right">Quantity</th>
							<th class="text-right">Total</th>
						</thead>
						<tbody>
							@foreach($orderItems as $order)
								<tr class="order-item">
									<td>{{$order['id']}}</td>
									<td>{{$order['name']}}</td>
									<td class="text-right">{{$order['price']}}</td>
									<td class="text-right">{{$order['quantity']}}</td>
									<td class="text-right">{{$order['total_price']}}</td>
								</tr>
								<tr class="order-item-detail hidden">
									<td colspan="5">
										<h4>Details</h4>
										<table class="table">
											<thead>
												<tr>
													<th>Order Item #</th>
													<th>Quantity</th>
													<th>Price</th>
												</tr>
											</thead>
											<tbody>
												@foreach($order['orderItems']as $item)
													<tr>
														<td>
															{{$item->id}}
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
						Total: {{$orderItemsTotal}}
					</div>
				</div>
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