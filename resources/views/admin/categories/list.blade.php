<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.categories.add')}}</h3>
                @if($errors->all())
                    <div class="bs-callout bs-callout-danger">
                        {!! HTML::ul($errors->all()) !!}
                    </div>
                @endif
            </div>
            {!! Form::model($category,['role'=>'form']) !!}
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
            </div>
            {!! Form::close() !!}

        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.categories.index')}}</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $value)
                        <tr>
                            <td>{{$value['title']}}</td>
                            <td>{{$value['slug']}}</td>
                            <td>
                                <div class="btn-group pull-right">
                                    <a class="btn btn-primary btn-xs"
                                       href="{{url('admin/categories/view/'.$value['id'])}}">{{ trans('admin.actions.edit') }}</a>
                                    <a class="delete_toggler btn btn-danger btn-xs"
                                       rel="{{$value['id']}}">{{ trans('admin.actions.delete') }}</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>