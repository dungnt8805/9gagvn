@extends("gag.layouts.frontend.default")
@section("content")
    <style type="text/css">
        .item-large {
            width: 100%;
        }
    </style>
    @if(!is_null($logged_user) && ($logged_user->id = $post->user_id))
    @endif

    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <div class="container main_home_container single">
        <div class="single-left col-md-8 col-lg-8 col-sm-12">
            <div class="col-sm-12 item animated single-left" data-href="{!! $post->getLink() !!}">
                <!-- media item-->
                <div class="item-large">
                    <div class="single-title">
                        <a href="">
                            <img src="{!! Timthumb::link($post->avatar,null,null,null) !!}"
                                 class="img-circle user-avatar-medium"/>

                            <h2 class="item-title">
                                <a href="{!! $post->getLink() !!}" alt="{!! $post->title !!}">
                                    {!! stripslashes($post->title) !!}
                                </a>
                            </h2>
                        </a>

                        <div class="item-details">
                            <p class="details"><?= Lang::get('lang.submitted_by') ?>: <a href="">{!! $post->name !!}</a>
                                <?= Lang::get('lang.submitted_on') ?> <?= date("F j, Y", strtotime($post->created_at)) ?>
                            </p>

                            <p class="home-like-count">
                                <i class="fa <?= $app_settings['like_icon'] ?>"></i> <span><? ?></span></p>

                            <p class="home-comment-count"><i class="fa fa-comments"></i></p>

                            <p class="home-view-count"><i class="fa fa-eye"></i>
                                {!! $post->views !!}
                            </p>
                        </div>
                        <!-- check like -->

                    </div>
                    <div class="clearfix"></div>

                    @if($post->not_safe_for_work && is_null($logged_user))
                    @else
                        @if($post->type == \App\Funny\Models\Post::PHOTO_TYPE)
                        @elseif($post->type == \App\Funny\Models\Post::VIDEO_TYPE)

                            <div calss="video_container <?php if(strpos($post->video_url, 'vine') > 0){ echo 'vine'; } ?>">
                                @if(strpos($post->video_url,'youtube') > 0 || strpos($post->video_url,'youtu.be') >0)
                                    <iframe title="YouTube video player" class="youtube-player" type="text/html"
                                            width="640"
                                            height="360"
                                            src="http://www.youtube.com/embed/<?= $post->youtube_id?>?theme=light&rel=0"
                                            frameborder="0"
                                            allowFullScreen></iframe>
                                @elseif(strpos($post->video_url,'vimeo') > 0)
                                    <?php $vimeo_id = (int)substr(parse_url($post->video_url,PHP_URL_PATH),1);?>
                                    <iframe src="//player.vimeo.com/video/{!! $vimeo_id !!}" width="640px"
                                            height="360px" frameborder="0" webkitallowfullscreen mozallowfullscreen
                                            allowfullscreen>
                                    </iframe>
                                @elseif(strpos($post->video_url,'vine') >0)
                                    <?php $include_embed = (strpos($post->video_url,'/embed')) ? '':'/embed';?>
                                    <img class="single-media vine-thumbnail" style="cursor: pointer" alt="..."
                                         src="{!! $post->thumbnail !!}"
                                         data-embed="{!! $post->video_url.$include_embed !!}/simple?audio=1"/>
                                    <p class="vine-thumbnail-play"
                                       data-embed="{!! $post->video_url.$include_embed !!}/simple?audio=1"
                                       style="color:#fff; color:rgba(255, 255, 255, 0.6); font-size:50px; position:absolute; z-index:999; width:50px; height:50px; top:50%; left:50%; margin:0px; padding:0px; margin-left:-30px; margin-top:-30px; cursor:pointer;">
                                        <i class="fa fa-play-circle-o"></i>
                                    </p>
                                @endif
                            </div>
                        @endif
                    @endif
                </div>
                <!-- end media item -->
                <div class="clearfix"></div>
                <div id="below_media">
                    <div class="social-icons">
                        <ul class="socialcount socialcount-large" data-url="{!! $post->getLink() !!}"
                            style="width: 100%; position: relative; right: 0px">
                            <li class="facebook">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={!! $post->getLink() !!}"
                                   target="_blank" title="{!! trans('lang.share_facebook') !!}"
                                   onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizeable=no,scrollbars=no,height=400,width=600'); return false;">
                                    <span class="fa fa-facebook"></span>
                                    <span class="count">{!! trans('lang.like') !!}</span>
                                </a>
                            </li>
                            <li class="twitter" data-share-text="{!! $post->title !!}">
                                <a href="https://twitter.com/intent/tweet?url={!! $post->getLink() !!}&text={!! $post->title !!}"
                                   data-url="{!! $post->getLink() !!}" title="{!! trans('lang.share_twitter') !!}"
                                   onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizeable=no,scrollbars=no,height=400,width=600');return false;">
                                    <span class="fa fa-twitter" data-url="{!! $post->getLink() !!}"></span>
                                    <span class="count">{!! trans('lang.tweet') !!}</span>
                                </a>
                            </li>
                            <li class="googleplus">
                                <a href="https://plus.google.com/share?url={!! $post->getLink() !!}"
                                   target="_blank"
                                   title="<?= Lang::get('lang.share_google') ?>"
                                   onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=400,width=600');return false;">
                                    <span class="fa fa-google-plus"></span>
                                    <span class="count"><?= Lang::get('lang.plus_one') ?></span>
                                </a>
                            </li>
                            <li class="pinterest">
                                <a href="//www.pinterest.com/pin/create/button/?url={!! $post->getLink() !!}&media={!! Timthumb::link($post->thumbnail,null,null,null) !!}&description=<?= $post->title ?>"
                                   title="<?= Lang::get('lang.pin_it') ?>" target="_blank"
                                   onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=400,width=600');return false;">
                                    <span class="fa fa-pinterest"></span>
                                    <span class="count"><?= Lang::get('lang.pin_it') ?></span>
                                </a>
                            </li>

                        </ul>
                        @if(!is_null($logged_user))
                                <!-- TODO: html flag-->
                        @endif
                        @if(isset($post->source) && $post->source !='')
                            <a href="{!! $post->source !!}" target="_blank" class="label label-success"
                               style="margin-top:6px ">
                                <i class="fa fa-globe"></i>{!! trans('lang.source') !!}
                            </a>
                        @endif
                        @if(!is_null($logged_user) && ($logged_user->id = $post->user_id))
                            <div class="edit-delete">
                                <a href="#_" data-href="" onclick="confirm_delete(this)" class="label label-danger">
                                    <i class="icon-trash"></i>{!! trans('lang.delete') !!}
                                </a>
                                <!-- TODO: html edit button -->
                            </div>
                        @endif
                    </div>
                </div>

                <div class="clearfix"></div>
                <h3 class="comment-type site active"
                    data-comments="#current_comments"><?= Lang::get('lang.site_comments') ?> (<span
                            class="current_comment_count site_comments"></span>)</h3>

                <h3 class="comment-type facebook"
                    data-comments="#facebook_comments"><?= Lang::get('lang.facebook_comments') ?> (<span
                            class="current_comment_count"><fb:comments-count
                                href="<?= Request::url() ?>"></fb:comments-count></span>)
                </h3>
                <div id="facebook_comments">
                    <div class="fb-comments" data-href="<?= Request::url() ?>" data-width="660" data-numposts="5"
                         data-colorscheme="light"></div>
                </div>

            </div>
        </div>
    </div>
    @include("gag.frontend.post.partials.javascript")
@stop