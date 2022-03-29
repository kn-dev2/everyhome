@extends('layouts.frontend')

@section('content')

<div class="row">
		<div class="columns">
			<h3 class="heading">Gift <span>Cards</span></h3>
            <div class="plugin-script">
				<img class="loading" src="{{ asset('frontend/img/loading-buffering.gif') }}" alt="">
				<script src="https://everyhomecleaningservice.launch27.com/jsbundle"></script><iframe id="booking-widget-iframe" src="https://everyhomecleaningservice.launch27.com/giftcards/new?w" style="border:none;width:100%;min-height:1260px;overflow:hidden" scrolling="no"></iframe>
			</div>
		</div>
	</div>
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
