@extends("bk.layouts.admin.default")

@section('content')
    {!! Form::open(['method'=>'get','role'=>'form','class'=>'form-horizontal']) !!}
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Posts</h3>

            <div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div class="col-lg-10">
                            {!! Form::text('q',Input::old('q',''),['class'=>'form-control','placeholder'=>'Please enter title to search']) !!}
                        </div>
                        <div class="col-lg-2 pull-left">
                            <button class="btn btn-success" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        {!! Form::select('category',$tree,Input::old('category'),['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        {!! Form::label('n','Post per page:',['class'=>'control-label col-lg-8 col-md-8']) !!}
                        <div class="col-lg-4 col-md-4">
                            {!! Form::select('n',[10=>10,20=>20,30=>30],$n,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-hover table-bordered">
                <tbody>
                <tr>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Summary</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach($posts as $post)
                    <tr>
                        <td>{!! HTML::image(Timthumb::link($post->thumbnail,100,50,1),$post->title) !!}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->summary}}</td>
                        <td>{{$post->username}}</td>
                        <td></td>
                        <td></td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            {!! $posts->render() !!}
        </div>
    </div>
    {!! Form::close() !!}

@stop