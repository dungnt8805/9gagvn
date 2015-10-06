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
    @include('layouts.frontend.includes.custom_css')


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
<div class="navbar navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">{{ Lang::get('lang.toggle_navigation') }}</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand logo" href="{{ URL::to('/') }}"><img src="" style="height:35px; width:auto;" /></a>

            <div class="mobile-menu-toggle"><i class="fa fa-bars"></i></div>
            @include('layouts.frontend.includes.mobile-menu')

            <ul class="nav navbar-nav navbar-right">
                @if(Auth::guest())
                    <li class="@if(Request::is('login')) active @endif">
                        <a href="{{ URL::to('login') }}">{{ Lang::get('lang.sign_in') }}</a></li>

                    @if($app_settings['user_registration'])
                        <li class="@if(Request::is('signup')) active @endif">
                            <a href="{{ URL::to('signup') }}">{{ Lang::get('lang.sign_up') }}</a></li>
                    @endif
                @else
                    <li class="dropdown">

                        <a href="#" class="user-menu dropdown-toggle" data-toggle="dropdown"><b class="caret"></b>

                            <div id="user-info"><h4><i class="fa fa-gear"></i> {{ Lang::get('lang.settings') }}</h4>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            @if(Auth::user()->admin)
                                <li>
                                    <a href="{!! URL::to('admin') !!}" class="admin_link_mobile">
                                        <i class="fa fa-coffee"></i> {!! trans('lang.admin') !!}
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="#"><i class="fa fa-user"></i>{!! trans('lang.my_profile') !!}</a>
                            </li>
                            <li><a href="{!! URL::to('logout') !!}" id="user_logout_mobile">
                                    <i class="fa fa-power-off"></i>{!! trans('lang.logout') !!}</a></li>

                        </ul>
                    </li>
                    @if($app_settings['user_registration'])
                        <li>
                            <a href="" class="upload-btn upload-btn-desktop">
                                <i class="fa fa-cloud-upload"></i> {!! trans('lang.upload') !!}
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
</div>
</body>
</html>