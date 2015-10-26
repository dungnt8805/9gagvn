<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8"/>
    <title>Administrator Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name="viewport">
    <meta name="_token" content="{!! csrf_token() !!}">
    <link href="{!! asset('resources/gag/components/bootstrap/css/bootstrap_modified.css') !!}" rel="stylesheet">
    <link href="{!! asset('resources/gag/components/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('resources/gag/components/ionicons-2.0.1/css/ionicons.min.css') !!}" rel="stylesheet">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('resources/gag/components/jvectormap/jquery-jvectormap-1.2.2.css')}}">
    <!--datepicker-->
    <link rel="stylesheet" href="{!! asset('resources/gag/components/datepicker/datepicker3.css') !!}" type="text/css"/>
    <!-- daterangepicker-->
    <link rel="stylesheet" href="{!! asset('resources/gag/components/daterangepicker/daterangepicker-bs3.css') !!}"
          type="text/css"/>
    <!-- bootstrap wysihtml5 -->
    <link href="{!! asset('resources/gag/components/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') !!}"
          rel="stylesheet" type="text/css"/>
    <link href="{!! asset('resources/gag/admin/css/style.css') !!}" rel="stylesheet" type="text/css">
    <!-- Theme style -->
    <!--<link rel="stylesheet" href="{{asset('resources/gag/funny/admin/css/AdminLTE.min.css')}}">-->
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <!--<link rel="stylesheet" href="{{asset('resources/gag/funny/admin/css/skins/_all-skins.min.css')}}">-->
    <link href="{!! asset('resources/gag/components/morris/morris-0.4.3.min.css') !!}" rel="stylesheet"
          type="text/css"/>

    <!-- Javascript -->
    <script src="{!! asset('resources/gag/components/jquery-2.1.4.min.js') !!}" type="text/javascript"></script>

    <script src="{!! asset('resources/gag/components/jquery-ui.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('resources/gag/components/bootstrap/js/bootstrap.min.js') !!}"
            type="text/javascript"></script>
    <script src="{!! asset('resources/gag/components/sparkline/jquery.sparkline.min.js') !!}"
            type="text/javascript"></script>
    <script src="{!! asset('resources/gag/components/jvectormap/jquery-jvectormap-1.2.2.min.js') !!}"
            type="text/javascript"></script>
    <script src="{!! asset('resources/gag/components/jvectormap/jquery-jvectormap-world-mill-en.js') !!}"
            type="text/javascript"></script>
    <script src="{!! asset('resources/gag/components/jqueryKnob/jquery.knob.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('resources/gag/components/daterangepicker/daterangepicker.js') !!}"
            type="text/javascript"></script>
    <script src="{!! asset('resources/gag/components/datepicker/bootstrap-datepicker.js') !!}"
            type="text/javascript"></script>
    <script src="{!! asset('resources/gag/components/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}"
            type="text/javascript"></script>
    <script src="{!! asset('resources/gag/components/iCheck/icheck.min.js') !!}"
            type="text/javascript"></script>
    <script src="{!! asset('resources/gag/components/noty/jquery.noty.js') !!}" type="text/javascript"></script>
    <script type="text/javascript" src="{!! asset('resources/gag/admin/AdminLTE/app.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('resources/gag/admin/AdminLTE/dashboard.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('resources/gag/js/config.js') !!}"></script>

</head>
<body class="skin-black fixed">
<header class="header">
    <a href="{!! URL::to('/') !!}" class="logo">
        <img src="" style="height: 35px; width: auto">
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span>
                            <i class="caret"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{!! Timthumb::link($logged_user->avatar,90,90,1) !!}" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                {!! $logged_user->name !!}
                                <small>Member since {!! date('F j, Y',strtotime($logged_user->created_at)) !!}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <aside class="left-side sidebar-offcanvas">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{!! Timthumb::link($logged_user->avatar,43,43,1) !!}" class="img-circle"
                         alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p>Hello, {!! $logged_user->name !!}</p>
                    <span class="label label-danger">Admin</span>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li class="active">
                    <a href="{!! route('admin.dashboard') !!}" id="dashboard-section" data-section="dashboard"
                       class="ajax">
                        <i class="fa fa-dashboard"></i><span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="ajax" data-section="posts" id="media-section" href="{!! route('admin.posts.index') !!}">
                        <i class="fa fa-picture-o"></i><span>Posts</span>
                    </a>
                </li>
                <li>
                    <a href="{!! route('admin.categories.index') !!}" class="ajax" data-section="categories"
                       id="categories-section">
                        <i class="ion ion-ios7-albums"></i><span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="" class="ajax" data-section="pages" id="pages-section">
                        <i class="fa fa-files"></i><span>Pages</span>
                    </a>
                </li>
                <li>
                    <a class="ajax" data-section="custom_code" id="custom_code-section"
                       href="{!! route('admin.custom_code') !!}">
                        <i class="ion ion-code"></i><span>Custom Code</span>
                    </a>
                </li>
                <li>
                    <a class="ajax" data-section="settings" id="settings-section"
                       href="{!! route('admin.settings') !!}">
                        <i class="ion ion-gear-a"></i><span>Settings</span>
                    </a>
                </li>


            </ul>
        </section>
    </aside>
    <aside class="right-side">
        <section class="content-header">

            <?php if(Session::get('note') != '' && Session::get('note_type') != ''): ?>
            <div class="callout callout-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?= Session::get("note"); ?>
            </div>
            <?php endif; ?>
            <h1>
                {!! isset($admin_title_session) ? $admin_title_session.' - ' : '' !!} Admin Panel
            </h1>
        </section>
        <section class="content">
            @yield('content')
        </section>
    </aside>

</div>
</body>
</html>