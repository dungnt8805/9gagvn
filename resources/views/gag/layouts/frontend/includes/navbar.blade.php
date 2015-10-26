<ul class="nav navbar-nav navbar-left nav-desktop">
    <li class="active">
        <a href="/"><i class="fa fa-home"></i>
            <span>{!! trans('lang.home') !!}</span>
        </a>

        <div class="nav-border-bottom"></div>
    </li>
    <!--<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-star"></i>
            <span>{!! trans('lang.popular') !!}</span><b class="caret"></b>

            <div class="nav-border-bottom"></div>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="">{!! trans('lang.for_the_week') !!}</a>
            </li>
            <li><a href="">{!! trans('lang.for_the_month') !!}</a></li>
            <li><a href="">{!! trans('lang.for_the_year') !!}</a></li>
            <li><a href="">{!! trans('lang.all_time') !!}</a></li>
        </ul>
    </li>-->
    <li class="dropdown">
        <a href="#" class="dropdown-toggle categories" data-toggle="dropdown">
            <i class="fa fa-folder-open"></i>
            <span>{!! trans('lang.categories') !!}</span><b class="caret"></b>

            <div class="nav-border-bottom"></div>
            <ul class="dropdown-menu">
                @foreach($app_categories as $key => $value)
                    <li>
                        <a href="{!! URL::to('category').'/'.$key !!}">
                            {!! $value !!}
                        </a>
                    </li>
                @endforeach
            </ul>
        </a>
    </li>
    @if($app_settings['pages_in_menu'] == 1)
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-file-text"></i> {!! $app_settings['pages_in_menu_text'] !!}
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">

            </ul>
        </li>
    @endif
</ul>
<ul class="nav navbar-nav navbar-right">
    <li class="dropdownd dropdownNotifi">
        @if(is_null($logged_user))
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell"></i>
            </a>
        @else
            <a href="#" class="dropdown-toggle readNotifi" data-toggle="dropdown">
                <i class="fa fa-bell"></i>
            </a>
            <ul class="dropdown-menu">

            </ul>
        @endif
    </li>
    <li>
        <a href="{!! route('post.random') !!}" class="random"><i class="fa fa-random"></i></a>
    </li>
    @if(!is_null($logged_user))
        <li>
            <a href="{!! route('post.add') !!}" class="upload-btn upload-btn-desktop">
                <i class="fa fa-cloud-upload"></i>{!! trans('lang.upload') !!}
            </a>
        </li>
    @endif
    @if(is_null($logged_user))
        <li class="">
            <a href="{!! URL::to('/login?redirectUrl='.URL::current()) !!}"
               id="login-button-desktop">{!! trans('lang.sign_in') !!}</a>

            <div class="nav-border-bottom"></div>
        </li>
        <li>
            <a href="{!! URL::to('/register?redirectUrl='.URL::current()) !!}"
               id="signup-button-desktop">{!! trans('lang.sign_up') !!}</a>

            <div class="nav-border-bottom"></div>
        </li>
    @else
        <li class="dropdown">
            <a href="#" class="user-menu user-menu-desktop dropdown-toggle" data-toggle="dropdown">
                <img src="{!! Timthumb::link($logged_user->avatar,31,31) !!}" class="img-circle"/>
                <b class="caret"></b>

                <div id="user-info">
                    <h4>
                        @if(strlen($logged_user->name)>8)
                            {!! substr($logged_user->name,0,8).'...' !!}
                        @else
                            {!! $logged_user->name !!}
                        @endif
                    </h4>

                    <p>0 {!! trans('lang.point') !!}</p>
                </div>
            </a>
        </li>
    @endif
</ul>