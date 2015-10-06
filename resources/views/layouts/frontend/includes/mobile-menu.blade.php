<div class="mobile-menu">
    @if(!Auth::guest())
        <a href="" class="urs-avatar"><img src="{!! Timthumb::link(Auth::user()->avatar) !!}" alt="{!! Auth::user()->name !!}"></a>
    @else
    @endif
</div>