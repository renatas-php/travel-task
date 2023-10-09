<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        @hasSection('title')

            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <meta name="description" content="{{ $description ?? config('app.name') }}">
        {{--<meta name="keywords" content="{{$keywords}}">
        <meta name="DC.title" content='{{ $title ?? config('app.name') }}'>
        <meta name="DC.description" content="{{ $description ?? config('app.name') }}">
        <meta name="DC.keywords" content="{{$keywords}}">
        <meta property="og:image" content="{{ url('img_bc/banner-img_bc/share.jpg') }}"/>
        <meta property="og:image:type" content="image/jpg"/>
        <meta property="og:description" content="{{ $description ?? config('app.name') }}"/>
        <meta property="og:title" content="{{ $title ?? config('app.name') }}"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="{{ Request::url() }}">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="{{ $title ?? config('app.name') }}"/>
        <meta name="twitter:description" content="{{ $description ?? config('app.name') }}"/>
        <meta name="twitter:site" content="{{ Request::url() }}">
        <meta name="author" content=config('app.name')>
        <meta property="og:site_name" content=config('app.name')>
        <meta name="twitter:image" content="{{ url('img_bc/banner-img_bc/share.jpg') }}"/>--}}

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
        <link rel="manifest" href="/assets/favicon/site.webmanifest">
        <link rel="mask-icon" href="/assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <!-- Fonts -->
        <link rel="stylesheet" href="/css/font.css">
        <link rel="stylesheet" href="/css/extra.css">

        @vite('resources/css/app.css')

        <!-- CSRF Token -->
        {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}
        @livewireStyles
    </head>

    <body>
        {{--@include('front.includes.main.menu')--}}
        @yield('content')
        {{--@include('front.includes.main.footer')--}}
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" crossorigin="anonymous"></script>
        <script src="//unpkg.com/alpinejs" defer></script>
        @livewireScripts
    </body>
</html>
