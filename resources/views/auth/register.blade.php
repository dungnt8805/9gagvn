@extends("layouts.frontend.default")
@section("content")
<div class="col-md-6 col-md-offset-3 col-xs-12 col-xs-offset-0 centered-page">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1 class="panel-title big">Create new user</h1>
        </div>
        <div class="panel-body">
            {!! Form::open(['url'=>'/auth/register','class'=>'form-vertical']) !!}
                <div class="form-group">
                    {!! Form::label('name','Name') !!}
                    <div class="controls">
                        {!! Form::text('name',old('name'),['class'=>'form-control input-lg','id'=>'name']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('email','Email') !!}
                    <div class="controls">
                        {!! Form::text('email', old('email'),['class'=>'form-control input-lg','id'=>'email']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('password','Password') !!}
                    <div class="controls">
                        {!! Form::password('password', ['class'=>'form-control input-lg','id'=>'password','type'=>'password']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('password_confirmation','Password Confirmation') !!}
                    <div class="controls">
                        {!! Form::password('password_confirmation', ['class'=>'form-control input-lg','id'=>'password_confirmation','type'=>'password']) !!}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Signup</button>
                {!! HTML::link('/auth/login','Login',['class'=>'btn btn-link pull-right']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop