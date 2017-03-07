<div class="row receipt-container">
	<div class="col-sm-4 col-sm-offset-4">
		<div class="receipt-header">
			<h3 class="text-center">J And L Flower Shop</h3>
			<p class="clearfix">
				<span class="pull-left">{{$orders->created_at->toDayDateTimeString()}}</span>
				<span class="pull-right">OR Number: {{$orders->id}}</span>
			</p>
		</div>
		<div class="receipt-body">
			<ul>
				@foreach($orders->orderItems as $item)
				<li>
					<strong>
						@if(!is_null($item->flowers))
							{{ $item->flowers->name }}
						@elseif(!is_null($item->accessories))
							{{ $item->accessories->name }}
						@endif
					</strong>
					<p class="clearfix">
						<span class="pull-left">{{ $item->quantity . ' X ' . floatval($item->price) }}</span>
						<span class="pull-right">{{ bcmul($item->price, $item->quantity) }}</span>
					</p>
				</li>
				@endforeach
				<li>
					<strong>Service Fee</strong>
					<p class="clearfix">
						<span class="pull-left">{{ $orders->service->name }}</span>
						<span class="pull-right">{{ $orders->service->fee }}</span>
					</p>
				</li>
			</ul>
		</div>
		<div class="receipt-footer">
			<p class="clearfix">
				<span class="pull-left"><strong>Total:</strong></span>
				<span class="pull-right">
					<strong>
						{{ $orders->orderItems->reduce(function($curr, $item) {
								$total = bcmul($item->price, $item->quantity);
								return bcadd($curr, $total);
							}, $orders->service->fee)}}
					</strong>
				</span>
			</p>
		</div>
		<div>
			<button class="btn btn-success btn-block btn-back">Continue</button>
		</div>
	</div>
</div>