@extends('layouts.frontend.default')

@section('content')
    <div class="row">
        {!! Form::model('post',['class'=>'form-horizontal']) !!}
            <div class="col-lg-9 col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h1 class="panel-title big">Add a fun</h1>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            {!! Form::label('title','Title',['class'=>'control-label col-label']) !!}
                            <div class="col-input">
                                {!! Form::text('title',old('title'),['id'=>'title','class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            @if($type == 'upload_from_url')
                            {!! Form::label('thumbnail','Url Image',['class'=>'control-label col-label']) !!}
                            <div class="col-input">
                                {!! Form::text('thumbnail',old('thumbnail'),['id'=>'thumbnail','class'=>'form-control']) !!}
                            </div>
                            @elseif($type == 'video')
                            {!! Form::label('embed','Video',['class'=>'control-label col-label']) !!}
                            <div class="col-input">
                                {!! Form::text('embed',old('embed'),['id'=>'embed','class'=>'form-control']) !!}
                            </div>
                            @else
                            {!! Form::label('thumbnail','Upload Image',['class'=>'control-label col-label']) !!}
                            <div class="col-input">
                                @include('layouts.commons.images.upload_image')
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('description','Description',['class'=>'control-label col-label']) !!}
                            <div class="col-input">
                                {!! Form::textarea('description',old('description'),['class'=>'form-control','rows'=>3]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('not_safe_for_work','NSFW',['class'=>'control-label col-label']) !!}
                            <div class="col-input">
                                {!! Form::checkbox('not_safe_for_work',true,old('not_safe_for_work'),['class'=>'col-checkbox']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('source','Source',['class'=>'control-label col-label']) !!}
                            <div class="col-input">
                                {!! Form::text('source',old('source'),['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h1 class="panel-title big">Categories</h1>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                           <ul class="multi-tree parent">
                            
                            </ul> 
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection