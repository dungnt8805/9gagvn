@extends("layouts.frontend.default")
@section("content")
    <div class="row">
        <div class="col-md-8 col-sm-12 col-xs-12">
            <section id="individual-post">
                <article data-entry-id="{{$post->code}}" data-entry-url="" data-entry-votes="" data-entry-comments=""
                         id="jsid-entry-entity-{{$post->code}}"
                         class="badge-entry-container badge-entry-entity badge-post-page post-page badge-in-view badge-in-view-focus">
                    <header>
                        <h2 class="badge-item-title">{{$post->title}}</h2>

                        <p class="post-meta">
                            <a class="badge-evt point" id="love-count-{{$post->code}}" href="javascript:;"
                               data-evt="EntryAction,VotePointLinkUnderTitle,PostPage">
                                <span itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                                    <span itemprop="ratingValue" style="display: none;">5</span>
                                    <span itemprop="ratingCount" class="badge-item-love-count">6,789</span>
                                </span> points
                            </a>
                            ·
                            <a class="comment badge-evt"
                               href="#comment"
                               data-evt="EntryAction,CommentLinkUnderTitle,PostPage">
                                <span class="badge-item-comment-count">244</span> comments</a>
                        </p>
                    </header>
                    <div class="badge-toolbar-pre fixed-wrap-post-bar">
                        <div class="badge-entry-toolbar-sticky post-afterbar-a in-post-top">
                            <ul class="badge-item-vote-container horizontal-vote  ">
                                <li><a class="badge-item-vote-up up" href="javascript:void(0);"
                                       rel="nofollow"><span>UP</span></a></li>
                                <li><a class="badge-item-vote-down down" href="javascript:void(0);"
                                       rel="nofollow"><span>DOWN</span></a></li>
                            </ul>
                            <div class="share">
                                <ul>
                                    <li><a class="badge-facebook-share badge-evt badge-track btn-share facebook"
                                           href="javascript:void(0);"
                                           data-track="social,fb.s,,,d,a2q0gzd,p"
                                           data-evt="Facebook-Share,PostClicked,http://9gag.com/gag/a2q0gzd"
                                           data-share="http://9gag.com/gag/a2q0gzd?ref=fb.s" rel="nofollow">Facebook</a>
                                    </li>
                                    <li><a class="badge-twitter-share badge-evt badge-track btn-share twitter"
                                           href="javascript:void(0);"
                                           data-track="social,t.s,,,d,a2q0gzd,p"
                                           data-evt="Twitter-Share,PostClicked,http://9gag.com/gag/a2q0gzd"
                                           data-title="It%27s%20astounding%20how%20many%20people%20can%27t%20grasp%20this%20concept%20on%20the%20highway."
                                           data-share="http://9gag.com/gag/a2q0gzd?ref=t" rel="nofollow">Twitter</a>
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
                                           data-evt="GPlus-Share,PostClicked,http://9gag.com/gag/a2q0gzd"
                                           data-share="http://9gag.com/gag/a2q0gzd?ref=gp" rel="nofollow">Google+</a>
                                    </li>
                                    <li><a href="javascript:void(0);"
                                           class="badge-pinterest-share badge-evt badge-track"
                                           data-track="social,pn.s,,,d,a2q0gzd,p"
                                           data-evt="Pinterest-Share,PostClicked,http://9gag.com/gag/a2q0gzd"
                                           data-title="It%27s%20astounding%20how%20many%20people%20can%27t%20grasp%20this%20concept%20on%20the%20highway."
                                           data-img="http://img-9gag-fun.9cache.com/photo/a2q0gzd_700b.jpg"
                                           data-share="http://9gag.com/gag/a2q0gzd?ref=pn" rel="nofollow">Pinterest</a>
                                    </li>
                                    <li>
                                        <a href="mailto:?subject=Check%20out%20%22It%27s%20astounding%20how%20many%20people%20can%27t%20grasp%20this%20concept%20on%20the%20highway.%22&body=This%20is%20funny%2C%20you%20must%20check%20it%20out%21%20%3AD%0AIt%27s%20astounding%20how%20many%20people%20can%27t%20grasp%20this%20concept%20on%20the%20highway.%0Ahttp%3A%2F%2F9gag.com%2Fgag%2Fa2q0gzd%3Fref%3D9g.m"
                                           class="badge-email-share badge-evt badge-track"
                                           data-track="social,9g.m,,,d,a2q0gzd,p"
                                           data-evt="Email-Share,PostClicked,http://9gag.com/gag/a2q0gzd"
                                           target="_blank" rel="nofollow">Email</a></li>
                                </ul>
                            </div>
                            <div class="post-nav">
                                <a class="badge-fast-entry badge-prev-post-entry hide " data-entry-key="aGRBbK7"
                                   href="/gag/aGRBbK7" rel="nofollow"></a>
                                <a class="badge-fast-entry badge-next-post-entry next " data-entry-key="aGRBbK7"
                                   href="/gag/aGRBbK7" rel="nofollow">
                                    <span class="label">Next Post</span><span class="arrow"></span></a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="badge-post-container badge-entry-content post-container">
                        <a href="javascript:;" style="">
                            <img src="{{Timthumb::link($post->thumbnail,600,null,1)}}">
                        </a>
                        <div class="post-container badge-item-description"></div>
                    </div>
                    <div class="naughty-box">
                        <div class="width-limit">
                            <div class="image-container">
                                <div class="badge-gag-ads-container img-container" data-gag-ads="nsfw-post-leaderboard-630x900-atf">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-afterbar-a in-post-bot full-width">
                        <div class="share badge-share-bar">
                            <ul>
                                <li>
                                    <a class="badge-facebook-share badge-facebook-bot-share badge-evt badge-track btn-share facebook"
                                       href="javascript:;" data-track="social,fb.s,,,d,{{$post->code}},p"
                                       data-evt="Facebook-Share-Bot,PostClicked,http://9gag.com/gag/aRVzQVy"
                                       data-share="http://9gag.com/gag/aRVzQVy?ref=fb.s" rel="nofollow">Share on Facebook</a>
                                </li>
                                <li>
                                    <a class="badge-twitter-share badge-twitter-bot-share badge-evt badge-track btn-share twitter"
                                       href="javascript:void(0);" data-track="social,t.s,,,d,{{$post->code}},p"
                                       data-evt="Twitter-Share-Bot,PostClicked,http://9gag.com/gag/aRVzQVy" data-title="RWD%20ftw."
                                       data-share="http://9gag.com/gag/aRVzQVy?ref=t" rel="nofollow">Share on Twitter</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </div>
@stop