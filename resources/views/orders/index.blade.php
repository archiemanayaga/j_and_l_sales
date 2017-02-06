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
		<form action="/orders/save" method="post" id="ordersForm" role="form">
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
													data-flower-id="{{$flower->id}}">
											</td>
											<td>{{$flower->name}}</td>
											<td class="text-right">{{$flower->price}}</td>
											<td>
												<input type="hidden" name="flower.id[]" id="flower_{{$flower->id}}">
												<input type="number" name="flower.quantity[]" 
													id="flowerQuantity{{$flower->id}}" 
													class="form-control text-right" 
													data-flower-id="{{$flower->id}}" value="0">
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
													data-accessory-id="{{$accessory->id}}">
											</td>
											<td>{{$accessory->name}}</td>
											<td class="text-right">{{$accessory->price}}</td>
											<td>
												<input type="hidden" name="accessory.id[]" id="accessory_{{$accessory->id}}">
												<input type="number" name="accessory.quantity[]" 
													id="accessoryQuantity{{$accessory->id}}" 
													class="form-control text-right" 
													data-accessory-id="{{$accessory->id}}" value="0">
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
							<label for="total" class="col-sm-3 control-label total-label">Total:</label>
							<div class="col-sm-5">
								<input type="number" id="total" value="0.00" class="form-control text-right">
							</div>
							<div class="col-sm-4">
								<button class="btn btn-success btn-block">Continue</button>
							</div>
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

			function makeEvent (itemName) {
				var checkboxIName = "input[id^=" + itemName + "Checkbox]";
				var quantityIName = "input[id^=" + itemName + "Quantity]";

				ordersForm.on('change', quantityIName, function () {
					checkedUnchecked($(this), itemName);
				});

				ordersForm.on('click', checkboxIName, function () {
					iQuantittyDefault($(this), itemName);
				});
			}
			
			function checkedUnchecked (iQuantity, itemName) {
				var iCheckbox = $("input#" + itemName + 'Checkbox' + iQuantity.data(itemName + '-id'));

				if(parseFloat(iQuantity.val()) === 0 ||
					iQuantity.val() === '' ||
					parseFloat(iQuantity.val()) < 0) {
					iCheckbox.prop('checked', false);
				} else {
					iCheckbox.prop('checked', true);	
				}
			}

			function iQuantittyDefault (iCheckbox, itemName) {
				var iQuantity = $('input#' + itemName + 'Quantity' + iCheckbox.data(itemName + '-id'));

				if (!iCheckbox.is(':checked')) {
					iQuantity.val('0');
				}
			}

			makeEvent('flower');
			makeEvent('accessory');
		});
	</script>
@endsection