<div id="sidebar_inner-sticky-wrapper" class="sticky-wrapper" style="height: auto">
    <div id="sidebar_inner">
        <div id="sidebar" style="margin-top:15px">
            <a class="spcl-button color"
               href="{!! route('post.add') !!}">{!! trans('lang.submit_pic_or_video') !!}</a>
            @include('gag.frontend.includes.sidebar_top_user')

            <div class="social_block">
                <img src="">
                <iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2F{!! $app_settings['fb_page_id'] !!}&amp;width&amp;height=220&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false"
                        scrolling="no" frameborder="0" allowtransparency="true"></iframe>
            </div>
        </div>
    </div>
</div>