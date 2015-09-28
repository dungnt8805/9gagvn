@extends("layouts.frontend.default")
@section("content")
    <div class="row">
        <div class="col-md-8 col-sm-12 col-xs-12">
            <section id="individual-post">
                <article data-entry-id="{{$post->code}}" data-entry-url="" data-entry-votes="" data-entry-comments=""
                         id="jsid-entry-entity-{{$post->code}}"
                         class="badge-entry-container badge-entry-entity badge-post-page post-page badge-in-view badge-in-view-focus">
                    <div class="post-header">
                        <div class="left-box">
                            <header>
                                <h2 class="badge-item-title">{{$post->title}}</h2>

                                {{--<p class="post-meta">--}}
                                {{--<a class="badge-evt point" id="love-count-{{$post->code}}" href="javascript:;"--}}
                                {{--data-evt="EntryAction,VotePointLinkUnderTitle,PostPage">--}}
                                {{--<span itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">--}}
                                {{--<span itemprop="ratingValue" style="display: none;">5</span>--}}
                                {{--<span itemprop="ratingCount" class="badge-item-love-count">6,789</span>--}}
                                {{--</span> points--}}
                                {{--</a>--}}
                                {{--·--}}
                                {{--<a class="comment badge-evt"--}}
                                {{--href="#comment"--}}
                                {{--data-evt="EntryAction,CommentLinkUnderTitle,PostPage">--}}
                                {{--<span class="badge-item-comment-count">244</span> comments</a>--}}
                                {{--</p>--}}
                            </header>
                            <div class="more-info-box">
                                <div class="post-meta">
                                    <div class="user-info">
                                        <span class="post-count-point">
                                            <i class="fa fa-smile-o"></i>
                                            <span class="text-highlight ng-binding">{!! $post->points !!}</span> điểm
                                        </span>
                                        <span class="post-count-view">
                                            <i class="fa fa-eye"></i>
                                            <span class="text-highlight">{!! $post->views !!}</span> lượt xem
                                        </span>
                                        <span class="post-count-comment">
                                            <i class="fa fa-comments"></i>
                                            <span class="text-highlight">{!! $post->comments !!}</span> bình luận
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="right-box">
                            <div class="creator">
                                <span class="timer">{!! trans('funny/posts.post_time') !!} {!! Date::parse($post->created_at)->diffForHumans() !!} {!! trans('funny/posts.post_by') !!}</span>

                                <div class="creator-detail">
                                    <a href="" title="{{$post->name}}" target="_blank">
                                        <img class="avatar" src="{{Timthumb::link($post->avatar,32,32)}}"/>

                                        <div class="info">
                                            <span class="name">{{$post->name}}</span>
                                            <span class="point"></span>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="badge-toolbar-pre fixed-wrap-post-bar">
                        <div class="badge-entry-toolbar-sticky post-afterbar-a in-post-top">
                            <ul class="badge-item-vote-container horizontal-vote  ">
                                <li><a class="badge-item-vote-up up" href="javascript:void(0);"
                                       rel="nofollow">
                                    </a>
                                </li>
                                <li><a class="badge-item-vote-down down" href="javascript:void(0);"
                                       rel="nofollow"></a></li>
                            </ul>
                            <div class="share">
                                <ul>
                                    <li><a class="badge-facebook-share badge-evt badge-track btn-share facebook"
                                           href="javascript:void(0);"
                                           data-track="social,fb.s,,,d,a2q0gzd,p"
                                           data-evt="Facebook-Share,PostClicked,{{$post->getLink()}}"
                                           data-share="{{$post->getLink()}}?ref=fb.s" rel="nofollow">Facebook</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="others">
                                <a class="badge-more-share-button more" href="javascript:void(0);">More</a>
                            </div>
                            <div class="badge-more-share-menu popup-menu postpage-share hide">
                                <ul>
                                    <li><a href="javascript:void(0);" class="badge-gplus-share badge-evt badge-track"
                                           data-track="social,gp.s,,,d,a2q0gzd,p"
                                           data-evt="GPlus-Share,PostClicked,{{$post->getLink()}}"
                                           data-share="{{$post->getLink()}}?ref=gp" rel="nofollow">Google+</a>
                                    </li>
                                    <li><a href="javascript:void(0);"
                                           class="badge-pinterest-share badge-evt badge-track"
                                           data-track="social,pn.s,,,d,a2q0gzd,p"
                                           data-evt="Pinterest-Share,PostClicked,{{$post->getLink()}}"
                                           data-title="{{$post->title}}"
                                           data-img="http://img-9gag-fun.9cache.com/photo/a2q0gzd_700b.jpg"
                                           data-share="{{$post->getLink()}}?ref=pn" rel="nofollow">Pinterest</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="post-nav">
                                <a class="badge-fast-entry badge-prev-post-entry hide " data-entry-key="{{$post->code}}"
                                   href="/gag/aGRBbK7" rel="nofollow"></a>
                                <a class="badge-fast-entry badge-next-post-entry next " data-entry-key="{{$post->code}}"
                                   href="/gag/aGRBbK7" rel="nofollow">
                                    <span class="label">Next Post</span><span class="arrow"></span></a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="badge-post-container badge-entry-content post-container">
                        @if($post->type == \App\Funny\Models\Post::PHOTO_TYPE)
                            <a href="javascript:;" style="">
                                <img src="{{Timthumb::link($post->thumbnail,600,null,1)}}">
                            </a>
                        @elseif($post->type == \App\Funny\Models\Post::VIDEO_TYPE)
                            @if(!is_null($post->youtube_id))
                                <div id="embed_video">

                                </div>
                                <script type="text/javascript">
                                    jQuery(document).ready(function () {
                                        jwplayer('embed_video').setup({
                                            menu: true,
                                            allowscriptaccess: "always",
                                            wmode: "opaque",
                                            image: "https://i.ytimg.com/vi/{!! $post->youtube_id !!}/hqdefault.jpg",
                                            file: "https://www.youtube.com/watch?v={!! $post->youtube_id !!}",
                                            width: "100%",
                                            aspectratio: "16:9",
                                            autostart: false,
                                            primary: "flash",
//                                            advertising: {
//                                                client: "vas",
//                                                skipoffset: 5,
//                                                skiptext: "Bỏ qua",
//                                                skipmessage: "Bỏ qua sau xxs",
//                                                admessage: "Nhấn Bỏ qua (góc phải bên dưới VIDEO) để xem VIDEO ngay. Quảng cáo hết sau XX giây",
//                                                tag: "http://delivery.adnetwork.vn/247/xmlvideoad/zid_1435823876/wid_1435823768/type_inline/cb_[timestamp]"
//                                            }
                                        });
                                    })

                                </script>
                            @else
                            @endif
                        @endif
                        <div class="post-container badge-item-description"></div>
                    </div>
                    <div class="naughty-box">
                        <div class="width-limit">
                            <div class="image-container">
                                <div class="badge-gag-ads-container img-container"
                                     data-gag-ads="nsfw-post-leaderboard-630x900-atf">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="badge-entry-info post-afterbar-meta">
                        <p class="left">
                            Đăng bởi {!! HTML::link("",$post->name,['target'=>'_blank','title'=>$post->name]) !!}
                            {!! $post->created_at->diffForHumans() !!}
                        </p>

                        <p>
                            <a class="badge-item-report" href="javascript:;">Report</a>
                            <span class="badge-item-delete-dot hide"> · </span>
                            <a class="badge-item-delete hide" href="/read/delete?id={{$post->code}}"
                               onclick="return confirm('Confirm to delete this post??');" rel="nofollow">Delete</a>
                        </p>
                    </div>
                </article>
            </section>
            <div id="comment-box"></div>
            <div id="comments"></div>
            <section class="post-comment">
                <div class="fb-comments" data-href="{{$post->getLink()}}" data-numposts="5" data-width="100%"></div>
            </section>
        </div>
    </div>
@stop