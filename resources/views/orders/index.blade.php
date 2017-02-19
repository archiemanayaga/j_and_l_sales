@extends('layouts.default')

@section('head')
	@parent
	<style>
		.order-page .panel .panel-body {
			max-height: 345px;
			overflow-x: hidden;
			overflow-y: auto;
		}
		.order-page .total-label {
			padding: 7px 0;
		}
		.btn-add-item {
			margin-top: 24px;
		}
	</style>
@endsection

@section('content')
	@include('includes.header')
	<div class="container order-page">
		<form action="/orders/store" method="post" id="ordersForm" role="form">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-sm-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Flowers</h3>
						</div>
						<div class="panel-body">
							<table class="table">
								<thead>
									<th style="width: 70px;">&nbsp;</th>
									<th>Name</th>
									<th class="text-right">Price</th>
									<th class="text-right" style="width: 150px;">Quantity</th>
								</thead>
								<tbody>
									@foreach($flowers as $flower)
										<tr>
											<td>
												<input type="checkbox"
													id="flowerCheckbox{{$flower->id}}" 
													data-flower-id="{{$flower->id}}"
													class="fc" 
													value="{{$flower->price}}">
											</td>
											<td>{{$flower->name}}</td>
											<td class="text-right">{{$flower->price}}</td>
											<td>
												<input type="hidden" name="flower.id[]" id="flower_{{$flower->id}}" value="{{$flower->id}}">
												<input type="number" name="flower.quantity[]" 
													id="flowerQuantity{{$flower->id}}" 
													class="form-control text-right" 
													data-flower-id="{{$flower->id}}" value="0">
												<input type="hidden" name="flower.price[]"
													value="{{ $flower->price }}">
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>	
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Accessories</h3>
						</div>
						<div class="panel-body">
							<table class="table">
								<thead>
									<th style="width: 70px;">&nbsp;</th>
									<th>Name</th>
									<th class="text-right">Price</th>
									<th class="text-right" style="width: 150px;">Quantity</th>
								</thead>
								<tbody>
									@foreach($accessories as $accessory)
										<tr>
											<td>
												<input type="checkbox"
													id="accessoryCheckbox{{$accessory->id}}"
													data-accessory-id="{{$accessory->id}}"
													class="ac" 
													value="{{$accessory->price}}">
											</td>
											<td>{{$accessory->name}}</td>
											<td class="text-right">{{$accessory->price}}</td>
											<td>
												<input type="hidden" name="accessory.id[]" id="accessory_{{$accessory->id}}" value="{{$accessory->id}}">
												<input type="number" name="accessory.quantity[]" 
													id="accessoryQuantity{{$accessory->id}}" 
													class="form-control text-right" 
													data-accessory-id="{{$accessory->id}}" value="0">
												<input type="hidden" name="accessory.price[]"
													value="{{ $accessory->price }}">
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-sm-offset-6 text-right">
					<form action="">
						<div class="form-group">
							<label for="total" class="col-sm-7 control-label total-label">Total:</label>
							<div class="col-sm-5">
								<input type="number" name="total" id="total" value="0.00" class="form-control text-right" disabled>
							</div>
						</div>
						<div class="form-group">
							<label for="total" class="col-sm-7 control-label total-label">Service:</label>
							<div class="col-sm-5">
								<select name="service_id" id="service_id"
									class="form-control">
									@foreach($services as $service)
										<option value="{{ $service->id }}">{{ $service->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-5 col-sm-offset-7">
							<button class="btn btn-success btn-block">Continue</button>
						</div>
					</form>
				</div>
			</div>
		</form>
	</div>
@endsection

@section('foot')
	@parent
	<script>
		$(function() {
			var ordersForm = $('form#ordersForm');
			var orderTotal = ordersForm.find('input#total');

			function makeEvent (itemName) {
				var checkboxIName = "input[id^=" + itemName + "Checkbox]";
				var quantityIName = "input[id^=" + itemName + "Quantity]";

				ordersForm.on('change', quantityIName, function () {
					checkedUnchecked($(this), itemName);
				});

				ordersForm.on('click', checkboxIName, function () {
					iQuantityDefault($(this), itemName);
				});
			}
			
			function checkedUnchecked (iQuantity, itemName) {
				var itemId = iQuantity.data(itemName + '-id');
				var iCheckbox = $("input#" + itemName + 'Checkbox' + itemId);

				if(parseFloat(iQuantity.val()) === 0 ||
					iQuantity.val() === '' ||
					parseFloat(iQuantity.val()) < 0) {
					iCheckbox.prop('checked', false);
				} else {
					iCheckbox.prop('checked', true);	
				}

				sumItUp();
			}

			function iQuantityDefault (iCheckbox, itemName) {
				var itemId = iCheckbox.data(itemName + '-id');
				var iQuantity = $('input#' + itemName + 'Quantity' + itemId);

				if (!iCheckbox.is(':checked')) {
					iQuantity.val('0');
				}

				sumItUp();
			}

			function sumItUp () {
				var total = 0;

				ordersForm.find('input[type=checkbox]:checked').each(function() {
					var iCheckbox = $(this), itemName, itemId, iQuantity;

					if (iCheckbox.hasClass('ac')) {
						itemName = 'accessory';
					} else {
						itemName = 'flower';
					}

					itemId = iCheckbox.data(itemName + '-id')
					iQuantity = $('input#' + itemName + 'Quantity' + itemId);

					total += parseFloat(iCheckbox.val()) * parseFloat(iQuantity.val());
				});

				orderTotal.val(total.toFixed(2));
			}

			makeEvent('flower');
			makeEvent('accessory');
		});
	</script>
@endsection