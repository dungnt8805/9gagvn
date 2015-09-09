<div id="container-upload" class="box-add-img-select marginT10 paddingTB10 positionR">
    <div id="photoPreviews" class="photoPreviews" style="max-height: 150px; overflow-y: scroll">
        <div class="tooltip-1 positionA"
             style="top:-20px; left:45px; <?= (isset($thumbnailEntry) && $thumbnailEntry != null ? "" : "display: none;") ?>">
            <div class="row positionR">
                Bấm vào đây để chèn ảnh vào nội dung
                <div class="arrow-box-login positionA border-right-tool border-bottom-tool"
                     style="left:38px; top:17px; background-color:#FF0"></div>
            </div>
        </div>
    </div>
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

<div class="data_img" id="data_img" style="display: none;">
    <div class="thump display-in positionR">
        <div class="item-pic">
            <div class="preview_img_xINDEX">
                <img class="process_img_xINDEX" src="<?=asset('resources/funny/base/images/upload-loading.gif')?>"
                     style="position: absolute;top: 40px;">
            </div>
            <span class="positionA number number_img_xINDEX" style="display: none;"></span>

            <div class="tool positionA">
                <a href="javascript:void(0);" class="chose-pic insert_img_xINDEX"></a>

                <a href="javascript:void(0);" class="trash del_img_xINDEX"></a>
            </div>
        </div>
        <div class="paddingT7 font-size11">
            <input name="is_avatar" type="radio" class="positionR" id="<?= !empty($id) ? $id : "is_avatar_xINDEX"?>"/>
            <label for="is_avatar_xINDEX" style="cursor: pointer;">Ảnh đại diện</label>
        </div>
    </div>
</div>
@section('extend_script')
    @parent
    <script type="text/javascript" src="{{asset('resources/components/plupload/js/plupload.full.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/funny/base/js/upload_multi.js')}}"></script>
    <script type="text/javascript">
        uploadMulti.Upload('addPhoto', 'container-upload', 'medias/upload');
    </script>
@stop

