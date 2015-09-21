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
                                         style="background-image: url('@{{ post.thumbnail }}')"></span>
                                    <span class="play">Play</span>
                                </span>
                            </a>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </div>
@stop