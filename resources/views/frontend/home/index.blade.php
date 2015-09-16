@extends('layouts.frontend.default')

@section("content")
    <div class="row">
        <div class="col-md-8 col-sm-12 col-xs-12">
            <section id="list-view-2" class="badge-list-view-element variant-right">
                <div class="badge-entry-collection">
                    @foreach($posts as $post)
                        <article data-entry-id="" data-entry-vote="" data-entry-comments="" id="" class="">
                            <header>
                                <h2 class="">{!! $post->title !!}</h2>
                            </header>
                            <div class="">
                                <a href="" class="">
                                    <img src="{{Timthumb::link($post->thumbnail,500,400,1)}}" alt="{{$post->title}}"/>
                                </a>
                            </div>
                            <div class="post-text-container badge-item-description">

                            </div>
                            <p class="post-meta">
                                <a class="badge-evt point" id="love-count-" href="" target="_blank" data-evt="EntryAction,VotePointLinkUnderTitle,ListPage">
                                    <span class="badge-item-love-count">{{$post->votes}}</span> points
                                </a>
                                ·
                                <a class="comment badge-evt" href="" target="_blank" data-evt="EntryAction,CommentLinkUnderTitle,ListPage">{{$post->comments}} comments</a>
                            </p>
                            <div class="badge-item-vote-container post-afterbar-a in-list-view">
                                <div class="vote">
                                    <ul class="btn-vote left">
                                        <li>
                                            <a class="badge-item-vote-up up" href="javascript:;" rel="nofollow">Upvote</a>
                                        </li>
                                        <li>
                                            <a class="badge-item-vote-down down" href="javascript:;" rel="nofollow">Downvote</a>
                                        </li>
                                        <li><a class="comment badge-item-comments badge-evt" target="_blank" href="" data-evt="EntryAction,CommentButtonClicked,ListPage" rel="nofollow">Comments</a> </li>
                                    </ul>
                                </div>
                                <div class="share right">
                                    <ul>
                                        <li>
                                            <a href="javascript:;" class="badge-facebook-share badge-evt badge-track btn-share facebook"
                                               data-track="social,fb.s,,,d,{{$post->id}},l" data-evt="Facebook-Share,ListClicked," data-share="" rel="nofollow">Facebook</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="badge-twitter-share badge-evt badge-track btn-share twitter" data-track="social,t.s,,,d,{{$post->id}},l" data-evt="Twitter-Share,ListClicked,http://9gag.com/gag/aMQP6b6" data-title="Japan%20WTF..." data-share="http://9gag.com/gag/aMQP6b6?ref=t" rel="nofollow">Twitter</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

        </div>
    </div>
@stop
