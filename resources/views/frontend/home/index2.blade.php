@extends("layouts.frontend.default")

@section("content")
    <div class="row">
        <div class="col-md-8 col-sm-12 col-xs-12" ng-controller="NewsfeedCtrl">
            <section id="list-view-2" class="badge-list-view-element variant-right">
                <div class="badge-entry-collection" infinite-scroll="loadPostList(0)" infinite-scroll-disabled="busy"
                     infinite-scroll-distance="1">
                    <article ng-repeat="post in Posts" data-entry-id="@{{ post.id }}" data-entry-vote=""
                             data-entry-comments="" id=""
                             class="badge-entry-container badge-entry-entity badge-in-view badge-in-view-focus"
                             data-entry-url="@{{ post.id }}">
                        <div class="badge-post-container post-container app-photo watermark">
                            <a href="@{{ post.url }}" target="_blank" title="@{{ post.title }}">
                                <span class="video-frame" ng-if="post.type == 2">
                                    <span class="responsivewrapper"
                                          post-back-img="@{{ post.thumbnail }}"></span>
                                    <span class="play">Play</span>
                                </span>
                            </a>
                        </div>
                        <header class="post-info-container ">
                            <h2 class="badge-item-title Mg0">
                                <a href="@{{ post.url }}" target="_blank"
                                   title="@{{ post.title }}">@{{ post.title }}</a>
                            </h2>

                            <div class="more-information">
                                <div class="primary-info">
                                    <p>{!! trans('funny/posts.post_by_2') !!}
                                        <a href="" target="_blank" title="@{{ post.name }}">@{{ post.name }}</a>
                                        @{{ post.created_at_string }}
                                    </p>

                                </div>
                                <div class="info">
                                    <p>
                                        <i class="fa fa-smile-o"></i> <span id="point">@{{ post.likes }}</span>

                                    </p>

                                    <p>
                                        <i class="fa fa-eye"></i> @{{ post.views }}
                                    </p>

                                    <p>
                                        <i class="fa fa-comments"></i> @{{ post.comments }}
                                    </p>
                                </div>
                                <div class="social-btn fb-like">

                                </div>
                            </div>
                            <div class="badge-entry-sticky-shadow stick-action">
                                <div class="badge-entry-sticky">
                                    <ul class="btn-vote left">
                                        <li>
                                            <a class="badge-item-vote-up up" href="#"
                                               ng-click="like(post.id)"></a>
                                        </li>
                                        <li>
                                            <a class="badge-item-vote-down down" href="#" ng-click="dislike(post.id)"></a>
                                        </li>
                                        <li class="btn-comment">

                                        </li>
                                        <li class="btn-comment">
                                            <a class="comment" target="_blank"
                                               href="@{{ post.url }}#comment-box">{!! trans('funny/posts.comment') !!}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </header>
                    </article>
                </div>
            </section>
        </div>
    </div>
@stop