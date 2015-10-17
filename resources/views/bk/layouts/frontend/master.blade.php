<!DOCTYPE html>
<html>
<head>
    @if(isset($media->title))
        <title>{!! stripslashes($media->title) !!}</title>
    @else
        <title>{!! $app_settings['website_title'] !!} - {!! $app_settings['website_description'] !!}</title>
    @endif
    <meta name="viewport" content="initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon">
    <link rel="shortcut icon" type="image/x-icon">
    <!-- Bootstrap 3.3.5 -->

    <link rel="stylesheet" href="{{asset('resources/components/bootstrap/css/bootstrap_modified.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('resources/components/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{!! asset('resources/components/animate.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('resources/funny/base/css/ninja.css') !!}">
    <link rel="stylesheet" href="{!! asset('resources/funny/base/css/ninja-dark.css') !!}">
    {{--<link rel="stylesheet" href="{!! asset('resources/funny/base/css/custom_bootstrap.css') !!}">--}}
    @yield('css')
    @include('bk.layouts.frontend.includes.custom_css')


            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('resources/components/jquery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('resources/components/bootstrap/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('resources/components/angular-js/angular.js')}}"></script>
    <script src="{{asset('resources/components/angular-js/ng-infinite-scroll.min.js')}}"></script>

    @if(isset($media->title) && isset($media->pic_url))
        <meta property="og:title" content="{{ $media->title }}"/>
        <meta property="og:url" content="{{ Request::url() }}"/>
        <meta property="og:image" content="{{ Config::get('site.uploads_dir') . '/images/' . $media->pic_url }}"/>
        <meta property="og:type" content="website"/>

        @if(isset($media->description))
            <meta property="og:description" content="{{ $media->description }}"/>
        @endif

        <meta itemprop="name" content="{{ $media->title }}">
        <meta itemprop="description" content="{{ $media->description }}">
        <meta itemprop="image" content="{{ Config::get('site.uploads_dir') . '/images/' . $media->pic_url }}">
    @endif
</head>
<body class="dark">
<nav class="navbar navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="nav-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">{!! trans('lang.toggle_navigation') !!}</span>navigation
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand logo" href="<?= URL::to('/') ?>">
                <img src="{!! Timthumb::link($app_settings['logo'],102,35) !!}" style="height:35px; width:auto;"/>
            </a>

            <div class="mobile-menu-toggle"><i class="fa fa-bars"></i></div>
            {{--mobile nav--}}
            <div class="mobile-menu">
                @if(!is_null($logged_user))
                    <a href="" class="usr-avatar">
                        <img src="{!! Timthumb::link($logged_user->avatar,90,90) !!}" alt="{!! $logged_user->name !!}"
                             class="img-circle user-avatar-large">
                    </a>
                    <a href="" class="username">
                        <h2><?php if (strlen($logged_user->name) > 14): echo substr($logged_user->name, 0, 14) . '...';
                            else: echo $logged_user->name; endif; ?></h2></a>
                    <p class="points"><i class="fa fa-star" style="color:gold"></i> points</p>
                    <div id="avatar-bg"></div>
                @endif
            </div>
        </div>
    </div>
</nav>
<div class="container main_home_container single">
    @yield("content")
</div>
</body>
</html>