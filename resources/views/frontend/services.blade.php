@extends('layouts.frontend')

@section('content')

<div class="row">
		<div class="large-10 large-push-1 columns">
			<h1 class="heading">The Every Home Cleaning <br><span>Checklist</span></h1>
			
			<p><strong>Learn more about our cleaning types below then Book Now &amp; select from our list of extras to fully customize your cleaning experience!</strong></p>
			
			<p><strong>Standard Clean:</strong> Our 48-point cleaning checklist that includes-Dusting, Wipe Down, Scrubbing, Floor Cleaning, and Finishing Touches for your home</p>
			
			<p><strong>Deluxe Clean:</strong> A 55-point cleaning checklist that includes everything from our Standard Cleaning, plus extended time for areas of focus</p>
			
			<p><strong>Deep Clean:</strong> A 75-point cleaning checklist that includes everything from our Deluxe Cleaning checklist, with even more extended time for areas of focus, as well as additional Deep Cleaning items</p>
			
			<p><strong>Move Out Clean:</strong> A 76-point cleaning checklist that includes everything from our Deep Cleaning checklist, cleaning interior windows within reach, &amp; extra extended time to prepare homes, condo’s, apartments &amp; vacation rentals for new residents to enjoy</p>
		</div>
	</div>
	
	<hr>
	
	<div class="row">
		<div class="columns">
			<h3 class="sub-heading text-left" id="dusting">Dusting <span>Checklist</span></h3>
			<table class="table_style service-list">
				<tr>
					<th>Items</th>
					<th>Standard Clean<br> <a class="button" href="{{route('book.now')}}">Book Now</a></th>
					<th>Deluxe Clean<br> <a class="button" href="{{route('book.now')}}">Book Now</a></th>
					<th>Deep Clean<br> <a class="button" href="{{route('book.now')}}">Book Now</a></th>
					<th>Move Out Clean<br> <a class="button" href="{{route('book.now')}}">Book Now</a></th>
				</tr>
				<tr>
					<td>Vents</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Fans</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Lighting fixtures</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Blinds</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Picture Frames</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Door Frames</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>All Accessible Hard Surfaces</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Shelves</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Furniture</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Tables &amp; Chairs</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>TV’s &amp; Monitors (Except Screens)</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Extended Time For Areas Of Focus</td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Behind Appliances &amp; Wall Units</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
			</table>
			
			
			<h3 class="sub-heading text-left" id="wipe-down">Wipe Down <span>Checklist</span></h3>
			<table class="table_style service-list">
				<tr>
					<th>Items</th>
					<th>Standard Clean<br> <a class="button" href="{{route('book.now')}}">Book Now</a></th>
					<th>Deluxe Clean<br> <a class="button" href="{{route('book.now')}}">Book Now</a></th>
					<th>Deep Clean<br> <a class="button" href="{{route('book.now')}}">Book Now</a></th>
					<th>Move Out Clean<br> <a class="button" href="{{route('book.now')}}">Book Now</a></th>
				</tr>
				<tr>
					<td>All Mirrors &amp; Glass Fixtures</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Window Sills</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>TableTops</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Washer &amp; Dryer</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Under A/C Unit</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Door Frames</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Wastebaskets/Trashcans Exterior Only</td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Kitchen Cabinets-Exterior Only</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Kitchen Counters</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Kitchen Drawers-Exterior Only</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Refrigerator-Incl Top-Exterior Only</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Dishwasher-Exterior Only</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Oven-Exterior Only</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Microwave-Exterior Only</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Toaster</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Bathroom Cabinets-Exterior Only</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Bathroom Shelves-Exterior Only</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Bathroom Counters</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Shower Caddy/Soap Dish</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Shower Door</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Extended Time For Areas Of Focus</td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Behind Appliances &amp; Wall Units</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Shelves</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Blinds</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Leather/Vinyl Furniture</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Wastebaskets/Trash Cans Exterior &amp; Interior</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Kitchen Cabinets-Exterior &amp; Interior</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Kitchen Drawers-Exterior &amp; Interior</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Refrigerator-Incl Top-Exterior &amp; Interior</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Oven-Exterior &amp; Interior Deep Clean</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Microwave-Exterior &amp; Interior Deep Clean</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Bathroom Cabinets-Exterior &amp; Interior</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Bathroom Shelves-Exterior &amp; Interior</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Windows-Interior Only-Within Reach</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
				</tr>
			</table>
			
			
			<h3 class="sub-heading text-left" id="scrubbing">Scrubbing <span>Checklist</span></h3>
			<table class="table_style service-list">
				<tr>
					<th>Items</th>
					<th>Standard Clean<br> <a class="button" href="{{route('book.now')}}">Book Now</a></th>
					<th>Deluxe Clean<br> <a class="button" href="{{route('book.now')}}">Book Now</a></th>
					<th>Deep Clean<br> <a class="button" href="{{route('book.now')}}">Book Now</a></th>
					<th>Move Out Clean<br> <a class="button" href="{{route('book.now')}}">Book Now</a></th>
				</tr>
				<tr>
					<td>Kitchen Sink-If Empty</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Kitchen Sink-Empty &amp; Load Dishwasher</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Stovetop</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Wall Behind Stovetop</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Bathroom Sinks</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Bathroom Tiles</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Shower</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Bathtub</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Toilets</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Extended Time For Areas Of Focus</td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Kitchen Sink-Deep Clean</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Stovetop-Deep Clean</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Bathroom Sinks-Deep Clean</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Bathroom Tiles-Deep Clean</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Shower-Deep Clean</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Bathtub-Deep Clean</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Toilets-Deep Clean</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
			</table>
			
			
			<h3 class="sub-heading text-left" id="floor-cleaning">Floor <span>Cleaning</span></h3>
			<table class="table_style service-list">
				<tr>
					<th>Items</th>
					<th>Standard Clean<br> <a class="button" href="{{route('book.now')}}">Book Now</a></th>
					<th>Deluxe Clean<br> <a class="button" href="{{route('book.now')}}">Book Now</a></th>
					<th>Deep Clean<br> <a class="button" href="{{route('book.now')}}">Book Now</a></th>
					<th>Move Out Clean<br> <a class="button" href="{{route('book.now')}}">Book Now</a></th>
				</tr>
				<tr>
					<td>Sweep Floor</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Dry Mopping</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Vacuum Carpet</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Vacuum Rugs</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Wet Mopping</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Extended Time For Areas Of Focus</td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Baseboards-Wipe Down</td>
					<td><span class="cross"></span></td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
			</table>
			
			
			<h3 class="sub-heading text-left" id="finishing-touches">Finishing <span>Touches</span></h3>
			<table class="table_style service-list">
				<tr>
					<th>Items</th>
					<th>Standard Clean<br> <a class="button" href="{{route('book.now')}}">Book Now</a></th>
					<th>Deluxe Clean<br> <a class="button" href="{{route('book.now')}}">Book Now</a></th>
					<th>Deep Clean<br> <a class="button" href="{{route('book.now')}}">Book Now</a></th>
					<th>Move Out Clean<br> <a class="button" href="{{route('book.now')}}">Book Now</a></th>
				</tr>
				<tr>
					<td>Change Bedding &amp; Make beds</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Vacuum Upholstered Furniture</td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Dryer-Clean Lint Traps</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Empty Trash Cans &amp; Replace Liners</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Tidy Up</td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
				<tr>
					<td>Extended Time For Areas Of Focus</td>
					<td><span class="cross"></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
				</tr>
			</table>
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
