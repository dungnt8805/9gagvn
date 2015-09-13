@extends("layouts.admin.default")
@section("content")
    <div class="row">
        {!! Form::model($post,['role'=>'form']) !!}
        <div class="col-lg-9 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{!! trans('admin.post.new') !!}</h3>
                    @if($errors->all())
                        <div class="bs-callout bs-callout-danger">
                            {!! HTML::ul($errors->all()) !!}
                        </div>
                    @endif
                </div>

                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('title','Title') !!}
                        {!! Form::text('title',null,['class'=>'form-control','placeholder'=>'Please enter post title']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('thumbnail','Thumbnail') !!}
                        @include('layouts.commons.images.upload_image')
                    </div>
                    <div class="form-group">
                        {!! Form::label('summary','Summary') !!}
                        {!! Form::textarea('summary',null,['class'=>'form-control','rows'=>3]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('content','Content') !!}
                        {!! Form::textarea('content',null,['id'=>'ckeditor','class'=>'ckeditor form-control']) !!}
                    </div>
                </div>
                <div class="box-footer"></div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{!! trans('admin.categories.index') !!}</h3>
                </div>
                <div class="box-body">
                    {!! $multi !!}
                </div>
                <div class="box-footer"></div>
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{!! trans('admin.tags.index') !!}</h3>
                </div>
                <div class="box-body">
                    {!! Form::text('tags',null,['class'=>'form-control']) !!}
                </div>
                <div class="box-footer"></div>
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{!! trans('admin.') !!}</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::select('active',[0=>"Hidden",1=>"Show"],null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="box-footer">
                    {!! Form::submit('Submit',['class'=>'btn btn-success']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop