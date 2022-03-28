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
	<script>
		AOS.init({});
	</script>
	
	<script type="text/javascript">
		$(window).scroll(function(){
		  var sticky = $('.header'),
			  scroll = $(window).scrollTop();

		  if (scroll >= 100) sticky.addClass('sticky');
		  else sticky.removeClass('sticky');
		});
	</script>
	
	<script type="text/javascript">
	/*--Scroll Back to Top Button Show--*/ 
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('#back-to-top').fadeIn();
		} else {
			$('#back-to-top').fadeOut();
		}
	});     
	//Click event scroll to top button jquery 
	$('#back-to-top').click(function(){
		$('html, body').animate({scrollTop : 0},600);
		return false;
	});     
	</script>
	
	<script>
		jQuery(document).ready(function($){
		  // Get current path and find target link
		  var path = window.location.pathname.split("/").pop();

		  // Account for home page with empty path
		  if ( path == '' ) {
			path = "{{route('home')}}";
		  }

		  var target = $('.top-bar-section li a[href="'+path+'"]');
		  // Add current class to target link
		  target.closest( "li.has-dropdown" ).addClass('current current-parent');
		  target.closest( "li" ).addClass('current');
		});
	</script>
	
	<link rel="stylesheet"  href="{{ asset('frontend/css/lightslider.css') }}"/>
	<script src="{{ asset('frontend/js/lightslider.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.pro-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:5,
                slideMargin: 0,
                speed:500,
                auto:false,
                loop:true,
                onSliderLoad: function() {
                    $('.pro-gallery').removeClass('cS-hidden');
                }  
            });
			
			$('.review-slider').lightSlider({
                item:3,
				slideMargin:120,
				slideMove: 1,
                speed:1000,
				pause:3000,
                auto:true,
                loop:true,
				pager:true,
				responsive : [
					{breakpoint:1281,
						settings: {
							item:2,
							slideMargin:50
						  }
					}, 
					{breakpoint:800,
						settings: {
							item:2,
							slideMargin:30
						  }
					},
					{breakpoint:550,
						settings: {
							item:1,
							slideMargin:10
						  }
					}
				]
            });
		});
	</script>