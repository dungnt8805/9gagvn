<div id="container-upload" class="box-add-img-select">
    <div id="photoReviews" class="photoReviews" style="max-height: 150px; overflow-y: scroll"></div>
    <center>
        <span class="colorG font-size16 fontB">
            <i class="fa fa-image">&nbsp;</i> {!! trans('admin.general.upload_image_text') !!}
        </span>
        <a href="javascript:;" id="addPhoto"
           class="display-b font-size11">({!! trans('admin.general.upload_image_alt_text') !!})</a>

        <div class="hide_file" style="position: absolute; height: 0px; width: 0px; overflow: hidden;display: none">
            {!! Form::file('photo',['id'=>'photo']) !!}
        </div>
    </center>
</div>
<script type="text/javascript" src="{{asset('resources/components/plupload/js/plupload.full.min.js')}}"></script>