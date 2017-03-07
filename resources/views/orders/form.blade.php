<form action="/orders/store" method="post" id="ordersForm" role="form"
	@if(session('status') == 'success') class="hidden" @endif>
	{{ csrf_field() }}
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label for="name">Customer Name:</label>
				<input type="text" class="form-control" name="name" id="name" autocomplete="off" required>
                <input type="hidden" class="form-control" name="customer_id" id="customer_id">
			</div>
			<div class="form-group">
				<label for="address">Address:</label>
				<input type="text" class="form-control" name="address" id="address" required>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="phone">Mobile:</label>
				<input type="text" class="form-control" name="phone" id="phone">
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" class="form-control" name="email" id="email">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="panel panel-primary">
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
			<div class="panel panel-primary">
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
					<button type="button" class="btn btn-success btn-block">Save</button>
				</div>
			</form>
		</div>
	</div>
</form>