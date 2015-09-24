@extends("layouts.frontend.default")
@section("content")
    <div class="col-md-8 col-sm-12 col-xs-12">
        <section id="individual-post">
            <article data-entry-id="{{$post->code}}" data-entry-url="{{$post->getLink()}}"
                     data-entry-votes="{{$post->points}}"
                     data-entry-comments="{{$post->comments}}" id="jsid-entry-entity-{{$post->code}}"
                     class="badge-entry-container badge-entry-entity badge-post-page badge-in-view post-page pin-tool-bar">
                
            </article>
        </section>
    </div>
@stop