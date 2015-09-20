<li class="dropdown">
    <a class="dropdown-toggle profile-link" href="#" data-toggle="dropdown">
        {!! HTML::image(Timthumb::link(Auth::user()->avatar,100,100,1),"",['class'=>'profile-icon']) !!}
        <b class="caret"></b>
    </a>
    <ul class="dropdown-menu">
        <li role="presentation" class="dropdown-header">{{trans('frontend.user.profile')}}</li>
        <li>
            {!! HTML::link("",trans('frontend.user.view_profile')) !!}
        </li>
        <li>
            {!! HTML::link(route('post.add'),trans('frontend.post.add')) !!}
        </li>
        <li role="presentation" class="divider"></li>
        <li>
            {!! HTML::link(route('auth.logout',trans(''))) !!}
        </li>
    </ul>
</li>