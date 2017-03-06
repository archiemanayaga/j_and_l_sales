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
	<script>
		$(function() {
			var ordersForm = $('form#ordersForm');
			var orderTotal = ordersForm.find('input#total');

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