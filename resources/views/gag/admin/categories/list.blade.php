@extends("gag.layouts.admin.default")
@section("content")
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
                    {{--<div class="form-group">--}}
                    {{--{!! Form::label('slug','Slug') !!}--}}
                    {{--{!! Form::text('slug',null,['class'=>'form-control','placeholder'=>'Please enter category slug']) !!}--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                    {{--{!! Form::label('parent_id','Parent') !!}--}}
                    {{--{!! Form::select('parent_id',$tree,null,['class'=>'form-control']) !!}--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                    {{--{!! Form::label('description','Description') !!}--}}
                    {{--{!! Form::textarea('description',null,['class'=>'form-control']) !!}--}}
                    {{--</div>--}}
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
                                    {{--<div class="btn-group pull-right">--}}
                                    {{--<a class="btn btn-primary btn-xs"--}}
                                    {{--href="{{url('admin/categories/view/'.$value['id'])}}">{{ trans('admin.actions.edit') }}</a>--}}
                                    {{--<a class="delete_toggler btn btn-danger btn-xs"--}}
                                    {{--rel="{{$value['id']}}">{{ trans('admin.actions.delete') }}</a>--}}
                                    {{--</div>--}}
                                    <div class="btn-group pull-right">
                                        <a href="#" data-toggle="modal" data-target="#edit-{!! $value['id'] !!}"
                                           class="btn btn-xs btn-primary edit-category">
                                            <span class="fa fa-edit"></span>{!! trans('lang.edit') !!}
                                        </a>
                                        <a href="" class="delete_toggle btn btn-danger btn-xs"
                                           rel="{!! $value['id'] !!}">
                                            <span class="fa fa-trash-o"></span>
                                            {!! trans('lang.delete') !!}</a>
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
    @foreach($list as $value)
            <!-- Modal -->
    <div class="modal fade" id="edit-{{ $value['id'] }}" data-id="{{ $value['id'] }}" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">{{ Lang::get('lang.editing') }} {{ $value['title'] }}</h4>
                </div>
                <form method="POST" action="{{ URL::to('/admin/categories/view') . '/' . $value['id'] }}"
                      accept-charset="UTF-8">
                    {!! Form::token() !!}
                    <div class="modal-body">
                        <ul>
                            <li>
                                <label for="title">{{ Lang::get('lang.name') }}</label>
                                <input type="text" class="form-control" name="title"
                                       value="{{ $value['title'] }}"/>
                            </li>
                        </ul>
                    </div>
                    <!-- .modal-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal">{{ Lang::get('lang.cancel') }}</button>
                        <input type="submit" class="btn btn-success" value="Update Category"/>
                    </div>
                </form>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach

    <script type="text/javascript">
        $(document).ready(function () {
            $('.edit-category').click(function () {
                $(window).scrollTop(0);
            });
        });
    </script>
@stop