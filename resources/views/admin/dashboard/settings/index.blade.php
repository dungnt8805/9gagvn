<link rel="stylesheet" href="{!! asset('resources/components/jquery-minicolors/jquery.minicolors.css') !!}"/>
{!! Form::open(['url'=>'','id'=>'media-form','enctype'=>'multipart/form-data']) !!}
<ul>
    <li>
        <label for="website_name">{!! trans('lang.website_title') !!}</label>
        {!! Form::text('website_name',$settings['website_title'],['class'=>'form-control']) !!}
    </li>
    <li>
        <label for="website_name">{!! trans('lang.website_description') !!}</label>
        {!! Form::text('website_name',$settings['website_description'],['class'=>'form-control']) !!}
    </li>
    <li>
        @if(isset($settings['primary_color']))<?php $primary_color = $settings['primary_color'] ?>@else<?php $primary_color = ''; ?>@endif
        <label for="primary_color">{{ Lang::get('lang.primary_color') }}:</label>
        {!! Form::text('primary_color', $primary_color, array('class'=>'form-control', 'id' => 'primary_color',  'style'=> 'width:110px;'))  !!}
    </li>


    <li>
        @if(isset($settings['secondary_color']))<?php $secondary_color = $settings['secondary_color'] ?>@else<?php $secondary_color = ''; ?>@endif
        <label for="secondary_color">{{ Lang::get('lang.secondary_color') }}:</label>
        {!! Form::text('secondary_color', $secondary_color, array('class'=>'form-control', 'id' => 'secondary_color',  'style'=> 'width:110px;')) !!}
    </li>
    <li>
        <label for="like_icon">{{ Lang::get('lang.like_icon') }}:</label>
        @if(!isset($settings['like_icon']))
            <?php $settings['like_icon'] = ''; ?>
        @endif
        {!! Form::select('like_icon', array('fa-thumbs-o-up' => 'Thumbs Up', 'fa-star' => 'Star', 'fa-heart' => 'Heart', 'fa-sun-o' => 'Sun', 'fa-smile-o' => 'Smile', 'fa-check' => 'Checkmark'), $settings['like_icon'])  !!}
    </li>
    <li>
        @if(isset($settings['system_email']))<?php $system_email = $settings['system_email'] ?>@else<?php $system_email = ''; ?>@endif
        <label for="system_email">{{ Lang::get('lang.system_email') }}:</label>
        {!! Form::text('system_email', $system_email, array('class'=>'form-control'))  !!}
    </li>
    <li>
        @if(isset($settings['fb_key']))<?php $fb_key = $settings['fb_key'] ?>@else<?php $fb_key = ''; ?>@endif
        <label for="fb_key">{{ Lang::get('lang.fb_app_key') }}:</label>
        {!!  Form::text('fb_key', $fb_key, array('class'=>'form-control'))  !!}
    </li>

    <li>
        @if(isset($settings['fb_secret_key']))<?php $fb_secret_key = $settings['fb_secret_key'] ?>@else<?php $fb_secret_key = ''; ?>@endif
        <label for="fb_secret_key">{{ Lang::get('lang.fb_app_secret') }}:</label>
        {!!  Form::text('fb_secret_key', $fb_secret_key, array('class'=>'form-control')) !!}
    </li>

    <li>
        @if(isset($settings['facebook_page_id']))<?php $facebook_page_id = $settings['facebook_page_id'] ?>@else<?php $facebook_page_id = ''; ?>@endif
        <label for="facebook_page_id">{{ Lang::get('lang.fb_page_id') }}:</label>
        {!!  Form::text('facebook_page_id', $facebook_page_id, array('class'=>'form-control')) !!}
    </li>
    <li>
        <label for="auto_approve_posts">{{ Lang::get('lang.auto_approve_posts') }}:</label>

        @if(isset($settings['auto_approve_posts']))<?php $auto_approve = $settings['auto_approve_posts'] ?>@else<?php $auto_approve = 1 ?>@endif
        <div class="onoffswitch">
            {!!  Form::checkbox('auto_approve_posts', '', $auto_approve, array('class' => 'onoffswitch-checkbox', 'id' => 'auto_approve_posts'))  !!}
            <label class="onoffswitch-label" for="auto_approve_posts">
                <div class="onoffswitch-inner"></div>
                <div class="onoffswitch-switch"></div>
            </label>
        </div>

    </li>
    <li>
        <label for="user_registration">{{ Lang::get('lang.allow_user_register') }}:</label>

        @if(isset($settings['user_registration']))<?php $user_registration = $settings['user_registration'] ?>@else<?php $user_registration = 1 ?>@endif
        <div class="onoffswitch">
            {!!  Form::checkbox('user_registration', '', $user_registration, array('class' => 'onoffswitch-checkbox', 'id' => 'user_registration'))  !!}
            <label class="onoffswitch-label" for="user_registration">
                <div class="onoffswitch-inner"></div>
                <div class="onoffswitch-switch"></div>
            </label>
        </div>

        <div id="captcha_block" @if(isset($settings['user_registration']) && $settings['user_registration'] == 1) style="display:block" @endif>
            <label for="captcha">{{ Lang::get('lang.captcha_reg') }}:</label>

            @if(isset($settings['captcha']))<?php $captcha = $settings['captcha'] ?>@else<?php $captcha = 0 ?>@endif
            <div class="onoffswitch">
                {!! Form::checkbox('captcha', '', $captcha, array('class' => 'onoffswitch-checkbox', 'id' => 'captcha'))  !!}
                <label class="onoffswitch-label" for="captcha">
                    <div class="onoffswitch-inner"></div>
                    <div class="onoffswitch-switch"></div>
                </label>
            </div>

            <div id="captcha_info" @if(isset($settings['captcha']) && $settings['captcha'] == 1) style="display:block" @endif>

                @if(isset($settings['captcha_public_key']))<?php $captcha_public_key = $settings['captcha_public_key'] ?>@else<?php $captcha_public_key = ''; ?>@endif
                <label for="captcha_public_key">{{ Lang::get('lang.captcha_public_key') }}:</label>
                {!!  Form::text('captcha_public_key', $captcha_public_key, array('class'=>'form-control'))  !!}

                @if(isset($settings['captcha_private_key']))<?php $captcha_private_key = $settings['captcha_private_key'] ?>@else<?php $captcha_private_key = ''; ?>@endif
                <label for="captcha_private_key">{{ Lang::get('lang.captcha_private_key') }}:</label>
                {!!  Form::text('captcha_private_key', $captcha_private_key, array('class'=>'form-control'))  !!}

            </div>

        </div>
    </li>
</ul>
{!! Form::close() !!}

<script type="text/javascript" src="{!! asset('resources/components/jquery-minicolors/jquery.minicolors.min.js') !!}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('input#primary_color, input#secondary_color').minicolors();

        $('#enable_watermark').change(function(){
            $('.enable_watermark_info').slideToggle();
        });

        $('#pages_in_menu').change(function(){
            $('#pages_in_menu_text_block').slideToggle();
        });

        $('#infinite_scroll').change(function(){
            $('#infinite_scroll_load_more_block').slideToggle();
        });

        $('#user_registration').change(function(){
            $('#captcha_block').slideToggle();
        });

        $('#captcha').change(function(){
            $('#captcha_info').slideToggle();
        });

    });
</script>