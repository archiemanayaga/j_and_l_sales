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

			<div class="col-sm-4 col-sm-offset-6 text-right" style="margin-bottom: 10px;">
				<form action="/flowers" method="get">
					<div class="input-group">
						<input type="text" name="search" class="form-control" value="{{ request()->get('search') }}" placeholder="Search flower">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							<button class="btn btn-default" 
								type="button"
								data-toggle="modal"
								data-target="#newForm"><i class="fa fa-file-text"></i></button>
						</span>
					</div>
				</form>
			</div>

			<div class="col-sm-8 col-sm-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Flowers</h3>
					</div>

					<table class="table">
						<thead>
							<th>Name</th>
							<th>Description</th>
							<th class="text-right">Price</th>
							<th class="text-right" style="width: 150px;">Quantity</th>
							<th class="text-right" style="width: 150px;">Action</th>
						</thead>
						<tbody>
							@foreach($flowers as $flower)
								<tr>
									<td>{{$flower->name}}</td>
									<td>{{$flower->description}}</td>
									<td class="text-right">{{$flower->price}}</td>
									<td class="text-right">
										{{$flower->quantity}}
									</td>
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
				{{ $flowers->links() }}
			</div>
		</div>

		<div class="modal fade" id="newForm" tabindex="-1" role="dialog" aria-labelledby="newFormLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="newFormLabel">Create New flower</h4>
		      </div>
		      <div class="modal-body">
		        <form action="/accessories/store" method="post">
		        	<div class="col-sm-6">
		        		<div class="form-group">
		        			<label for="name" class="control-label">Name:</label>
		        			<input type="text" name="name" id="name" class="form-control">
		        		</div>
		        	</div>
		        	<div class="col-sm-6">
		        		<div class="form-group">
		        			<label for="price" class="control-label">Price:</label>
		        			<input type="number" name="price" id="price" class="form-control text-right">
		        		</div>
		        	</div>
		        	<div class="col-sm-12">
		        		<div class="form-group">
		        			<label for="description" class="label-control">Description:</label>
		        			<textarea name="description" id="description" class="form-control" cols="30" rows="3"></textarea>
		        		</div>
		        	</div>
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary">Save changes</button>
		      </div>
		    </div>
		  </div>
		</div>

	</div>
@endsection