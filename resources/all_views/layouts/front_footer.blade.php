<footer>
	<div class="row">
		<div class="medium-6 columns">
			&copy; 2021 | Every Home Cleaning Service
		</div>
		<div class="medium-6 columns">
			<a href="#">Privacy Policy</a> <a href="#">Terms &amp; Conditions</a>
		</div>
	</div>
</footer>

<a id="back-to-top" href="#"><img src="{{ asset('frontend/img/arrow-top.png') }}" alt="" /></a>

<script src="{{ asset('frontend/js/vendor/jquery.js') }}"></script>
<script src="{{ asset('frontend/js/foundation.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link media="screen" rel="stylesheet" type="text/css" href="{{ asset('frontend/css/jquery.toast.css') }}" />
<script type="text/javascript" src="{{ asset('frontend/js/jquery.toast.js') }}"></script>

<script>
	$(document).foundation({
		orbit: {
			animation: 'fade',
			timer_speed: 2000,
			pause_on_hover: true,
			resume_on_mouseout: true,
			animation_speed: 1000,
			navigation_arrows: false,
			bullets: true
		}
	});
</script>

<link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}">
<script src="{{ asset('frontend/js/aos.js') }}"></script>
<script src="{{ asset('frontend/js/loadingoverlay.js') }}"></script>
<script>
	AOS.init({});
</script>

<script type="text/javascript">
	$(window).scroll(function() {
		var sticky = $('.header'),
			scroll = $(window).scrollTop();

		if (scroll >= 100) sticky.addClass('sticky');
		else sticky.removeClass('sticky');
	});
</script>

<script type="text/javascript">
	/*--Scroll Back to Top Button Show--*/
	$(window).scroll(function() {
		if ($(this).scrollTop() > 100) {
			$('#back-to-top').fadeIn();
		} else {
			$('#back-to-top').fadeOut();
		}
	});
	//Click event scroll to top button jquery 
	$('#back-to-top').click(function() {
		$('html, body').animate({
			scrollTop: 0
		}, 600);
		return false;
	});
</script>

<script>
	jQuery(document).ready(function($) {
		// Get current path and find target link
		var path = window.location.pathname.split("/").pop();

		// Account for home page with empty path
		if (path == '') {
			path = "{{route('home')}}";
		}

		var target = $('.top-bar-section li a[href="' + path + '"]');
		// Add current class to target link
		target.closest("li.has-dropdown").addClass('current current-parent');
		target.closest("li").addClass('current');
	});
</script>

<link rel="stylesheet" href="{{ asset('frontend/css/lightslider.css') }}" />
<script src="{{ asset('frontend/js/lightslider.js') }}"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.pro-gallery').lightSlider({
			gallery: true,
			item: 1,
			thumbItem: 5,
			slideMargin: 0,
			speed: 500,
			auto: false,
			loop: true,
			onSliderLoad: function() {
				$('.pro-gallery').removeClass('cS-hidden');
			}
		});

		$('.review-slider').lightSlider({
			item: 3,
			slideMargin: 120,
			slideMove: 1,
			speed: 1000,
			pause: 3000,
			auto: true,
			loop: true,
			pager: true,
			responsive: [{
					breakpoint: 1281,
					settings: {
						item: 2,
						slideMargin: 50
					}
				},
				{
					breakpoint: 800,
					settings: {
						item: 2,
						slideMargin: 30
					}
				},
				{
					breakpoint: 550,
					settings: {
						item: 1,
						slideMargin: 10
					}
				}
			]
		});
	});

	$('.check_options').click(function() {
		let id = $(this).val();
		if ($(this).is(":checked")) {

			var ExtraServiceTitle = $('label[for="extra_service' + id + '"] p').text();

			var ExtraServicePrice = $('label[for="extra_service' + id + '"] p').attr('data-price');

			var SubTotal = $('.sub-total-value').text().replace('$', '');

			var qty = $('#extra_service_qty' + id).val();

			if (qty == undefined) {
				var TotalExtraServicePrice = parseInt(ExtraServicePrice);

			} else {

				var TotalExtraServicePrice = parseInt(qty) * parseInt(ExtraServicePrice);

			}

			var Total = parseInt(SubTotal) + parseInt(TotalExtraServicePrice);

			$('.home_sub_type_class').append('<li class="extra_service_list" id="extra_service' + id + '"><span>' + ExtraServiceTitle + '</span> - <b>$' + ExtraServicePrice + '</b></li>');
			$('.sub-total-value').text('$' + Total);
			$('.final-price-value').text('$' + Total);
			$('.home_sub_type_class').show();

			$(".qty_" + id).css('display', 'block');
		} else {

			var qty = $('#extra_service_qty' + id).val();

			var ExtraServicePrice = $('label[for="extra_service' + id + '"] p').attr('data-price');

			if (qty == undefined) {
				var TotalExtraServicePrice = parseInt(ExtraServicePrice);

			} else {

				var TotalExtraServicePrice = parseInt(qty) * parseInt(ExtraServicePrice);

			}

			var SubTotal = $('.sub-total-value').text().replace('$', '');

			var Total = parseInt(SubTotal) - parseInt(TotalExtraServicePrice);

			$('.sub-total-value').text('$' + Total);

			$('.final-price-value').text('$' + Total);
			$('.home_sub_type_class').show();
			$('#extra_service_qty' + id).val(1);

			$(".qty_" + id).css('display', 'none');
			$('.home_sub_type_class #extra_service' + id).remove();

		}
	});

	$(".select_extras input[type='number']").bind('keyup mouseup', function() {
		var qty = $(this).val();
		var ID = $(this).attr('id');
		var SingleValue = $('label[for="extra_service' + ID.match(/\d+/) + '"] p').attr('data-price');

		var MultiValue = qty <= 1 ? qty * SingleValue : qty * SingleValue + '(' + qty + ')';
		var SubTotal = $('.sub-total-value').text().replace('$', '');
		var Total = parseInt(SubTotal) + parseInt(MultiValue);


		var HomeTypePrice = $('.home_type_class_price').text().replace('$', '');
		var HomeSubTypePrice = $('.home_sub_type_price').text().replace('$', '');

		$('#extra_service' + ID.match(/\d+/) + ' b').text('$' + MultiValue);

		var ExtraServicesum = 0;
		$('.extra_service_list b').each(function(i, obj) {
			//test
			var extraServiceValue = $(this).text();
			var EValue = extraServiceValue.match(/\d+/);
			ExtraServicesum += parseInt(EValue[0]);
		});

		if (HomeSubTypePrice == undefined || HomeSubTypePrice == '') {
			var TotalValue = parseInt(HomeTypePrice) + parseInt(ExtraServicesum);

		} else {

			var TotalValue = parseInt(HomeTypePrice) + parseInt(HomeSubTypePrice) + parseInt(ExtraServicesum);

		}
		$('.sub-total-value').text('$' + TotalValue);
		$('.final-price-value').text('$' + TotalValue);

		// console.log(MultiValue);
		if (qty > 10000) {
			$(this).val(10000);
		}
	});

	$('#dt2 ,#date').datepicker({
		dateFormat: "mm/dd/yy",
		minDate: 0,
		beforeShowDay: $.datepicker.noWeekends,
		onSelect: function(date, instance) {
			var selectDate = $(this).datepicker('getDate');
			$('.service_date_summary').html(date);
			// console.log($(".select_time_slot").val());
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});
			jQuery.ajax({
				url: "{{ route('ajax.time.slots') }}",
				method: 'get',
				data: {
					date: date
				},
				type: 'html',
				success: function(result) {
					$('#time_slot').html(result);
				}
			});
		},
	});
	$("#time_slot").on('change', function() {
		$('input[name="time_slot"]').val($(this).val());
	});

	// function Options(value)
	// {
	// 	$.each(value, function(i, v) {
	// 		return '<OPTION LABEL="'+v.maid_id+'">'+v.maid_id+'</OPTION>';
	// 	});
	// }

	$(".select_time_slot").on('change', function() {
		var id = $(this).val();
		var result = id.split('#');
		var date = new Date(result[0]);
		// var newDate = date.toString('d-M-y');
		var dt2 = $('#date');
		var startDate = dt2.datepicker('setDate', date);
		$('.service_date_summary').html(result[0] + ' @ ' + result[2]);
		// alert(newDate);
		return false;
	})

	$("input[name='schedule_type']").on('change', function() {
		var cValue = $(this).val();
		$('.frequency_summary').html(cValue);
	})

	$("select[name='home_type']").on('change', function() {
		var cValue = $(this).val();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});
		jQuery.ajax({
			url: "{{ route('ajax.home_type.data') }}",
			method: 'GET',
			data: {
				home_type: cValue
			},
			type: 'json',
			success: function(result) {
				var HomeTypeResponse = result.home_type_details;
				var home_sub_type_dropdown = result.home_sub_type_dropdown;
				var single_home_sub_type = result.single_home_sub_type;

				$('.home_type_class').html(HomeTypeResponse.title);
				$('.home_type_class_price').html('$' + HomeTypeResponse.price);
				var HomeTypePrice = HomeTypeResponse.price;
				var HomeSubTypePrice = single_home_sub_type.price;

				var Options = '';
				$('.home_sub_type select[name="home_sub_type"]').empty();
				$.each(home_sub_type_dropdown, function(key, val) {
					Options += '<option value="' + val.id + '">' + val.title + '</option>'
				});

				$('.home_sub_type select[name="home_sub_type"]').html(Options);
				$('.home_sub_type').show(500);

				if (HomeSubTypePrice) {
					var TotalAmount = parseInt(HomeTypePrice) + parseInt(HomeSubTypePrice);

				} else {
					var TotalAmount = parseInt(HomeTypePrice);

				}

				if (single_home_sub_type) {
					$('.home_sub_type_class .home_sub_type_added span').empty().append(single_home_sub_type.title);
					$('.home_sub_type_class .home_sub_type_price').empty().append('$' + single_home_sub_type.price);
					$('.home_sub_type_added').show();
					$('.home_sub_type_class').show();
					$('.home_sub_type_added span').show();
					$('.home_sub_type_price').show();
					$('.sub-total-value').html('$' + TotalAmount);
					$('.final-price-value').html('$' + TotalAmount);

				} else {

					$('.home_sub_type').hide();
					$('.home_sub_type_class').hide();
					$('.home_sub_type_added').hide();
					$('.home_sub_type_added span').hide().empty();
					$('.home_sub_type_price').hide().empty();
					$('.sub-total-value').html('$' + TotalAmount);
					$('.final-price-value').html('$' + TotalAmount);

				}


			}
		});
	})

	$("select[name='home_sub_type']").on('change', function() {
		var cSubValue = $(this).val();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});

		jQuery.ajax({
			url: "{{ route('ajax.home_sub_type.data') }}",
			method: 'GET',
			data: {
				home_sub_type: cSubValue
			},
			type: 'json',
			success: function(result) {

				var HomeSubTypeResponse = result.home_sub_type_details;

				if ($(".home_sub_type_class").hasClass("extra_service_list")) {
					var HomeTypePrice = $('.sub-total-value').html().replace('$', '');

				} else {
					var HomeTypePrice = $('.home_type_class_price').html().replace('$', '');
				}

				if (HomeSubTypeResponse) {
					var TotalAmount = parseInt(HomeTypePrice) + parseInt(HomeSubTypeResponse.price);

				} else {
					var TotalAmount = parseInt(HomeTypePrice);

				}

				if (HomeSubTypeResponse) {
					var service_duration = result.Hours + " Hours " + result.Minutes + " Minutes";
					$('.service_duration').text(service_duration);
					$('.home_sub_type_class .home_sub_type_added span').empty().append(HomeSubTypeResponse.title);
					$('.home_sub_type_class .home_sub_type_price').empty().append('$' + HomeSubTypeResponse.price);
					$('.home_sub_type_added').show();
					$('.home_sub_type_class').show();
					$('.home_sub_type_added span').show();
					$('.home_sub_type_price').show();
					$('.sub-total-value').html('$' + TotalAmount);
					$('.final-price-value').html('$' + TotalAmount);

				} else {
					$('.service_duration').text('');
					$('.home_sub_type').hide();
					$('.home_sub_type_class').hide();
					$('.home_sub_type_added').hide();
					$('.home_sub_type_added span').hide().empty();
					$('.home_sub_type_price').hide().empty();
					$('.sub-total-value').html('$' + TotalAmount);
					$('.final-price-value').html('$' + TotalAmount);

				}

			}
		});
	})

	$('#Boooking-form select[name="service_id"]').on('change', function() {
		var CurrentValue = $(this).val();
		var url = "{{route('book.now','service_id=:id')}}";
		url = url.replace(':id', CurrentValue);
		window.location.href = url;
	})

	var handler = StripeCheckout.configure({
		key: "{{env('STRIPE_KEY')}}",
		image: "{{env('STRIPE_IMAGE_URL')}}",
		token: function(token) {
			$('#stripeToken').val(token.id);
			$('#stripeEmail').val(token.email);
			var FinalAmount = $(".final-price-value").text().replace('$', '');
			var amountInCents = Math.floor(FinalAmount * 100);
			$('#amountInCents').val(amountInCents);

			$('#booking_form_submit').hide();
			$('#booking_form_loader').show();

			$.LoadingOverlay("show");
			jQuery.ajax({
				url: "{{ route('ajax.book.order.now') }}",
				method: 'POST',
				data: $('#Boooking-form').serialize(),
				type: 'json',
				success: function(result) {
					if (result.status == false) {

						$('#booking_form_submit').show();
						$('#booking_form_loader').hide();

						ToastMessage(result.message, 'Warning', 'warning');
						$.LoadingOverlay("hide");

					} else {

						ToastMessage(result.message, 'Success', 'success');
						$('#booking_form_submit').prop('disabled', true);
						$('#booking_form_submit').hide();
						$('#booking_form_loader').show();
						$.LoadingOverlay("hide");

						// Your delay in milliseconds
						var delay = 2000;
						setTimeout(function() {
							window.location.href = result.url
						}, delay);
					}
				}
			});
		},
		closed: function() {
			$('#booking_form_submit').show();
			$('#booking_form_loader').hide();
		}
	});

	// Close Checkout on page navigation
	$(window).on('popstate', function() {
		handler.close();
	});

	$("#Boooking-form button#booking_form_submit").click(function(e) {
		e.preventDefault();
		// $("#Boooking-form").submit();
		$.LoadingOverlay("show");
		$('#booking_form_submit').hide();
		$('#booking_form_loader').show();
		jQuery.ajax({
			url: "{{ route('ajax.book.order.validate') }}",
			method: 'POST',
			data: $('#Boooking-form').serialize(),
			type: 'json',
			success: function(result) {
				$.LoadingOverlay("hide");
				$('.invalid-feedback').empty();
				

				var GetErrors = result.errors;
				var Message = result.message;
				if (result.status == false) {

					$('#booking_form_submit').show();
					$('#booking_form_loader').hide();

					if(GetErrors !== undefined)
					{

						var AllFields = [];
						$.each(GetErrors, function(i, v) {
							var res = v.join(',');
							$("#" + i + '_error').text(res);
							AllFields.push(i);
						});

						$.each(AllFields.reverse(), function(index, value) {
							// focus of each required input
							document.getElementById(value).focus();
						});
					} else {

						ToastMessage(result.message, 'Warning', 'warning');
					}

				} else {

					e.preventDefault();
					$('#booking_form_submit').hide();
					$('#booking_form_loader').show();

					var FinalAmount = $(".final-price-value").text().replace('$', '');
					var amountInCents = Math.floor(FinalAmount * 100);
					var displayAmount = parseFloat(Math.floor(FinalAmount * 100) / 100).toFixed(2);
					// Open Checkout with further options
					handler.open({
						name: "{{env('APP_NAME')}}",
						description: 'Booking amount ($' + displayAmount + ')',
						amount: amountInCents,
						email: $('#email').val(),
						payment_method_types: "card"
					});

				}
			}
		});
	});


	$("#Boooking-form button#discount_code_apply").click(function(e) {
		e.preventDefault();
		jQuery.ajax({
			url: "{{ route('ajax.check.discount.code') }}",
			method: 'POST',
			data: {
				"_token": "{{ csrf_token() }}",
				discount_code: $('input[name="discount_code"]').val()
			},
			type: 'json',
			success: function(result) {

				var GetErrors = result.errors;
				var Message = result.message;
				if (result.status == false) {
					ToastMessage(GetErrors, 'Errors', 'warning');
				} else {
					var Data = result.data;
					console.log(Data);
					$('.discount-value').text('$' + Data.amount);
					var SubTotal = $('.sub-total-value').html().replace('$', '');
					var DiscountCalculate = parseInt(SubTotal) - parseInt(Data.amount);
					$('.sub-total-value').html('$' + DiscountCalculate);
					$('.final-price-value').html('$' + DiscountCalculate);
					$('input[name="discount_code"]').attr('readonly', true);
					$('#discount_code_apply').attr('disabled', true);
					ToastMessage(Message, 'Success', 'success');
				}

			}
		});
	});

	function ToastMessage(message, heading, icon) {
		return $.toast({
			text: message, // Text that is to be shown in the toast
			heading: heading, // Optional heading to be shown on the toast
			icon: icon, // Type of toast icon
			showHideTransition: 'fade', // fade, slide or plain
			allowToastClose: true, // Boolean value true or false
			hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
			stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
			position: 'bottom-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values										
			textAlign: 'left', // Text alignment i.e. left, right or center
			loader: true, // Whether to show loader or not. True by default
			loaderBg: '#9EC600', // Background color of the toast loader
			beforeShow: function() {}, // will be triggered before the toast is shown
			afterShown: function() {}, // will be triggered after the toat has been shown
			beforeHide: function() {}, // will be triggered before the toast gets hidden
			afterHidden: function() {} // will be triggered after the toast has been hidden
		})
	}

</script>