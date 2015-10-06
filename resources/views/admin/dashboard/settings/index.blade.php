<link rel="stylesheet" href="{!! asset('resources/components/jquery-minicolors/jquery.minicolors.css') !!}"/>
{!! Form::open(['url'=>'/admin/settings','id'=>'media-form','enctype'=>'multipart/form-data']) !!}
<ul>
    <li>
        <label for="website_title">{!! trans('lang.website_title') !!}</label>
        {!! Form::text('website_title',$settings['website_title'],['class'=>'form-control']) !!}
    </li>
    <li>
        <label for="website_description">{!! trans('lang.website_description') !!}</label>
        {!! Form::text('website_description',$settings['website_description'],['class'=>'form-control']) !!}
    </li>
    <li>
        @if(isset($settings['primary_color']))<?php $primary_color = $settings['primary_color'] ?>@else<?php $primary_color = ''; ?>@endif
        <label for="primary_color">{!! Lang::get('lang.primary_color') !!}:</label>
        {!! Form::text('primary_color', $primary_color, array('class'=>'form-control', 'id' => 'primary_color',  'style'=> 'width:110px;'))  !!}
    </li>


    <li>
        @if(isset($settings['secondary_color']))<?php $secondary_color = $settings['secondary_color'] ?>@else<?php $secondary_color = ''; ?>@endif
        <label for="secondary_color">{!! Lang::get('lang.secondary_color') !!}:</label>
        {!! Form::text('secondary_color', $secondary_color, array('class'=>'form-control', 'id' => 'secondary_color',  'style'=> 'width:110px;')) !!}
    </li>
    <li>
        <label for="like_icon">{!! Lang::get('lang.like_icon') !!}:</label>
        @if(!isset($settings['like_icon']))
            <?php $settings['like_icon'] = ''; ?>
        @endif
        {!! Form::select('like_icon', array('fa-thumbs-o-up' => 'Thumbs Up', 'fa-star' => 'Star', 'fa-heart' => 'Heart', 'fa-sun-o' => 'Sun', 'fa-smile-o' => 'Smile', 'fa-check' => 'Checkmark'), $settings['like_icon'])  !!}
    </li>
    <li>
        @if(isset($settings['system_email']))<?php $system_email = $settings['system_email'] ?>@else<?php $system_email = ''; ?>@endif
        <label for="system_email">{!! Lang::get('lang.system_email') !!}:</label>
        {!! Form::text('system_email', $system_email, array('class'=>'form-control'))  !!}
    </li>
    <li>
        @if(isset($settings['fb_key']))<?php $fb_key = $settings['fb_key'] ?>@else<?php $fb_key = ''; ?>@endif
        <label for="fb_key">{!! Lang::get('lang.fb_app_key') !!}:</label>
        {!!  Form::text('fb_key', $fb_key, array('class'=>'form-control'))  !!}
    </li>

    <li>
        @if(isset($settings['fb_secret_key']))<?php $fb_secret_key = $settings['fb_secret_key'] ?>@else<?php $fb_secret_key = ''; ?>@endif
        <label for="fb_secret_key">{!! Lang::get('lang.fb_app_secret') !!}:</label>
        {!!  Form::text('fb_secret_key', $fb_secret_key, array('class'=>'form-control')) !!}
    </li>

    <li>
        @if(isset($settings['facebook_page_id']))<?php $facebook_page_id = $settings['facebook_page_id'] ?>@else<?php $facebook_page_id = ''; ?>@endif
        <label for="facebook_page_id">{!! Lang::get('lang.fb_page_id') !!}:</label>
        {!!  Form::text('facebook_page_id', $facebook_page_id, array('class'=>'form-control')) !!}
    </li>
    <li>
        <label for="auto_approve_posts">{!! Lang::get('lang.auto_approve_posts') !!}:</label>

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
        <label for="user_registration">{!! Lang::get('lang.allow_user_register') !!}:</label>

        @if(isset($settings['user_registration']))<?php $user_registration = $settings['user_registration'] ?>@else<?php $user_registration = 1 ?>@endif
        <div class="onoffswitch">
            {!!  Form::checkbox('user_registration', '', $user_registration, array('class' => 'onoffswitch-checkbox', 'id' => 'user_registration'))  !!}
            <label class="onoffswitch-label" for="user_registration">
                <div class="onoffswitch-inner"></div>
                <div class="onoffswitch-switch"></div>
            </label>
        </div>

        <div id="captcha_block" @if(isset($settings['user_registration']) && $settings['user_registration'] == 1) style="display:block" @endif>
            <label for="captcha">{!! Lang::get('lang.captcha_reg') !!}:</label>

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
                <label for="captcha_public_key">{!! Lang::get('lang.captcha_public_key') !!}:</label>
                {!!  Form::text('captcha_public_key', $captcha_public_key, array('class'=>'form-control'))  !!}

                @if(isset($settings['captcha_private_key']))<?php $captcha_private_key = $settings['captcha_private_key'] ?>@else<?php $captcha_private_key = ''; ?>@endif
                <label for="captcha_private_key">{!! Lang::get('lang.captcha_private_key') !!}:</label>
                {!!  Form::text('captcha_private_key', $captcha_private_key, array('class'=>'form-control'))  !!}

            </div>

        </div>
    </li>
    <li>
					<label for="infinite_scroll">{!! Lang::get('lang.enable_infinite_scr') !!}:</label>

					@if(isset($settings['infinite_scroll']))<?php $infinite_scroll = $settings['infinite_scroll'] ?>@else<?php $infinite_scroll = 1 ?>@endif
					<div class="onoffswitch">
						{!! Form::checkbox('infinite_scroll', '', $infinite_scroll, array('class' => 'onoffswitch-checkbox', 'id' => 'infinite_scroll')) !!}					   
					    <label class="onoffswitch-label" for="infinite_scroll">
					        <div class="onoffswitch-inner"></div>
					        <div class="onoffswitch-switch"></div>
					    </label>
					</div>

					<div id="infinite_scroll_load_more_block" @if(isset($settings['infinite_scroll']) && $settings['infinite_scroll'] == 1) style="display:block" @else style="display:none" @endif>
						<label for="infinite_scroll_load_more">{!! Lang::get('lang.infinite_scr_load') !!}:</label>

						@if(isset($settings['infinite_load_btn']))<?php $infinite_load_btn = $settings['infinite_load_btn'] ?>@else<?php $infinite_load_btn = 1 ?>@endif
						<div class="onoffswitch">
							{!! Form::checkbox('infinite_load_btn', '', $infinite_load_btn, array('class' => 'onoffswitch-checkbox', 'id' => 'infinite_load_btn')) !!}					   
						    <label class="onoffswitch-label" for="infinite_load_btn">
						        <div class="onoffswitch-inner"></div>
						        <div class="onoffswitch-switch"></div>
						    </label>
						</div>
					</div>
				</li>
    <li>
					<label for="random_bar_enabled">{!! Lang::get('lang.random_bar_enabled') !!}:</label>

					@if(isset($settings['random_bar_enabled']))<?php $random_bar_enabled = $settings['random_bar_enabled'] ?>@else<?php $random_bar_enabled = 1 ?>@endif
					<div class="onoffswitch">
						{!! Form::checkbox('random_bar_enabled', '', $random_bar_enabled, array('class' => 'onoffswitch-checkbox', 'id' => 'random_bar_enabled')) !!}					   
					    <label class="onoffswitch-label" for="random_bar_enabled">
					        <div class="onoffswitch-inner"></div>
					        <div class="onoffswitch-switch"></div>
					    </label>
					</div>
				</li>
	<li>
					<label for="enable_watermark">{!! Lang::get('lang.enable_watermark') !!}:</label>

					@if(isset($settings['enable_watermark']))<?php $enable_watermark = $settings['enable_watermark'] ?>@else<?php $enable_watermark = 1 ?>@endif
					<div class="onoffswitch">
						{!! Form::checkbox('enable_watermark', '', $enable_watermark, array('class' => 'onoffswitch-checkbox', 'id' => 'enable_watermark')) !!}					   
					    <label class="onoffswitch-label" for="enable_watermark">
					        <div class="onoffswitch-inner"></div>
					        <div class="onoffswitch-switch"></div>
					    </label>
					</div>
					<div class="enable_watermark_info" @if(isset($settings['enable_watermark']) && $settings['enable_watermark'] == 1) style="display:block" @endif>
						<div class="image">
							<label for="watermark_image">{!! Lang::get('lang.watermark') !!}:</label>
							<img src="{!! Config::get('site.uploads_dir') . '/settings/' . $settings['watermark_image'] !!}" width="auto" />
							<input type="file" name="watermark_image" id="watermark_image" style="margin-top:10px;" />
						</div>
						<div class="position">
							<label for="watermark_position">{!! Lang::get('lang.watermark_position') !!}:</label>
							@if(!isset($settings['watermark_position']))
								<?php $settings['watermark_position'] = 'bottom-right'; ?>
							@endif
							{!! Form::select('watermark_position', array('top-left' => 'Top Left', 'top-center' => 'Top Center', 'top-right' => 'Top Right', 'left' => 'Left', 'center' => 'Center', 'right' => 'Right', 'bottom-left' => 'Bottom Left', 'bottom' => 'Bottom', 'bottom-right' => 'Bottom Right'), $settings['watermark_position']) !!}
						</div>

						<div class="clear" style="padding-top:20px;"></div>
						<label for="watermark_offset_x">{!! Lang::get('lang.watermark_offset_x') !!}:</label>
						{!! Form::text('watermark_offset_x', $settings['watermark_offset_x'], array('class'=>'form-control')) !!}

						<label for="watermark_offset_y">{!! Lang::get('lang.watermark_offset_y') !!}:</label>
						{!! Form::text('watermark_offset_y', $settings['watermark_offset_y'], array('class'=>'form-control')) !!}
						<div class="clear"></div>
					</div>
				</li>
	<li>
					<label for="pages_in_menu">{{ Lang::get('lang.pages_in_menu') }}:</label>

					@if(isset($settings['pages_in_menu']))<?php $pages_in_menu = $settings['pages_in_menu'] ?>@else<?php $pages_in_menu = 1 ?>@endif
					<div class="onoffswitch">
						{!! Form::checkbox('pages_in_menu', '', $pages_in_menu, array('class' => 'onoffswitch-checkbox', 'id' => 'pages_in_menu')) !!}					   
					    <label class="onoffswitch-label" for="pages_in_menu">
					        <div class="onoffswitch-inner"></div>
					        <div class="onoffswitch-switch"></div>
					    </label>
					</div>

					<div id="pages_in_menu_text_block" @if(isset($settings['pages_in_menu']) && $settings['pages_in_menu'] == 1) style="display:block" @else style="display:none" @endif>
						@if(isset($settings['pages_in_menu_text']))<?php $pages_in_menu_text = $settings['pages_in_menu_text'] ?>@else<?php $pages_in_menu_text = ''; ?>@endif
						<label for="pages_in_menu_text">{{ Lang::get('lang.pages_in_menu_text') }}:</label>
						{!! Form::text('pages_in_menu_text', $pages_in_menu_text, array('class'=>'form-control')) !!}
					</div>

				</li>
	<li>
					@if(isset($settings['analytics']))<?php $analytics = $settings['analytics'] ?>@else<?php $analytics = ''; ?>@endif
					<label for="analytics">{{ Lang::get('lang.analytics_code') }}:</label>
					{!! Form::textarea('analytics', $analytics, array('class'=>'form-control')) !!}
				</li>
	<li style="min-height:45px">
					<input type="submit" class="btn btn-color pull-right" value="{{ Lang::get('lang.update_settings') }}" />
				</li>
				<div style="clear:both"></div>
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