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
											   data-accessory-id="{{$flower->id}}"
											   data-accessory-price="{{$flower->price}}">
										</td>
										<td>{{$flower->name}}</td>
										<td class="text-right">{{$flower->price}}</td>
										<td>
											<input type="number" class="form-control text-right" value="0">
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
												   data-accessory-id="{{$accessory->id}}"
												   data-accessory-price="{{$accessory->price}}">
										</td>
										<td>{{$accessory->name}}</td>
										<td class="text-right">{{$accessory->price}}</td>
										<td>
											<input type="number" class="form-control text-right" value="0">
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
	</div>
@endsection