@extends("gag.layouts.frontend.default")
@section("content")
    <link href="{!! asset('resources/gag/components/tagsinput/jquery.tagsinput.css') !!}" rel="stylesheet"
          type="text/css"/>
    <div class="col-md-8 col-lg-8">
        {!! Form::model($post,['id'=>'media-form','accept-charset'=>'UTF-8','enctype'=>'multipart/form-data','method'=>'post']) !!}
        <h2><i class="icon-cloud-upload"></i> <?= Lang::get('lang.upload') ?></h2>

        <!-- Select between an image or a video -->
        <div class="btn-group vid-pic" data-toggle="buttons">
            <label class="btn btn-radio active">
                <input type="radio" name="pic" id="pic" checked> <i
                        class="fa fa-picture-o"></i> <?= Lang::get('lang.image') ?>
            </label>
            <label class="btn btn-radio vid-radio-btn">
                <input type="radio" name="vid" id="vid"> <i class="icon-film"></i> <?= Lang::get('lang.video') ?>
            </label>
        </div>
        <p>
            {!! Form::text('title',$post->title,['class'=>'form-control','id'=>'title','placeholder'=>trans('lang.title')]) !!}
        </p>

        <!--TODO: categories-->

        <div style="clear:both"></div>
        <div id="img_upload" style="margin-top:25px; margin-bottom:15px;">
            <i class="fa fa-picture-o" style="font-size:50px; color:#aaa; float:left"></i>

            <p style="margin-left:65px; margin-bottom:6px;"><input type="file" id="pic_url" name="pic_url"/></p>
            <h4 style="margin-left:65px; padding-top:0px;"><?= Lang::get('lang.or_enter_url') ?></h4>

            <p><input type="text" class="form-control" id="img_url" name="img_url" style=""
                      placeholder="<?= Lang::get('lang.image_url') ?>"/></p>
        </div>

        <div id="upload_multiple_image">
            <div id="maindiv">
                <h2>Add Multiple Images Below
                    <small>(optional)</small>
                </h2>
                <div id="formdiv">
                    <div class="filediv">
                        <input name="pic_url_multi[]" type="file" id="pic_url_multi" multiple="true"/>
                    </div>
                    <div class="divider">
                        <input type="button" id="add_more" class="upload" value="+ Add More"/>
                    </div>
                </div>
            </div>
        </div>
        <div id="vid_upload"
             style="display:none; padding-left:100px; background:#f1f1f1; padding:15px; margin-top:15px; margin-bottom:15px;">
            <label for="vid_url">
                <i class="icon-film" style="font-size:50px; color:#aaa; float:left"></i>

                <p style="margin-left:65px; margin-bottom:6px; font-weight:normal; margin-top:2px;"><?= Lang::get('lang.add_a_video') ?></p>
                <h4 style="margin-left:65px; padding-top:0px; margin-top:8px;"><?= Lang::get('lang.add_video_types_below') ?>
                    :</h4>
            </label>

            <p><input type="text" name="vid_url" class="form-control" id="vid_url"
                      placeholder="<?= Lang::get('lang.add_url_here') ?>"/></p>
        </div>
        <?php if($app_settings['media_description'] == 1): ?>
        <p>{!! Form::textarea('content',$post->content,['class'=>'form-control','id'=>'description','placeholder'=>trans('lang.description')]) !!}
        <?php endif; ?>
        <p>{!! Form::text('source',$post->source,['class'=>'form-control','id'=>'link_url','placeholder'=>trans('lang.source_optional')]) !!}</p>

        <p>
            {!! Form::text('tags',null,['class'=>'form-control','id'=>'tags','placeholder'=>trans('lang.tags_optional')]) !!}
        </p>

        <p style="margin: 10px 0">
            {!! Form::label('not_safe_for_work',Lang::get('lang.nsfw')) !!}
            {!! Form::checkbox('not_safe_for_work',1,$post->not_safe_for_work,['class'=>'onoffswitch-checkbox','id'=>'nsfw']) !!}
        </p>
        <input class="btn btn-color submit-media upload" id="upload" type="submit"
               value="<?= Lang::get('lang.submit') ?>">
        {!! Form::close() !!}

        <?php if ($errors->any()): ?>
        <ul style="margin:0px; padding:0px;">
            <?= implode('', $errors->all('<li class="error">:message</li>')) ?>
        </ul>
        <?php endif; ?>
    </div>
    <script src="{!! asset('resources/gag/components/tagsinput/jquery.tagsinput.js') !!}"
            type="text/javascript"></script>
    <script src="{!! asset('resources/gag/components/tinymce/tinymce.min.js') !!}" type="text/javascript"></script>
    <?php if($app_settings['media_description'] == 1): ?>
    <script type="text/javascript">
        tinymce.init({
            selector: "#description"
        });
    </script>
    <?php endif; ?>
    <script type="text/javascript">

        $(document).ready(function () {

            $('#tags').tagsInput();

            $('#img_url').keyup(function () {
                console.log($(this).val());
                if ($(this).val() != '') {
                    $('#pic_url').attr('disabled', 'true');
                } else {
                    $('#pic_url').removeAttr('disabled');
                }
            });

            $('.vid-pic input').change(function () {
                if ($(this).attr('id') == 'pic') {
                    $('#img_upload').show();
                    $('#upload_multiple_image').show();
                    $('.drop_container').show();
                    $('#import-fb').show();
                    $('.img-drop').show();
                    $('#vid_upload').hide();
                } else {
                    console.log('hit');
                    $('#vid_upload').show();
                    $('#img_upload').hide();
                    $('#upload_multiple_image').hide();
                    $('#import-fb').hide();
                    $('.img-drop').hide();
                    $('.drop_container').hide();
                }
            });


            $('.submit-media').click(function () {
                $('#media-form').submit();
            });
        });
    </script>
    <script src="{!! asset('resources/gag/frontend/js/script_upload.js') !!}" type="text/javascript"></script>
@stop