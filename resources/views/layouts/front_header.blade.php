<div class="header">
		<div class="row align-middle">
			<div class="large-3 columns logo">
				<a href="{{route('home')}}"><img src="{{ asset('frontend/img/logo.png') }}" alt="" title="" data-aos="fade-right"></a>
			</div>

			<div class="large-9 columns">
				<section class="navigation" data-aos="fade-left">
					<nav class="top-bar" data-topbar role="navigation">
						<ul class="title-area">
							<li class="name"></li>
							<li class="toggle-topbar menu-icon"><a href="#"><span>Show Menu</span></a></li>
						</ul>
						<section class="top-bar-section">
							<ul>
								<li {{ Request::is('home*') ? ' class=current' : null }}><a href="{{route('home')}}">Home</a></li>
								<li {{ Request::is('book-now*') ? ' class=current' : null }}><a href="{{route('book.now')}}">Book Now</a></li>
								<li {{ Request::is('gift-card*') ? ' class=current' : null }}><a href="{{route('gift.card')}}">Gift Cards</a></li>
								<li {{ Request::is('services*') ? ' class=current' : null }}><a href="{{route('services')}}">Services</a></li>
								<li {{ Request::is('hiring*') ? ' class=current' : null }}><a href="{{route('hiring')}}">We're Hiring</a></li>
								@if(Auth::User())
								<li><a href="javascript:void(0)">Profile</a></li>
								<li><a  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>                             
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> 
									@csrf
								</form>
								</li>
								@else
								<li {{ Request::is('login*') ? ' class=current' : null }}><a href="{{route('login')}}">Login</a></li>
								<li {{ Request::is('register*') ? ' class=current' : null }}><a href="{{route('register')}}">Register</a></li>
								@endif
							</ul>
						</section>
					</nav>
				</section><!--class navigation ends-->
			</div>
		</div>
	</div>