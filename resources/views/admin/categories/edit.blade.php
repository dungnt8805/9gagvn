@extends('layouts.admin.default')

@section('content')
    <div class="row">

        <div class="col-lg-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{!! trans('admin.categories.edit') !!}

                    </h3>
                    @if($errors->all())
                        <div class="bs-callout bs-callout-danger">
                            <h4>{!! trans('admin.please_fix_errors') !!}</h4>
                            {!!  HTML::ul($errors->all()) !!}
                        </div>
                    @endif
                </div>
                {!! Form::model($category,['role'=>'form']) !!}
                {!! Form::hidden('id') !!}
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('title','Title') !!}
                        {!! Form::text('title',null, ['class'=>'form-control','placeholder'=>'Please enter category title']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('slug','Slug') !!}
                        {!! Form::text('slug',null,['class'=>'form-control','placeholder'=>'Please enter category slug']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('parent_id','Parent') !!}
                        {!! Form::select('parent_id',$tree,null,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description','Description') !!}
                        {!! Form::textarea('description',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{ url('admin/categories')}}" class="btn btn-danger">{{ trans('admin.actions.cancel') }}</a>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
@endsection