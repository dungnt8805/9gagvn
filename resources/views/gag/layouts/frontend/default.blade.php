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
    <link href="{!! asset('resources/gag/components/bootstrap/css/bootstrap_modified.css') !!}" rel="stylesheet"
          type="text/css"/>
    <link href="{!! asset('resources/gag/components/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet"
          type="text/css"/>
    <link href="{!! asset('resources/gag/components/animate/css/animate.min.css') !!}" rel="stylesheet"
          type="text/css"/>
    <link href="{!! asset('resources/gag/frontend/css/style.css') !!}" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        {!! $app_settings['custom_css'] !!}
    </style>
    @include('gag.layouts.frontend.includes.custom_css')
    <style type="text/css">
        .notifications {
            margin-top: -7px;
            display: inline-block;
            float: right;
        }

        .dropdownNotifi .dropdown-menu {
            display: none;
            opacity: 1 !important;
            visibility: visible !important;
        }
    </style>
    <!--[if lte IE 8]>
    <script type="text/javascript" src="{!! asset('resources/gag/components/respond.min.js') !!}"></script>
    <![endif]-->
    {{--header javascript    --}}
    <script src="{!! asset('resources/gag/components/jquery-1.11.1.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('resources/gag/components/bootstrap/js/bootstrap-3.0.0.min.js') !!}"
            type="text/javascript"></script>
    <script src="{!! asset('resources/gag/components/masonry.pkgd.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('resources/gag/components/imagesloaded.pkgd.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('resources/gag/components/jquery.infinitescroll.min.js') !!}"
            type="text/javascript"></script>
    <script src="{!! asset('resources/gag/components/jquery.sticky.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('resources/gag/components/jquery.fitvid.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('resources/gag/components/jquery.timeago.js') !!}" type="text/javascript"></script>

    <!-- jwplayer -->
    <script src="{{asset('resources/gag/components/jwplayer-7.1.0/jwplayer.js')}}"></script>
    <script>jwplayer.key = "5Xr9z0ikONhKqaa32VQueQ+ZDldMuFSpn6DIXQ=="</script>
    <!-- end jwplayer -->
</head>
<body>
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
                <ul>
                    <li class="active">
                        <a href="/"><i class="fa fa-home"></i>{!! trans('lang.home') !!}</a>
                    </li>
                    <li class="dropdown @if(Request::is('popular/*') || Request::is('popular')) {{'active'}} @endif">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                    class="fa fa-star"></i> <?= Lang::get('lang.popular') ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= URL::to('popular/week') ?>"><?= Lang::get('lang.for_the_week') ?></a></li>
                            <li><a href="<?= URL::to('popular/month') ?>"><?= Lang::get('lang.for_the_month') ?></a>
                            </li>
                            <li><a href="<?= URL::to('popular/year') ?>"><?= Lang::get('lang.for_the_year') ?></a></li>
                            <li><a href="<?= URL::to('popular') ?>"><?= Lang::get('lang.all_time') ?></a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle categories" data-toggle="dropdown"><i
                                    class="fa fa-folder-open"></i> <?= Lang::get('lang.categories') ?> <b
                                    class="caret"></b></a>

                        <ul class="dropdown-menu">
                            <li>
                                <?php foreach ($app_categories as $category): ?>
                                <a href="<?= URL::to('category') . '/' . strtolower($category['slug']) ?>"><?= $category['title'] ?></a>
                                <?php endforeach; ?>
                            </li>
                        </ul>
                    </li>
                    @if($app_settings['pages_in_menu'] == 1)

                    @endif
                    <li><a href="{!! route('post.random') !!}"><i class="fa fa-random">
                            </i> <?= Lang::get('lang.random') ?>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if(!is_null($logged_user))
                        <li class="dropdown">
                            <a href="#" class="user-menu dropdown-toggle" data-toggle="dropdown">
                                <b class="caret"></b>

                                <div id="user-info">
                                    <h4><i class="fa fa-gear"></i>{!! trans('lang.settings') !!}</h4>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                @if(0)
                                    <li>
                                        <a href="" class="admin_link_mobile">
                                            <i class="fa fa-coffee"></i> {!! trans('lang.admin') !!}
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="">
                                        <i class="fa fa-user"></i> {!! trans('lang.my_profile') !!}
                                    </a>
                                </li>
                                <li>
                                    <a href="" id="user_logout_mobile">
                                        <i class="fa fa-power-off"></i> {!! trans('lang.logout') !!}
                                    </a>
                                </li>
                                @if(!is_null($logged_user))
                                    <li>
                                        <a href="" class="upload-btn">
                                            <i class="fa fa-cloud-upload"></i> {!! trans('lang.upload') !!}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @else
                    @endif
                </ul>

            </div>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-left nav-desktop">
                <li class="active">
                    <a hre="/"><i class="fa fa-home"></i>
                        <span>{!! trans('lang.home') !!}</span>
                    </a>

                    <div class="nav-border-bottom"></div>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-star"></i>
                        <span>{!! trans('lang.popular') !!}</span><b class="caret"></b>

                        <div class="nav-border-bottom"></div>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="">{!! trans('lang.for_the_week') !!}</a>
                        </li>
                        <li><a href="">{!! trans('lang.for_the_month') !!}</a></li>
                        <li><a href="">{!! trans('lang.for_the_year') !!}</a></li>
                        <li><a href="">{!! trans('lang.all_time') !!}</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle categories" data-toggle="dropdown">
                        <i class="fa fa-folder-open"></i>
                        <span>{!! trans('lang.categories') !!}</span><b class="caret"></b>

                        <div class="nav-border-bottom"></div>
                        <ul class="dropdown-menu">
                            @foreach($app_categories as $category)
                                <li>
                                    <a href="{!! URL::to('category').'/'.$category['slug'] !!}">
                                        {!! $category['title'] !!}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </a>
                </li>
                @if($app_settings['pages_in_menu'] == 1)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-file-text"></i> {!! $app_settings['pages_in_menu_text'] !!}
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">

                        </ul>
                    </li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdownd dropdownNotifi">
                    @if(is_null($logged_user))
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                        </a>
                    @else
                        <a href="#" class="dropdown-toggle readNotifi" data-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                        </a>
                        <ul class="dropdown-menu">

                        </ul>
                    @endif
                </li>
                <li>
                    <a href="{!! route('post.random') !!}" class="random"><i class="fa fa-random"></i></a>
                </li>
                @if(!is_null($logged_user))
                    <li>
                        <a href="{!! route('post.add') !!}" class="upload-btn upload-btn-desktop">
                            <i class="fa fa-cloud-upload"></i>{!! trans('lang.upload') !!}
                        </a>
                    </li>
                @endif
                @if(is_null($logged_user))
                    <li class="">
                        <a href="" id="login-button-desktop">{!! trans('lang.sign_in') !!}</a>

                        <div class="nav-border-bottom"></div>
                    </li>
                    <li>
                        <a href="" id="signup-button-desktop">{!! trans('lang.sign_up') !!}</a>

                        <div class="nav-border-bottom"></div>
                    </li>
                @else
                    <li class="dropdown">
                        <a href="#" class="user-menu user-menu-desktop dropdown-toggle" data-toggle="dropdown">
                            <img src="{!! Timthumb::link($logged_user->avatar,31,31) !!}" class="img-circle"/>
                            <b class="caret"></b>

                            <div id="user-info">
                                <h4>
                                    @if(strlen($logged_user->name)>8)
                                        {!! substr($logged_user->name,0,8).'...' !!}
                                    @else
                                        {!! $logged_user->name !!}
                                    @endif
                                </h4>

                                <p>0 {!! trans('lang.point') !!}</p>
                            </div>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<!-- Home Container -->
<div class="container main_home_container">
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
<script type="text/javascript">
    $(document).ready(function () {
        $('.dropdownNotifi').on('click', 'a.readNotifi', function (event) {
            event.stopPropagation();
            tc = $(this);
            var ID = tc.attr("id");
            $.ajax({
                type: 'POST',
                url: '/notification',
                data: {},
                success: function (response) {
                    $('.notifications').hide();
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $('document').ready(function () {

        $('.dropdown').hover(function () {
            $(this).addClass('open');
        }, function () {
            $(this).removeClass('open');
        });
        $('.dropdownNotifi').hover(function () {
            $(this).removeClass('open');
        });
        $('.dropdownNotifi a').click(function () {
            $(this).parent().find('.dropdown-menu').toggle();
        });
        NProgress.start();

                <?php if(Session::get('note') != '' && Session::get('note_type') != ''): ?>
                    var n = noty({
            text: '<?= Session::get("note") ?>',
            layout: 'top',
            type: '<?= Session::get("note_type") ?>',
            template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
            closeWith: ['button'],
            timeout: 1600
        });
                <?php Session::forget('note');
                      Session::forget('note_type');
                ?>
            <?php endif; ?>

            var slide_pos = 1;

        $('#random-right').click(function () {
            if (slide_pos < 3) {
                $('#random-slider').css('left', parseInt($('#random-slider').css('left')) - parseInt($('.random-container').width()) - 28 + 'px');
                slide_pos += 1;
            }
        });

        $('#random-left').click(function () {
            if (slide_pos > 1) {
                $('#random-slider').css('left', parseInt($('#random-slider').css('left')) + parseInt($('.random-container').width()) + 28 + 'px');
                slide_pos -= 1;
            }
        });


    });


    $(window).load(function () {
        NProgress.done();
    });

    $(window).resize(function () {
        jquery_sticky_footer();
    });


    $(window).bind("load", function () {
        jquery_sticky_footer();
    });

    function jquery_sticky_footer() {
        var footer = $("#footer");
        var pos = footer.position();
        var height = $(window).height();
        height = height - pos.top;
        height = height - footer.outerHeight();
        if (height > 0) {
            footer.css({'margin-top': height + 'px'});
        }
    }

    /********** Mobile Functionality **********/

    var mobileSafari = '';

    $(document).ready(function () {
        $('.mobile-menu-toggle').click(function () {
            $('.mobile-menu').toggle();
            $('body').toggleClass('mobile-margin').toggleClass('body-relative');
            $('.navbar').toggleClass('mobile-margin');
        });


        // Assign a variable for the application being used
        var nVer = navigator.appVersion;
        // Assign a variable for the device being used
        var nAgt = navigator.userAgent;
        var nameOffset, verOffset, ix;


        // First check to see if the platform is an iPhone or iPod
        if (navigator.platform == 'iPhone' || navigator.platform == 'iPod') {
            // In Safari, the true version is after "Safari"
            if ((verOffset = nAgt.indexOf('Safari')) != -1) {
                // Set a variable to use later
                mobileSafari = 'Safari';
            }
        }

        // If is mobile Safari set window height +60
        if (mobileSafari == 'Safari') {
            // Height + 60px
            $('.mobile-menu').css('height', (parseInt($(window).height()) + 60) + 'px');
        } else {
            // Else use the default window height
            $('.mobile-menu').css('height', $(window).height());
        }
        ;

    });

    $(window).resize(function () {
        // If is mobile Safari set window height +60
        if (mobileSafari == 'Safari') {
            // Height + 60px
            $('.mobile-menu').css('height', (parseInt($(window).height()) + 60) + 'px');
        } else {
            // Else use the default window height
            $('.mobile-menu').css('height', $(window).height());
        }
        ;
    });

    /********** End Mobile Functionality **********/


</script>

<?php if(isset($app_settings['custom_js'])): ?>
<script>
    <?= $app_settings['custom_js'] ?>
</script>
<?php endif; ?>

<?php if(isset($app_settings['analytics'])): ?>
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', '<?= $app_settings['analytics'] ?>', 'auto');
    ga('send', 'pageview');

</script>
<?php endif; ?>
</body>
</html>
