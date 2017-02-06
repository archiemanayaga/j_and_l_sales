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
			<div class="col-sm-8 col-sm-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Services</h3>
					</div>

					<table class="table">
						<thead>
							<th>Name</th>
							<th>Description</th>
							<th class="text-right">Fee</th>
							<th class="text-right" style="width: 150px;">Action</th>
						</thead>
						<tbody>
							@foreach($services as $service)
								<tr>
									<td>{{$service->name}}</td>
									<td>{{$service->description}}</td>
									<td class="text-right">{{$service->fee}}</td>
									<td class="text-right">
										<div class="btn-group" role="group" aria-label="...">
										  <button type="button" class="btn btn-default" title="edit">
										  	<i class="fa fa-pencil"></i>
										  </button>
										  <button type="button" class="btn btn-default" title="delete">
										  	<i class="fa fa-trash"></i>
										  </button>
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>	
				</div>
			</div>
			
			<div class="col-sm-8 col-sm-offset-2 text-right">
				{{ $services->links() }}
			</div>
		</div>
	</div>
@endsection