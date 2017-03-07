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
				<form action="/users" method="get">
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
						<h3 class="panel-title">Users</h3>
					</div>

					<table class="table">
						<thead>
							<th>Name</th>
							<th>Email</th>
							<th>Role</th>
							<th class="text-right">Action</th>
						</thead>
						<tbody>
							@foreach($users as $user)
								<tr>
									<td>{{$user->name}}</td>
									<td>{{$user->email}}</td>
									<td>{{$user->role->name}}</td>
									<td class="text-right">
										<div class="btn-group" role="group" aria-label="...">
										  <a href="#" class="btn btn-default btn-edit" title="edit"
										  data-user-id="{{$user->id}}">
										  	<i class="fa fa-pencil"></i>
										  </a>
										  {{-- <a href="#" data-user-id="{{$user->id}}" class="btn btn-default btn-reset" title="reset password">
										  	<i class="fa fa-refresh"></i>
										  </a> --}}
										  <a href="#" data-user-id="{{$user->id}}" class="btn btn-default btn-delete" title="delete">
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
				{{ $users->links() }}
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
		        <form id="modalForm" action="/users/" method="post">
		        	{{ csrf_field() }}
		        	<input type="hidden" name="_method" value="PUT" disabled>
		        	<input type="hidden" name="id" disabled>
		        	<div class="form-group">
	        			<label for="name" class="control-label">Name:</label>
	        			<input type="text" name="name" id="name" class="form-control">
	        		</div>
		        	<div class="form-group">
	        			<label for="email" class="control-label">Email:</label>
	        			<input type="email" name="email" id="email" class="form-control">
	        		</div>
	        		<div class="form-group">
	        			<label for="role_id" class="label-control">Role:</label>
	        			<select name="role_id" id="role_id" class="form-control">
	        				<option value="">Select Role</option>
	        				@foreach($roles as $role)
	        					<option value="{{ $role->id }}">{{ $role->name }}</option>
	        				@endforeach
	        			</select>
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

		<form action="/users/delete" method="post" class="deleteForm hidden">
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
				$formContainer.find('#newFormLabel').text('Create New User');
				$modalForm.find('input[name=_method]').prop('disabled', true);
				$modalForm.find('input[name=id]').prop('disabled', true).val('');
				$modalForm.find('input[name=name]').val('');
				$modalForm.find('input[name=email]').val('');
				$modalForm.find('select[name=role_id]').val('');
				$modalForm.prop('action', '/users/store');
			});

			$('a.btn-edit').on('click', function(e) {
				e.preventDefault();

				$.ajax({
					url: '/users/edit/' + $(this).data('user-id'),
					type: 'GET',
					success: function(res) {
						if(res.status === 'ok') {
							$modalForm.prop('action', '/users/update');
							$modalForm.find('input[name=_method]').prop('disabled', false);
							$modalForm.find('input[name=id]').prop('disabled', false).val(res.user.id);
							$modalForm.find('input[name=name]').val(res.user.name);
							$modalForm.find('input[name=email]').val(res.user.email).prop('disabled', true);
							$modalForm.find('select[name=role_id]').val(res.user.role_id);
							$formContainer.find('#newFormLabel').text('Update User');
							$formContainer.modal('toggle');
						}
					}
				})
			});

			// $('a.btn-reset').on('click', function(e) {
			// 	e.preventDefault();
			// 	var $confirm = confirm('Are you sure you want to reset the Password?');
			// 	if($confirm === true) {
			// 		$deleteForm.prop('action', '/users/reset')
			// 		$deleteForm.find('input[name=id]').val($(this).data('user-id'));
			// 		$deleteForm.find('input[name=_method]').val('PUT');

			// 		$deleteForm.submit();
			// 	}
			// });

			$('a.btn-delete').on('click', function(e) {
				e.preventDefault();
				var $confirm = confirm('Are you sure you want to Delete?');
				if($confirm === true) {
					$deleteForm.find('input[name=id]').val($(this).data('user-id'));

					$deleteForm.submit();
				}
			});

			$('#newForm').on('shown.bs.modal', function () {
				$modalForm.find('input[name=name]').focus().select();
			});
		});
	</script>
@endsection