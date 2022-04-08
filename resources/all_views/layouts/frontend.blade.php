<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
    {{ Request::is('home*') ? 'Home ' : '' }}
    {{ Request::is('book-now*') ? 'Book Now ' : '' }}   
    {{ Request::is('gift-card*') ? 'Gift Cards' : '' }}
    {{ Request::is('services*') ? 'Services' : '' }}
    {{ Request::is('hiring*') ? 'Hiring' : '' }}
    - Every Home Cleaning Service
    </title>

    <link rel="stylesheet" href="{{ asset('frontend/css/foundation.min.css')}}" />
	<link rel="stylesheet" href="{{ asset('frontend/css/app.css')}}" />
	
	<link rel="shortcut icon" href="{{ asset('frontend/img/favicon.png') }}" />
	<script src="{{ asset('frontend/js/vendor/modernizr.js') }}"></script>
	    <!-- Fonts -->
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
</head>
<body {{ Request::is('home*') ? ' class=homepage' : null }}>
    <div id="app">
        <!-- Header Start -->
        {{ View::make('layouts/front_header') }}
    <!--class header ends-->
    @yield('content')
    @if(!Request::is('login*') && !Request::is('register*'))
        {{ View::make('layouts/front_footer') }}
    @endif

    </div>
</body>
</html>