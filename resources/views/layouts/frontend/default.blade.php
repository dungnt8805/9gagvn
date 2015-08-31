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
                <li class="dropdown">
                    <a href="" class="visible-xs"><span>
                        <i class="fa fa-user">
                            Login / Register
                        </i>
                    </span></a>
                    <a class="dropdown-toggle profile-link guest" href="#" data-toggle="dropdown">
                        <i class="fa fa-user"></i>
                            Login
                        <b class="caret"></b>
                    </a>
                    <div class="dropdown-menu login-form">
                        <div id="ajax-login">
                            <div id="ajax-login-header">Login to 9gag</div>
                            <div id="fb_login_form">
                                <a href="#" class="facebookConnectButton">
                                    <span class="facebookLoginButton">
                                        <span id="facebookLoginButtonLogo">
                                            Login with 
                                            <span class="notranslate">Facebook</span>
                                        </span>
                                    </span>
                                </a>
                            </div>
                            {!! Form::open(['class'=>'form-vertical','role'=>'form']) !!}
                            <div class="form-group">
                                {!! Form::label('login_email','Email',['class'=>'control-label']) !!}
                                {!! Form::text('email',null,['class'=>'form-control','id'=>'login_email','type'=>'email','size'=>30,'placeholder'=>'Email@example.com']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('login_password','Password',['class'=>'control-label']) !!}
                                {!! Form::text('password',null,['class'=>'form-control','type'=>'password','id'=>'login_password','size'=>30,'placeholder'=>'Password']) !!}
                                {!! Form::hidden('remember',1,['id'=>'remember']) !!}
                                <a href="" class="pull-right small">Forgot Password ?</a>
                            
                                <div class="clearfix"></div>
                            </div>
                            <div class="ajax-login-footer">
                                <a class="btn btn-link" id="register-button">Create new profile
                                    <i class="fa fa-caret-right"></i>
                                </a>
                            
                                <div class="action pull-right">
                                    <span id="login-ajax-wait" class="hide"><i class="mini-loader"></i></span>
                                    {!! Form::submit('Log In',['class'=>'btn btn-primary','id'=>'loginButton']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                            
                            {!! Form::open(['id'=>'ajax-signup-form','class'=>'form-vertical','role'=>'form']) !!}
                            <div class="form-group">
                                {!! Form::label('first_name','First Name',['class'=>'control-label hide']) !!}
                                {!! Form::text('first_name',null,['class'=>'form-control','id'=>'first_name','size'=>30,'placeholder'=>'First Name']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('last_name','Last Name',['class'=>'control-label hide']) !!}
                                {!! Form::text('last_name',null,['class'=>'form-control','id'=>'last_name','size'=>30,'placeholder'=>'Last Name']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('email','Email',['class'=>'control-label hide']) !!}
                                {!! Form::text('email',null,['class'=>'form-control','id'=>'email','type'=>'email','size'=>30,'placeholder'=>'Email@example.com']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('password','Password',['class'=>'control-label hide']) !!}
                                {!! Form::text('password',null,['class'=>'form-control','id'=>'password','type'=>'password','size'=>30,'placeholder'=>'Password']) !!}
                            </div>
                            <div class="form-group checkbox">
                                <label class="control-label" for="agree">
                                    {!! Form::checkbox("agree",null,['id'=>"agree"]) !!}
                                    I agree to the <a href="" target="_blank">Terms Of Service</a>
                                </label>
                            </div>
                            <div class="ajax-login-footer">
                                <a class="btn btn-link" id="register-button-back"><i class="fa fa-caret-left"></i> Back to login</a>
                            
                                <div class="action pull-right">
                                    <span id="register-ajax-wait" class="hide"><i class="mini-loader"></i></span>
                                    {!! Form::submit('Signup',['class'=>'btn btn-primary', 'id'=>'registerButton']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </li>
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

        <!-- jQuery 2.1.4 -->
<script src="{{asset('resources/components/jquery-2.1.4.min.js')}}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{asset('resources/components/bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>