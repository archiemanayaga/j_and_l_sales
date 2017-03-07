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
							<button class="btn btn-default btn-new" 
								type="button"
								data-toggle="modal"
								data-target="#newForm"><i class="fa fa-file-text"></i></button>
						</span>
					</div>
				</form>
			</div>

			<div class="col-sm-8 col-sm-offset-2">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Flowers</h3>
					</div>

					<table class="table">
						<thead>
							<th>Name</th>
							<th>Description</th>
							<th class="text-right">Price</th>
							<th class="text-right" style="width: 150px;">Action</th>
						</thead>
						<tbody>
							@foreach($flowers as $flower)
								<tr>
									<td>{{$flower->name}}</td>
									<td>{{$flower->description?:'N/A'}}</td>
									<td class="text-right">{{$flower->price}}</td>
									<td class="text-right">
										<div class="btn-group" role="group" aria-label="...">
										  <a href="#" class="btn btn-default btn-edit" title="edit"
										  data-flower-id="{{$flower->id}}">
										  	<i class="fa fa-pencil"></i>
										  </a>
										  <a href="#" data-flower-id="{{$flower->id}}" class="btn btn-default btn-delete" title="delete">
										  	<i class="fa fa-trash"></i>
										  </a>
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

		{{-- Create Accessory Form --}}
		<div class="modal fade form-container" id="newForm" tabindex="-1" role="dialog" aria-labelledby="newFormLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="newFormLabel">Create New Flower</h4>
		      </div>
		      <div class="modal-body">
		        <form id="modalForm" action="/flowers/" method="post">
		        	{{ csrf_field() }}
		        	<input type="hidden" name="_method" value="PUT" disabled>
		        	<input type="hidden" name="id" disabled>
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
		        <button type="button" class="btn btn-success">Save changes</button>
		      </div>
		    </div>
		  </div>
		</div>

		<form action="/flowers/delete" method="post" class="deleteForm hidden">
			{{ csrf_field() }}
			<input type="hidden" name="_method" value="DELETE">
        	<input type="hidden" name="id">
		</form>
		{{-- End --}}
	</div>
@endsection

@section('foot')
	@parent
	<script>
		$(function() {
			var $formContainer = $('.form-container'),
			$modalForm = $formContainer.find('form#modalForm'),
			$deleteForm = $('form.deleteForm');

			$formContainer.on('click', 'button.btn-primary', function() {
				$modalForm.submit();
			});

			$('button.btn-new').on('click', function() {
				$formContainer.find('#newFormLabel').text('Create New Flower');
				$modalForm.find('input[name=_method]').prop('disabled', true);
				$modalForm.find('input[name=id]').prop('disabled', true).val('');
				$modalForm.find('input[name=name]').val('');
				$modalForm.find('input[name=price]').val('');
				$modalForm.find('textarea[name=description]').val('');
				$modalForm.prop('action', '/flowers/store');
			});

			$('a.btn-edit').on('click', function(e) {
				e.preventDefault();

				$.ajax({
					url: '/flowers/edit/' + $(this).data('flower-id'),
					type: 'GET',
					success: function(res) {
						if(res.status === 'ok') {
							$modalForm.prop('action', '/flowers/update');
							$modalForm.find('input[name=_method]').prop('disabled', false);
							$modalForm.find('input[name=id]').prop('disabled', false).val(res.flower.id);
							$modalForm.find('input[name=name]').val(res.flower.name);
							$modalForm.find('input[name=price]').val(res.flower.price);
							$modalForm.find('textarea[name=description]').val(res.flower.description);
							$formContainer.find('#newFormLabel').text('Update Flower');
							$formContainer.modal('toggle');
						}
					}
				})
			});

			$('a.btn-delete').on('click', function(e) {
				e.preventDefault();
				var $confirm = confirm('Are you sure you want to Delete?');
				if($confirm === true) {
					$deleteForm.find('input[name=id]').val($(this).data('flower-id'));

					$deleteForm.submit();
				}
			})
		});
	</script>
@endsection