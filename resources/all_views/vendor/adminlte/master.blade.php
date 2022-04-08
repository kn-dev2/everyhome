<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Custom Meta Tags --}}
    @yield('meta_tags')

    {{-- Title --}}
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 3'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>

    {{-- Custom stylesheets (pre AdminLTE) --}}
    <style>
        .brand-link {
            background: white;
        }

        [class*=sidebar-dark] .brand-link,
        [class*=sidebar-dark] .brand-link .pushmenu {
            color: rgb(53 58 64) !important;
        }


        .mytooltip {
            display: inline;
            position: relative;
            z-index: 999
        }

        .mytooltip .tooltip-item {
            background: rgba(0, 0, 0, 0.1);
            cursor: pointer;
            display: inline-block;
            font-weight: 500;
            padding: 0 10px
        }

        .mytooltip .tooltip-content {
            position: absolute;
            z-index: 9999;
            width: 360px;
            left: 50%;
            margin: 0 0 20px -180px;
            bottom: 100%;
            text-align: left;
            font-size: 14px;
            line-height: 30px;
            -webkit-box-shadow: -5px -5px 15px rgba(48, 54, 61, 0.2);
            box-shadow: -5px -5px 15px rgba(48, 54, 61, 0.2);
            background: #2b2b2b;
            opacity: 0;
            cursor: default;
            pointer-events: none
        }

        .mytooltip .tooltip-content::after {
            content: '';
            top: 100%;
            left: 50%;
            border: solid transparent;
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-color: #2a3035 transparent transparent;
            border-width: 10px;
            margin-left: -10px
        }

        .mytooltip .tooltip-content img {
            position: relative;
            height: 140px;
            display: block;
            float: left;
            margin-right: 1em
        }

        .mytooltip .tooltip-item::after {
            content: '';
            position: absolute;
            width: 360px;
            height: 20px;
            bottom: 100%;
            left: 50%;
            pointer-events: none;
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%)
        }

        .mytooltip:hover .tooltip-item::after {
            pointer-events: auto
        }

        .mytooltip:hover .tooltip-content {
            pointer-events: auto;
            opacity: 1;
            -webkit-transform: translate3d(0, 0, 0) rotate3d(0, 0, 0, 0);
            transform: translate3d(0, 0, 0) rotate3d(0, 0, 0, 0)
        }

        .mytooltip:hover .tooltip-content2 {
            opacity: 1;
            font-size: 18px
        }

        .mytooltip:hover .tooltip-content2 i {
            opacity: 1;
            font-size: 18px
        }

        .mytooltip:hover .tooltip-content2 {
            opacity: 1;
            font-size: 18px;
            pointer-events: auto;
            -webkit-transform: translate3d(0, 0, 0) scale3d(1, 1, 1);
            transform: translate3d(0, 0, 0) scale3d(1, 1, 1)
        }

        .mytooltip:hover .tooltip-content2 i {
            opacity: 1;
            font-size: 18px;
            pointer-events: auto;
            -webkit-transform: translate3d(0, 0, 0) scale3d(1, 1, 1);
            transform: translate3d(0, 0, 0) scale3d(1, 1, 1)
        }

        .mytooltip:hover .tooltip-item2 {
            color: #fff;
            -webkit-transform: translate3d(0, -0.9em, 0);
            transform: translate3d(0, -0.9em, 0)
        }

        .mytooltip:hover .tooltip-text3 {
            -webkit-transition-delay: 0s;
            transition-delay: 0s;
            -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1)
        }

        .mytooltip:hover .tooltip-content3 {
            opacity: 1;
            pointer-events: auto;
            -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1)
        }

        .mytooltip:hover .tooltip-content4 {
            pointer-events: auto;
            opacity: 1;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0)
        }

        .mytooltip:hover .tooltip-text2 {
            pointer-events: auto;
            opacity: 1;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0)
        }

        .mytooltip:hover .tooltip-inner2 {
            -webkit-transition-delay: 0.3s;
            transition-delay: 0.3s;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0)
        }

        .mytooltip:hover .tooltip-content5 {
            opacity: 1;
            pointer-events: auto;
            -webkit-transition-delay: 0s;
            transition-delay: 0s
        }

        .mytooltip .tooltip-text {
            font-size: 14px;
            line-height: 24px;
            display: block;
            padding: 1.31em 1.21em 1.21em 0;
            color: #fff
        }

        .mytooltip .tooltip-item2 {
            color: #01a9ac;
            cursor: pointer;
            z-index: 100;
            position: relative;
            display: inline-block;
            font-weight: 700;
            font-size: 14px;
            -webkit-transition: background-color 0.3s, color 0.3s, -webkit-transform 0.3s;
            transition: background-color 0.3s, color 0.3s, -webkit-transform 0.3s;
            transition: background-color 0.3s, color 0.3s, transform 0.3s;
            transition: background-color 0.3s, color 0.3s, transform 0.3s, -webkit-transform 0.3s
        }

        .tooltip.tooltip-effect-2:hover .tooltip-content {
            -webkit-transform: perspective(1000px) rotate3d(1, 0, 0, 0deg);
            transform: perspective(1000px) rotate3d(1, 0, 0, 0deg)
        }

        .tooltip-effect-5 .tooltip-text {
            padding: 1.4em
        }

        .tooltip-effect-1 .tooltip-content {
            -webkit-transform: translate3d(0, -10px, 0);
            transform: translate3d(0, -10px, 0);
            -webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, transform 0.3s;
            transition: opacity 0.3s, transform 0.3s, -webkit-transform 0.3s;
            color: #fff
        }

        .tooltip-effect-2 .tooltip-content {
            -webkit-transform-origin: 50% calc(110%);
            transform-origin: 50% calc(110%);
            -webkit-transform: perspective(1000px) rotate3d(1, 0, 0, 45deg);
            transform: perspective(1000px) rotate3d(1, 0, 0, 45deg);
            -webkit-transition: opacity 0.2s, -webkit-transform 0.2s;
            transition: opacity 0.2s, -webkit-transform 0.2s;
            transition: opacity 0.2s, transform 0.2s;
            transition: opacity 0.2s, transform 0.2s, -webkit-transform 0.2s
        }

        .tooltip-effect-3 .tooltip-content {
            -webkit-transform: translate3d(0, 10px, 0) rotate3d(1, 1, 0, 25deg);
            transform: translate3d(0, 10px, 0) rotate3d(1, 1, 0, 25deg);
            -webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, transform 0.3s;
            transition: opacity 0.3s, transform 0.3s, -webkit-transform 0.3s
        }

        .tooltip-effect-4 .tooltip-content {
            -webkit-transform-origin: 50% 100%;
            transform-origin: 50% 100%;
            -webkit-transform: scale3d(0.7, 0.3, 1);
            transform: scale3d(0.7, 0.3, 1);
            -webkit-transition: opacity 0.2s, -webkit-transform 0.2s;
            transition: opacity 0.2s, -webkit-transform 0.2s;
            transition: opacity 0.2s, transform 0.2s;
            transition: opacity 0.2s, transform 0.2s, -webkit-transform 0.2s
        }

        .tooltip-effect-5 .tooltip-content {
            width: 180px;
            margin-left: -90px;
            -webkit-transform-origin: 50% calc(106%);
            transform-origin: 50% calc(106%);
            -webkit-transform: rotate3d(0, 0, 1, 15deg);
            transform: rotate3d(0, 0, 1, 15deg);
            -webkit-transition: opacity 0.2s, -webkit-transform 0.2s;
            transition: opacity 0.2s, -webkit-transform 0.2s;
            transition: opacity 0.2s, transform 0.2s;
            transition: opacity 0.2s, transform 0.2s, -webkit-transform 0.2s;
            -webkit-transition-timing-function: ease, cubic-bezier(0.17, 0.67, 0.4, 1.39);
            transition-timing-function: ease, cubic-bezier(0.17, 0.67, 0.4, 1.39)
        }

        .tooltip-effect-6 .tooltip-content2 {
            -webkit-transform: translate3d(0, 10px, 0) rotate3d(1, 1, 1, 45deg);
            transform: translate3d(0, 10px, 0) rotate3d(1, 1, 1, 45deg);
            -webkit-transform-origin: 50% 100%;
            transform-origin: 50% 100%;
            -webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, transform 0.3s;
            transition: opacity 0.3s, transform 0.3s, -webkit-transform 0.3s
        }

        .tooltip-effect-6 .tooltip-content2 i {
            -webkit-transform: scale3d(0, 0, 1);
            transform: scale3d(0, 0, 1);
            -webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, transform 0.3s;
            transition: opacity 0.3s, transform 0.3s, -webkit-transform 0.3s
        }

        .tooltip-effect-7 .tooltip-content2 {
            -webkit-transform: translate3d(0, 10px, 0);
            transform: translate3d(0, 10px, 0);
            -webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, transform 0.3s;
            transition: opacity 0.3s, transform 0.3s, -webkit-transform 0.3s
        }

        .tooltip-effect-7 .tooltip-content2 i {
            -webkit-transform: translate3d(0, 15px, 0);
            transform: translate3d(0, 15px, 0);
            -webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, transform 0.3s;
            transition: opacity 0.3s, transform 0.3s, -webkit-transform 0.3s
        }

        .tooltip-effect-8 .tooltip-content2 {
            -webkit-transform: translate3d(0, 10px, 0) rotate3d(0, 1, 0, 90deg);
            transform: translate3d(0, 10px, 0) rotate3d(0, 1, 0, 90deg);
            -webkit-transform-origin: 50% 100%;
            transform-origin: 50% 100%;
            -webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, transform 0.3s;
            transition: opacity 0.3s, transform 0.3s, -webkit-transform 0.3s
        }

        .tooltip-effect-8 .tooltip-content2 i {
            -webkit-transform: scale3d(0, 0, 1);
            transform: scale3d(0, 0, 1);
            -webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, transform 0.3s;
            transition: opacity 0.3s, transform 0.3s, -webkit-transform 0.3s
        }

        .tooltip-effect-9 .tooltip-content2 {
            -webkit-transform: translate3d(0, -20px, 0);
            transform: translate3d(0, -20px, 0);
            -webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, transform 0.3s;
            transition: opacity 0.3s, transform 0.3s, -webkit-transform 0.3s
        }

        .tooltip-effect-9 .tooltip-content2 i {
            -webkit-transform: translate3d(0, 20px, 0);
            transform: translate3d(0, 20px, 0);
            -webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, transform 0.3s;
            transition: opacity 0.3s, transform 0.3s, -webkit-transform 0.3s
        }

        .tooltip-effect-6:hover .tooltip-content2 i {
            -webkit-transform: rotate3d(1, 1, 1, 0);
            transform: rotate3d(1, 1, 1, 0)
        }

        .tooltip-content2 {
            position: absolute;
            z-index: 9999;
            width: 80px;
            height: 80px;
            padding-top: 25px;
            left: 50%;
            margin-left: -40px;
            bottom: 100%;
            border-radius: 50%;
            text-align: center;
            background: #01a9ac;
            color: #fff;
            opacity: 0;
            margin-bottom: 20px;
            cursor: default;
            pointer-events: none
        }

        .tooltip-content2 i {
            opacity: 0
        }

        .tooltip-content2::after {
            content: '';
            position: absolute;
            top: 100%;
            left: 50%;
            margin: -7px 0 0 -15px;
            width: 30px;
            height: 20px;
            background: url("../images/tooltip/tooltip1.svg") center center no-repeat;
            background-size: 100%
        }

        .tooltip-content3 {
            position: absolute;
            background: url("../images/tooltip/shape1.svg") center bottom no-repeat;
            background-size: 100% 100%;
            z-index: 9999;
            width: 200px;
            bottom: 100%;
            left: 50%;
            margin-left: -100px;
            padding: 50px 30px;
            text-align: center;
            color: #fff;
            opacity: 0;
            cursor: default;
            font-size: 14px;
            line-height: 27px;
            pointer-events: none;
            -webkit-transform: scale3d(0.1, 0.2, 1);
            transform: scale3d(0.1, 0.2, 1);
            -webkit-transform-origin: 50% 120%;
            transform-origin: 50% 120%;
            -webkit-transition: opacity 0.4s, -webkit-transform 0.4s;
            transition: opacity 0.4s, -webkit-transform 0.4s;
            transition: opacity 0.4s, transform 0.4s;
            transition: opacity 0.4s, transform 0.4s, -webkit-transform 0.4s;
            -webkit-transition-timing-function: ease, cubic-bezier(0.6, 0, 0.4, 1);
            transition-timing-function: ease, cubic-bezier(0.6, 0, 0.4, 1)
        }

        .tooltip-content3::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            left: 50%;
            margin-left: -8px;
            top: 100%;
            background: #00AEEF;
            -webkit-transform: translate3d(0, -60%, 0) rotate3d(0, 0, 1, 45deg);
            transform: translate3d(0, -60%, 0) rotate3d(0, 0, 1, 45deg)
        }

        .tooltip-content4 {
            position: absolute;
            z-index: 99;
            width: 360px;
            left: 50%;
            margin-left: -180px;
            bottom: -5px;
            text-align: left;
            background: #01a9ac;
            opacity: 0;
            font-size: 14px;
            line-height: 27px;
            padding: 1.5em;
            color: #fff;
            border-bottom: 55px solid #004547;
            cursor: default;
            pointer-events: none;
            border-radius: 5px;
            -webkit-transform: translate3d(0, -0.5em, 0);
            transform: translate3d(0, -0.5em, 0);
            -webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, transform 0.3s;
            transition: opacity 0.3s, transform 0.3s, -webkit-transform 0.3s
        }

        .tooltip-content4 a {
            color: #2b2b2b
        }

        .tooltip-content4 .tooltip-text2 {
            opacity: 0;
            -webkit-transform: translate3d(0, 1.5em, 0);
            transform: translate3d(0, 1.5em, 0);
            -webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, -webkit-transform 0.3s;
            transition: opacity 0.3s, transform 0.3s;
            transition: opacity 0.3s, transform 0.3s, -webkit-transform 0.3s
        }

        .tooltip-content5 {
            position: absolute;
            z-index: 9999;
            width: 300px;
            left: 50%;
            bottom: 100%;
            font-size: 20px;
            line-height: 1.4;
            text-align: center;
            font-weight: 400;
            color: #fff;
            background: 0 0;
            opacity: 0;
            margin: 0 0 20px -150px;
            cursor: default;
            pointer-events: none;
            -webkit-font-smoothing: antialiased;
            -webkit-transition: opacity 0.3s 0.3s;
            transition: opacity 0.3s 0.3s
        }

        .tooltip-content5 span {
            display: block
        }

        .tooltip-content5::after {
            content: '';
            bottom: -20px;
            left: 50%;
            border: solid transparent;
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-color: #01a9ac transparent transparent;
            border-width: 10px;
            margin-left: -10px
        }

        .tooltip-content5 .tooltip-text3 {
            border-bottom: 10px solid #01a9ac;
            overflow: hidden;
            -webkit-transform: scale3d(0, 1, 1);
            transform: scale3d(0, 1, 1);
            -webkit-transition: -webkit-transform 0.3s 0.3s;
            transition: -webkit-transform 0.3s 0.3s;
            transition: transform 0.3s 0.3s;
            transition: transform 0.3s 0.3s, -webkit-transform 0.3s 0.3s
        }

        .tooltip-content5 .tooltip-inner2 {
            background: #2b2b2b;
            padding: 40px;
            -webkit-transform: translate3d(0, 100%, 0);
            transform: translate3d(0, 100%, 0);
            -webkit-transition: -webkit-transform 0.3s;
            transition: -webkit-transform 0.3s;
            transition: transform 0.3s;
            transition: transform 0.3s, -webkit-transform 0.3s
        }

        a.mytooltip {
            font-weight: 700;
            color: #01a9ac;
            z-index: 9
        }

        .tooltip-link a {
            margin-left: 10px;
            color: #01a9ac
        }

        .tooltip-icon button i {
            margin-right: 0
        }
    </style>
    @yield('adminlte_css_pre')

    {{-- Base Stylesheets --}}
    @if(!config('adminlte.enabled_laravel_mix'))
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    {{-- Configured Stylesheets --}}
    @include('adminlte::plugins', ['type' => 'css'])

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <link href="https://adminlte.io/themes/v3/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/jquery.timepicker.css') }}" rel="stylesheet" type="text/css">


    @else
    <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
    @endif

    {{-- Livewire Styles --}}
    @if(config('adminlte.livewire'))
    @if(app()->version() >= 7)
    @livewireStyles
    @else
    <livewire:styles />
    @endif
    @endif

    {{-- Custom Stylesheets (post AdminLTE) --}}
    @yield('adminlte_css')
    {{-- Favicon --}}
    @if(config('adminlte.use_ico_only'))
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    @elseif(config('adminlte.use_full_favicon'))
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-icon-192x192.png') }}">
    <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    @endif

</head>

<body class="@yield('classes_body')" @yield('body_data')>

    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset(config('adminlte.loader_img')) }}" alt="AdminLTELogo" height="100" width="100">
    </div>

    {{-- Body Content --}}
    @yield('body')

    {{-- Base Scripts --}}
    @if(!config('adminlte.enabled_laravel_mix'))
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ asset('js/jquery.timepicker.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_KEY')}}&libraries=places"></script>
    <script src="{{ asset('js/loadingoverlay.min.js') }}"></script>

    {{-- Configured Scripts --}}
    @include('adminlte::plugins', ['type' => 'js'])

    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @else
    <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
    @endif

    {{-- Livewire Script --}}
    @if(config('adminlte.livewire'))
    @if(app()->version() >= 7)
    @livewireScripts
    @else
    <livewire:scripts />
    @endif
    @endif
    <script type="text/javascript">
        $(function() {
            $("#dt1").datepicker({
                dateFormat: "dd-M-yy",
                minDate: 0,
                // minDate: 0,
                onSelect: function() {
                    var dt2 = $('#dt2');
                    var startDate = $(this).datepicker('getDate');
                    var minDate = $(this).datepicker('getDate');
                    var dt2Date = dt2.datepicker('getDate');
                    //difference in days. 86400 seconds in day, 1000 ms in second
                    var dateDiff = (dt2Date - minDate) / (86400 * 1000);

                    startDate.setDate(startDate.getDate() + 30);
                    if (dt2Date == null || dateDiff < 0) {
                        dt2.datepicker('setDate', minDate);
                    } else if (dateDiff > 30) {
                        dt2.datepicker('setDate', startDate);
                    }
                    //sets dt2 maxDate to the last day of 30 days window
                    dt2.datepicker('option', 'maxDate', startDate);
                    dt2.datepicker('option', 'minDate', minDate);

                }
            });

            $('#dt2').datepicker({
                dateFormat: "dd-M-yy",
                minDate: 0,
                onSelect: function() {

                },
            });

            $("#dt3").datepicker({
                dateFormat: "dd-M-yy",
                // minDate: 0,
                onSelect: function() {
                    var dt4 = $('#dt4');
                    var startDate = $(this).datepicker('getDate');
                    var minDate = $(this).datepicker('getDate');
                    var dt4Date = dt4.datepicker('getDate');
                    //difference in days. 86400 seconds in day, 1000 ms in second
                    var dateDiff = (dt4Date - minDate) / (86400 * 1000);

                    startDate.setDate(startDate.getDate() + 30);
                    if (dt4Date == null || dateDiff < 0) {
                        dt4.datepicker('setDate', minDate);
                    } else if (dateDiff > 30) {
                        dt4.datepicker('setDate', startDate);
                    }
                    //sets dt4 maxDate to the last day of 30 days window
                    dt4.datepicker('option', 'maxDate', startDate);
                    dt4.datepicker('option', 'minDate', minDate);

                }
            });

            $('#dt4').datepicker({
                dateFormat: "dd-M-yy",
                onSelect: function() {

                },
            });
        });

        $(document).ready(function(){
            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });
            var activeTab = localStorage.getItem('activeTab');
            if(activeTab){
                $('#myTab a[href="' + activeTab + '"]').tab('show');
            }
        });
    </script>
    @yield('adminlte_js')
</body>

</html>