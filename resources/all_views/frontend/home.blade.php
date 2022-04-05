@extends('layouts.frontend')

@section('content')
<div class="row banner align-middle">
		<div class="medium-6 columns">
			<div class="banner-text">
				<p>We Provide</p>
				<h3 class="banner-heading">Quality Home Cleaning Services at <strong>Affordable Rates</strong> <span>for Residential Homes, Condos, Apartments, and Vacation Rentals Located in Orange County</span></h3>
				
				<h3 class="sub-heading text-left">Quick &amp; Easy Online Booking!</h3>
				<ol>
					<li>Simply Choose a Cleaning Type - Standard, Deluxe, Deep Clean, or Move Out</li>
					<li>Tell Us About Your Home - Number of Bedrooms &amp; Baths, Date &amp; Time You Would Like Us to Arrive</li>
					<li>Select from Our List of Extra Services to Customize Your Cleaning Experience</li>
					<li>Sit Back &amp; Relax While Our Home Cleaning Experts Do the Rest!</li>
				</ol>

				<a class="button" href="{{route('book.now')}}">Book Now</a>
			</div>
		</div>
		<div class="medium-6 columns banner-image">
			<img src="{{ asset('frontend/img/home-banner.png') }}" alt="" title="" data-aos="fade-left" data-aos-delay="200">
			<div class="members clearfix" data-aos="fade-up">
				<img src="{{ asset('frontend/img/banner-members.png') }}" alt="" title="">
				<strong><span>30+</span> Members</strong>
			</div>
		</div>
	</div><!--class row banner ends-->

    <div class="main-services">
		<div class="container">
			<h3 class="heading">What We <span>Do</span></h3>
			<ul class="small-block-grid-2 medium-block-grid-4">
				@foreach($services as $key=>$singleService)
				@if($singleService->delay ==0)
					<li data-aos="flip-left">
				@else 
					<li data-aos="flip-left" data-aos-delay="{{$singleService->delay}}">
				@endif
					<div class="service-block">
						<img src="{{ asset('frontend/img/services/'.$singleService->icon) }}" alt="" title="">
						<strong>{{$singleService->title}}</strong>
						<a class="button" href="{{route('book.now')}}">Book Now</a>
						<a class="button reverse" href="{{route('services')}}">Learn More</a>
					</div>
				</li>
				<!-- data-aos-delay="200" -->
				@endforeach
				
			</ul>
		</div>
	</div><!--class main-services ends-->


	<div class="clean-gift">
		<div class="row align-middle">
			<div class="medium-6 columns text-center">
				<img class="mb" src="{{ asset('frontend/img/gift-of-clean.png') }}" alt="" title="" data-aos="zoom-in">
			</div>
			<div class="medium-6 columns">
				<h3 class="heading text-left">Give The <span>Gift of Clean!</span></h3>
				<p>Send that special someone in your life a prepaid gift card that can be applied towards any of our cleaning types. Gift cards are delivered via email instantly & make perfect gifts for busy households and folks that just need a helping hand.</p>

				<a class="button" href="{{route('gift.card')}}">Gift Cards</a>
			</div>
		</div><!--class row ends-->
	</div><!--class clean-gift ends-->
	
	<div class="row hiring">
		<h3 class="heading">We’re <span>Hiring</span></h3>
		<div class="large-8 medium-9 columns">
			<div class="hiring-form">
				<div data-aos="fade-down">
                	<h3 class="sub-heading text-left">Join Our Team &amp; Become An EveryHome Cleaning Service Professional!</h3>
					<p>We are always looking for experienced, detail oriented cleaning professionals to join our team. We offer flexible hours, excellent earning potential &amp; weekly bonuses!</p>
                    
                    <p>New to the professional home cleaning industry? We also offer entry-level housekeeping &amp; maid service positions. Receive on-the-job training &amp; learn valuable skills from one of our professional cleaning service experts. Your new career is just a click away!</p>
					
					<div class="text-center"><a class="button" href="{{route('hiring')}}">Apply Now</a></div>
				</div>
			</div><!--class hiring-form ends-->
		</div>
	</div><!--class row hiring ends-->

    <section class="service-area clearfix" data-equalizer>
        <div class="medium-6 large-7 columns google-map" data-equalizer-watch>
            <a href="https://www.google.com/maps/d/edit?mid=1Lt2_qR6qn-fAhIWt6crIhsMvf-0eVsU6&usp=sharing" target="_blank"></a>
        </div>
    
        <div class="medium-6 large-5 columns cities" data-equalizer-watch>
            <h4 class="sub-heading">Our Service Area Includes:</h4>
            <div class="clearfix">
                <div class="small-6 columns">
                    <ul>
                        <li><span>Aliso Viejo, CA</span></li>
                        <li><span>Corona Del Mar, CA</span></li>
                        <li><span>Costa Mesa, CA</span></li>
                        <li><span>Coto de Caza, CA</span></li>
                        <li><span>Dana Point, CA</span></li>
                        <li><span>Foothill Ranch, CA</span></li>
                        <li><span>Irvine, CA</span></li>
                        <li><span>Ladera Ranch, CA</span></li>
                        <li><span>Laguna Beach, CA</span></li>
                        <li><span>Laguna Hills, CA</span></li>
                    </ul>
                </div>
    
                <div class="small-6 columns">
                    <ul>
                        <li><span>Laguna Niguel, CA</span></li>
                        <li><span>Laguna Woods, CA</span></li>
                        <li><span>Lake Forest, CA</span></li>
                        <li><span>Mission Viejo, CA</span></li>
                        <li><span>Newport Beach, CA</span></li>
                        <li><span>Rancho Santa Margarita</span></li>
                        <li><span>San Clemente, CA</span></li>
                        <li><span>San Juan Capistrano, CA</span></li>
                        <li><span>Trabuco Canyon, CA</span></li>
                        <li><span>Tustin, CA</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section><!--class service-area clearfix ends-->

@endsection
