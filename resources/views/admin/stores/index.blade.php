@extends('layouts.admin.default')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">

                    </h3>

                </div>
                {!! Form::model($store,['role'=>'form']) !!}
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('title','Title') !!}
                        {!! Form::text('title',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('link','Link') !!}
                        {!! Form::text('link',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('address','Address') !!}
                        {!! Form::textarea('address',null,['class'=>'form-control','rows'=>3]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description','Summary') !!}
                        {!! Form::textarea('description',null,['class'=>'form-control','rows'=>3]) !!}
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">

                    </h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <td>Thumbnail</td>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Link</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stores as $s)
                            <tr>
                                <td>

                                </td>
                                <td>{!! $s->title !!}</td>
                                <td>{!! $s->slug !!}</td>
                                <td>{!! $s->link !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection