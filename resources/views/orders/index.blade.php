@extends('layouts.default')

@section('head')
	@parent
	<style>
		.btn-add-item {
			margin-top: 24px;
		}
	</style>
@endsection

@section('content')
	@include('includes.header')
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<form action="" class="horizontal">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="item">Item:</label>
							<input type="text" id="item" name="item" class="form-control">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="amount">Amount:</label>
							<input type="text" id="amount" name="amount" class="form-control">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="quantity">Quantity:</label>
							<input type="text" id="quantity" name="quantity" class="form-control">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<button class="btn btn-info btn-block btn-add-item">Add Item</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-sm-12">
				<div class="well">
					
				</div>
			</div>
		</div>
	</div>
@endsection