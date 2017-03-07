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
		@if(session('status') == 'success')
			@php
				$orders = session('order');
			@endphp
			@include('orders.receipt')
		@endif
		@include('orders.form')
	</div>
@endsection

@section('foot')
	@parent
	<script src="{{ asset('assets/js/bootstrap3-typeahead.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.maskinput.min.js') }}"></script>
	<script>
		$(function() {
			var ordersForm = $('form#ordersForm');
			var orderTotal = ordersForm.find('input#total');
			var $name = $('input[name="name"]');
			var $cId = $('input[name="customer_id"]');
			var $address = $('input[name="address"]');
			var $phone = $('input[name="phone"]');
			var $email = $('input[name="email"]');

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

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
					if(parseFloat(iQuantity.val()) > 0) {
						total += parseFloat(iCheckbox.val()) * parseFloat(iQuantity.val());
					}
				});

				orderTotal.val(total.toFixed(2));
			}

			makeEvent('flower');
			makeEvent('accessory');

            $('input[name="phone"]').mask("(999) 999-9999");

			$name.typeahead({
				autoSelect: true,
				source: function (query, process) {
					$.ajax({
						url: '/customers/search',
						data: {q: query},
						dataType: 'json'
					}).done(function(response) {
						console.log(response.customer);
						return process(response.customer);
					});
				}
			});
			$name.change(function() {
				var current = $name.typeahead("getActive");
				if (current) {
					// Some item from your model is active!
					if (current.name == $name.val()) {
						$cId.val(current.id);
						$address.val(current.address);
						$phone.val(current.phone);
						$email.val(current.email);

					} else {
						$cId.val('');
						$address.val('');
						$phone.val('');
						$email.val('');
					}
				} else {
					$cId.val('');
					$address.val('');
					$phone.val('');
					$email.val('');
				}
			});

			if($('.btn-back').length && ordersForm.hasClass('hidden')) {
				$('.btn-back').on('click', function(e) {
					e.preventDefault();
					$('.receipt-container').fadeOut('slow', function() {
						ordersForm.removeClass('hidden');
					});
				})
			}
		});
	</script>
@endsection