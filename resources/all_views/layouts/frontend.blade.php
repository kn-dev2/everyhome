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
  <style>
    #booking_form_loader {
      display: none;
      ;
    }

    input.btn.btn-lg.btn-primary {
      background: #3ac7dd;
      color: white;
      padding: 10px;
      border: 1px solid #3ac7dd;
      font-weight: bold;
      border-radius: 7px;
      cursor: pointer
    }

    .alert.alert-success.background-success {
      background: #008cba;
      padding: 7px;
      line-height: 22px;
      height: 41px;
      margin-bottom: 16px;
      color: white;
    }

    /* Style The Dropdown Button */
    .dropbtn {
      background-color: transparent;
      color: black;
      padding: 16px;
      font-size: 17px !important;
      border: none;
      cursor: pointer;
    }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
      position: relative;
      display: inline-block;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {
      background-color: #f1f1f1
    }

    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {
      display: block;
    }

    /* Change the background color of the dropdown button when the dropdown content is shown */
    .dropdown:hover .dropbtn {
      background-color: #3e8e41;
    }

    .top-bar-section li div.dropdown {
      position: relative !important;
      height: 133px !important;
      width: 136px !important;
      border-top-left-radius: 20px;
      border-bottom-right-radius: 20px;
      padding: 0px 0px;
      font-family: 'Titillium Web', sans-serif;
      font-size: 17px;
      line-height: 20px;
      font-weight: 400;
      text-align: center;
      text-transform: uppercase;
      text-decoration: none;
      color: #1c1c1c;
    }

    .dropdown:hover .dropbtn {
    background: #36d0dc;
    background: -moz-linear-gradient(left, #36d0dc 0%, #5b86e5 100%);
    background: -webkit-linear-gradient(left, #36d0dc 0%,#5b86e5 100%);
    background: linear-gradient(to right, #36d0dc 0%,#5b86e5 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#36d0dc', endColorstr='#5b86e5',GradientType=1 );
}
.dropdown-content a {
    height: 30px;
}
.large-3.columns.logo {
    margin-top: -80px;
}
button.dropbtn:hover {
    background: #36d0dc;
    background: -moz-linear-gradient(left, #36d0dc 0%, #5b86e5 100%);
    background: -webkit-linear-gradient(left, #36d0dc 0%,#5b86e5 100%);
    background: linear-gradient(to right, #36d0dc 0%,#5b86e5 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#36d0dc', endColorstr='#5b86e5',GradientType=1 );
}
  </style>
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