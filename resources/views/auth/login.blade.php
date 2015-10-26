@extends('gag.layouts.frontend.default')
@section("content")
    @if(Session::has('error'))
        {!! session('error') !!}
    @endif
    {!! Form::open(['url'=>'login', 'class'=>'form-signin']) !!}
    <h2 class="form-login-heading">{!! trans('lang.sign_in_with') !!}</h2>
    <div class="social-signup">
        <a class="facebook-signup" href="{!! route('auth.facebook') !!}"></a>
        <a class="google-signup" href=""></a>
    </div>
    <div class="line"></div>
    <h2 class="form-login-heading-second">{!! trans('lang.or_sign_in_with') !!}</h2>
    <div class="line"></div>
    {!! Form::text('email',null,['class'=>'form-control','placeholder'=>trans('lang.username_or_email'),'id'=>'email','autofocus']) !!}
    {!! Form::password('password',['class'=>'form-control','placeholder'=>trans('lang.password'),'id'=>'password']) !!}
    {!! Form::hidden('redirectTo',Input::get('redirectUrl','/'),['id'=>'redirectUrl']) !!}
    {!! Form::button(trans('lang.sign_in'),['class'=>'btn btn-lg btn-block btn-color btn-signin','type'=>'submit']) !!}
    <a href="" class="reset_password"
       style="width: 100%; text-align: center; display: block">{!! trans('lang.forgot_password') !!}</a>
    {!! Form::close() !!}
    <div id="overlay"></div>
    @include('auth.includes.background')
@stop