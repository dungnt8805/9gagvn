<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('resources/components/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('resources/components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('resources/components/jvectormap/jquery-jvectormap-1.2.2.css')}}">

    <link rel="stylesheet" href="{{asset('resources/funny/base/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('resources/funny/base/css/dropzone.v2.css')}}"/>
    <link rel="stylesheet" href="{{asset('resources/funny/base/css/9gag.css')}}"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<header id="header-hav" class="navbar navbar-default navbar-fixed-top hl-top-menu-wrap" role="navigation">
    <div class="container960">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand site" href="/">9GAG</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="navbar-nav nav">

            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    @include("layouts.frontend._partials.user_tools")
                @else
                    @include('layouts.frontend._partials.ajax_login_form')
                @endif
            </ul>
        </div>

        <nav class="navbar-collapse bs-navbar-collapse collapse" aria-expanded="false" style="height: 1px">

        </nav>
        <div class="pull-right hidden-xs">

        </div>
    </div>
</header>
<main id="content" role="main" tabindex="-1" style="margin-top: 55px;">
    <div class="container960">
        @yield('content')
    </div>
</main>
<div id="postModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Post a fun</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- jQuery 2.1.4 -->
<script src="{{asset('resources/components/jquery-2.1.4.min.js')}}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{asset('resources/components/bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>