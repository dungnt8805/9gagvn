<li class="dropdown">
    <a href="" class="visible-xs"><span>
                        <i class="fa fa-user">
                            Login / Register
                        </i>
                    </span></a>
    <a class="dropdown-toggle profile-link guest hidden-xs" href="#" data-toggle="dropdown">
        <i class="fa fa-user"></i> Login
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
                {!! Form::label('login_email','Email',['class'=>'control-label']) !!} {!! Form::text('email',null,['class'=>'form-control','id'=>'login_email','type'=>'email','size'=>30,'placeholder'=>'Email@example.com']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('login_password','Password',['class'=>'control-label']) !!} {!! Form::text('password',null,['class'=>'form-control','type'=>'password','id'=>'login_password','size'=>30,'placeholder'=>'Password']) !!} {!! Form::hidden('remember',1,['id'=>'remember'])
                !!}
                <a href="" class="pull-right small">Forgot Password ?</a>

                <div class="clearfix"></div>
            </div>
            <div class="ajax-login-footer">
                <a class="btn btn-link" id="register-button">Create new profile
                                    <i class="fa fa-caret-right"></i>
                                </a>

                <div class="action pull-right">
                    <span id="login-ajax-wait" class="hide"><i class="mini-loader"></i></span> {!! Form::submit('Log In',['class'=>'btn btn-primary','id'=>'loginButton']) !!}
                </div>
            </div>
            {!! Form::close() !!} {!! Form::open(['id'=>'ajax-signup-form','class'=>'form-vertical','role'=>'form','style'=>'display:none']) !!}
            <div class="form-group">
                {!! Form::label('first_name','First Name',['class'=>'control-label hide']) !!} {!! Form::text('first_name',null,['class'=>'form-control','id'=>'first_name','size'=>30,'placeholder'=>'First Name']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('last_name','Last Name',['class'=>'control-label hide']) !!} {!! Form::text('last_name',null,['class'=>'form-control','id'=>'last_name','size'=>30,'placeholder'=>'Last Name']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email','Email',['class'=>'control-label hide']) !!} {!! Form::text('email',null,['class'=>'form-control','id'=>'email','type'=>'email','size'=>30,'placeholder'=>'Email@example.com']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password','Password',['class'=>'control-label hide']) !!} {!! Form::text('password',null,['class'=>'form-control','id'=>'password','type'=>'password','size'=>30,'placeholder'=>'Password']) !!}
            </div>
            <div class="form-group checkbox">
                <label class="control-label" for="agree">
                    {!! Form::checkbox("agree",null,['id'=>"agree"]) !!} I agree to the <a href="" target="_blank">Terms Of Service</a>
                </label>
            </div>
            <div class="ajax-login-footer">
                <a class="btn btn-link" id="register-button-back"><i class="fa fa-caret-left"></i> Back to login</a>

                <div class="action pull-right">
                    <span id="register-ajax-wait" class="hide"><i class="mini-loader"></i></span> {!! Form::submit('Signup',['class'=>'btn btn-primary', 'id'=>'registerButton']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</li>