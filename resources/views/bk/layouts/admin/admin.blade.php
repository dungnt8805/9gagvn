<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{!! asset('resources/components/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet"
          type="text/css"/>
    <link href="{!! asset('resources/components/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet"
          type="text/css"/>
    <!-- Ionicons -->
    <link href="{!! asset('resources/components/ionicons-2.0.1/css/ionicons.min.css') !!}" rel="stylesheet"
          type="text/css"/>

    <!-- jvectormap -->
    <link href="{!! asset('resources/components/jvectormap/jquery-jvectormap-1.2.2.css') !!}" rel="stylesheet"
          type="text/css"/>
    <!-- Date Picker -->
    <link href="{!! asset('resources/components/datepicker/datepicker3.css') !!}" rel="stylesheet" type="text/css"/>
    <!-- Daterange picker -->
    <link href="{!! asset('resources/components/daterangepicker/daterangepicker-bs3.css') !!}" rel="stylesheet"
          type="text/css"/>
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="{!! asset('resources/components/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') !!}" rel="stylesheet"
          type="text/css"/>
    <!-- Theme style -->
    <link href="{!! asset('resources/funny/admin/css/style.css') !!}" rel="stylesheet" type="text/css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->



    <script src="{!! asset('resources/components/jquery-2.1.4.min.js') !!}"></script>
    <script src="{!! asset('resources/components/bootstrap/js/bootstrap.min.js" type="text/javascript') !!}"></script>
    <script src="{!! asset('resources/components/jquery-ui.min.js') !!}" type="text/javascript"></script>

    <!-- Sparkline -->
    <script src="{!! asset('resources/components/sparkline/jquery.sparkline.min.js') !!}" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="{!! asset('resources/components/jvectormap/jquery-jvectormap-1.2.2.min.js') !!}"
            type="text/javascript"></script>
    <script src="{!! asset('resources/components/jvectormap/jquery-jvectormap-world-mill-en.js') !!}"
            type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="{!! asset('resources/components/jqueryKnob/jquery.knob.js') !!}" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="{!! asset('resources/components/daterangepicker/daterangepicker.js') !!}" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="{!! asset('resources/components/datepicker/bootstrap-datepicker.js') !!}" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{!! asset('resources/components/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}"
            type="text/javascript"></script>
    <!-- iCheck -->
    <script src="{!! asset('resources/components/iCheck/icheck.min.js') !!}" type="text/javascript"></script>

    <!-- AdminLTE App -->
    <script src="{!! asset('resources/funny/admin/AdminLTE/app.js') !!}" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{!! asset('resources/funny/admin/AdminLTE/dashboard.js') !!}" type="text/javascript"></script>

    <!-- -->
    <script src="{!! asset('resources/funny/admin/js/script.js') !!}"></script>
</head>
<body class="skin-black fixed">
<!-- header logo: style can be found in header.less -->
<header class="header">
    <a class="logo" href="<?= URL::to('/') ?>"><img
                src="<?= Config::get('site.uploads_dir') . '/settings/' . $app_settings['logo'] ?>"
                style="height:35px; width:auto;"/></a>
    <!-- Header Navbar: style can be found in header.less -->
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

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span><?= Auth::user()->username; ?> <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{!! Timthumb::link(Auth::user()->avatar,74,74,1) !!}"
                                 class="img-circle" alt="User Image"/>

                            <p>
                                <?= Auth::user()->username; ?>
                                <small>Member since <?= date("F j, Y", strtotime(Auth::user()->created_at)) ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?= URL::to('user') . '/' . Auth::user()->username; ?>"
                                   class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?= URL::to('logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{!! Timthumb::link(Auth::user()->avatar,43,43,1) !!}"
                         class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p>Hello, <?= Auth::user()->username; ?></p>

                    <span class="label label-danger">Admin</span>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="active">
                    <a href="<?= URL::to('admin/dashboard') ?>" id="dashboard-section" data-section="dashboard"
                       class="ajax">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="ajax" data-section="media" id="media-section" href="<?= URL::to('admin/media') ?>">
                        <i class="fa fa-picture-o"></i><span> Media </span>
                    </a>
                </li>
                <li>
                    <a class="ajax" data-section="users" id="users-section" href="<?= URL::to('admin/users') ?>">
                        <i class="ion ion-person"></i> <span>Users</span>
                    </a>
                </li>
                <li>
                    <a class="ajax" data-section="comments" id="comments-section"
                       href="<?= URL::to('admin/comments') ?>">
                        <i class="ion ion-chatbubble"></i> <span>Comments</span>
                    </a>
                </li>
                <li>
                    <a class="ajax" data-section="categories" id="categories-section"
                       href="<?= URL::to('admin/categories') ?>">
                        <i class="ion ion-ios7-albums"></i> <span>Categories</span>
                    </a>
                </li>
                <li>
                    <a class="ajax" data-section="pages" id="pages-section" href="<?= URL::to('admin/pages') ?>">
                        <i class="fa fa-file"></i> <span>Pages</span>
                    </a>
                </li>
                <li>
                    <a class="ajax" data-section="themes" id="themes-section" href="<?= URL::to('admin/themes') ?>">
                        <i class="fa fa-laptop"></i> <span>Themes</span>
                    </a>
                </li>
                <li>
                    <a class="ajax" data-section="plugins" id="plugins-section" href="<?= URL::to('admin/plugins') ?>">
                        <i class="ion ion-outlet"></i> <span>Plugins</span>
                    </a>
                </li>

                <li>
                    <a class="ajax" data-section="custom_code" id="custom_code-section"
                       href="<?= URL::to('admin/custom_code') ?>">
                        <i class="ion ion-code"></i> <span>Custom Code</span>
                    </a>
                </li>
                <li>
                    <a class="ajax" data-section="settings" id="settings-section"
                       href="<?= URL::to('admin/settings') ?>">
                        <i class="ion ion-gear-a"></i> <span>Settings</span>
                    </a>
                </li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">

        <!-- Content Header (Page header) -->
        <section class="content-header">

            <?php if(Session::get('note') != '' && Session::get('note_type') != ''): ?>
            <div class="callout callout-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?= Session::get("note"); ?>
            </div>
            <?php endif; ?>
            <h1>
                ...
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            @yield('content')

        </section>
        <!-- /.content -->
    </aside>
    <!-- /.right-side -->
</div>
<!-- ./wrapper -->

<!-- add new calendar event modal -->


<!-- handle sorting order with hidden input values -->
<?php if(Input::get('sort') != '' && Input::get('order') != ''): ?>
<input type="hidden" id="sort_order" value="<?= '?sort=' . Input::get('sort') . '&order=' . Input::get('order') ?>"/>
<?php else: ?>
<input type="hidden" id="sort_order" value=""/>
<?php endif; ?>



</body>
</html>
