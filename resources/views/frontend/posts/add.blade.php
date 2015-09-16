@extends('layouts.frontend.default')

@section('content')
    <div class="row">
        {!! Form::model($post,['class'=>'form-horizontal']) !!}
        <div class="col-lg-9">
            <div class="form-group">
                {!! Form::label('title','Title',['class'=>'control-label col-label']) !!}

                <div class="col-input">
                    {!! Form::text('title',null,['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('summary','Summary',['class'=>'control-label col-label']) !!}

                <div class="col-input">
                    {!! Form::textarea('summary',null,['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('embed','Embed',['class'=>'control-label col-label']) !!}

                <div class="col-input">
                    {!! Form::text('embed',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
@endsection