<!DOCTYPE html>
<html>
<head>
    @if(isset($post->title))
        <title>{!! stripslashes($post->title) !!}</title>
    @else
        <title>{!! $app_settings['website_title'] !!} - {!! $app_settings['website_description'] !!}</title>
    @endif
    <meta name="viewport" content="initial-scale=1">
    {{--header css--}}
    @include('gag.layouts.frontend.includes.stylesheet')
    {{--header javascript--}}
    @include('gag.layouts.frontend.includes.javascript')
</head>
<body ng-app="App">
<nav class="navbar navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- brand and toggle get grouped for better mobile display-->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">{!! trans('lang.toggle_navigation') !!}</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand logo">
                <img src="" style="height: 35px; width: auto"/>
            </a>

            <div class="mobile-menu-toggle"><i class="fa fa-bars"></i></div>
            <!-- mobile nav -->
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
                @include('gag.layouts.frontend.includes.navbar_mobile')


            </div>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            @include('gag.layouts.frontend.includes.navbar')
        </div>
    </div>
</nav>
<!-- Home Container -->
<div class="container">
    @yield("content")
</div>
<!--end Home Container-->
<div id="footer">
    &copy; <?= date('Y') . ' ' . $app_settings['website_title'] ?>
</div>
<script src="{!! asset('resources/gag/components/noty/jquery.noty.js') !!}" type="text/javascript"></script>
<script src="{!! asset('resources/gag/components/noty/themes/default.js') !!}" type="text/javascript"></script>
<script src="{!! asset('resources/gag/components/noty/layouts/top.js') !!}" type="text/javascript"></script>
<script src="{!! asset('resources/gag/components/nprogress.js') !!}" type="text/javascript"></script>
@include('gag.layouts.frontend.includes.javascript_footer')
</body>
</html>
