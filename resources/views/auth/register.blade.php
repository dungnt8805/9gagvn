@extends("gag.layouts.frontend.default")
@section("content")
    @if(session()->has('error'))
        @include('partials/error', ['type' => 'danger', 'message' => session('error')])
    @endif
    {!! Form::open(['url'=>'register','class'=>'form-signin']) !!}
    <h2 class="form-login-heading">{!! trans('lang.sign_up_with') !!}</h2>
    <div class="social-signup">
        <a class="facebook-signup" href="{!! route('auth.facebook') !!}"></a>
        <a class="google-signup" href=""></a>
    </div>
    <div class="line"></div>
    <h2 class="form-login-heading-second">{!! trans('lang.or_signup_with') !!}</h2>
    <div class="line"></div>
    {!! Form::text('name',old('name'),['class'=>'form-control','placeholder'=>trans('lang.name')]) !!}
    {!! Form::text('email',old('email'),['class'=>'form-control off-border-radius','placeholder'=>trans('lang.email_address')]) !!}
    {!! Form::password('password',['class'=>'form-control off-border-radius off-margin','placeholder'=>trans('lang.password')]) !!}
    {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>trans('lang.confirm_password')]) !!}
    {!! Form::hidden('redirectTo',Input::get('redirectUrl','/')) !!}
    {!! Form::button(trans('lang.sign_up'),['type'=>'submit','class'=>'btn btn-lg btn-block btn-color']) !!}
    {!! Form::close() !!}
    @include('auth.includes.background')
@stop

