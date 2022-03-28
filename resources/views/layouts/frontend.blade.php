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
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Titillium+Web:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

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