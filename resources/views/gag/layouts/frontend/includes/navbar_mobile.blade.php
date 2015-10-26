<ul>
    <li class="active">
        <a href="/"><i class="fa fa-home"></i>{!! trans('lang.home') !!}</a>
    </li>
    <!--<li class="dropdown @if(Request::is('popular/*') || Request::is('popular')) {{'active'}} @endif">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                    class="fa fa-star"></i> <?= Lang::get('lang.popular') ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="<?= URL::to('popular/week') ?>"><?= Lang::get('lang.for_the_week') ?></a></li>
            <li><a href="<?= URL::to('popular/month') ?>"><?= Lang::get('lang.for_the_month') ?></a>
            </li>
            <li><a href="<?= URL::to('popular/year') ?>"><?= Lang::get('lang.for_the_year') ?></a></li>
            <li><a href="<?= URL::to('popular') ?>"><?= Lang::get('lang.all_time') ?></a></li>
        </ul>
    </li>-->
    <li class="dropdown">
        <a href="#" class="dropdown-toggle categories" data-toggle="dropdown"><i
                    class="fa fa-folder-open"></i> <?= Lang::get('lang.categories') ?> <b
                    class="caret"></b></a>

        <ul class="dropdown-menu">
            <li>
                <?php foreach ($app_categories as $key => $value): ?>
                <a href="<?= URL::to('category') . '/' . strtolower($key) ?>"><?= $value ?></a>
                <?php endforeach; ?>
            </li>
        </ul>
    </li>
    @if($app_settings['pages_in_menu'] == 1)

    @endif
    <li>
        <a href="{!! route('post.random') !!}"><i class="fa fa-random">
            </i> <?= Lang::get('lang.random') ?>
        </a>
    </li>
</ul>

<ul class="nav navbar-nav navbar-right">
    @if(!is_null($logged_user))
        <li class="dropdown">
            <a href="#" class="user-menu dropdown-toggle" data-toggle="dropdown">
                <b class="caret"></b>

                <div id="user-info">
                    <h4><i class="fa fa-gear"></i>{!! trans('lang.settings') !!}</h4>
                </div>
            </a>
            <ul class="dropdown-menu">
                @if(0)
                    <li>
                        <a href="" class="admin_link_mobile">
                            <i class="fa fa-coffee"></i> {!! trans('lang.admin') !!}
                        </a>
                    </li>
                @endif
                <li>
                    <a href="">
                        <i class="fa fa-user"></i> {!! trans('lang.my_profile') !!}
                    </a>
                </li>
                <li>
                    <a href="{!! URL::to('/logout') !!}" id="user_logout_mobile">
                        <i class="fa fa-power-off"></i> {!! trans('lang.logout') !!}
                    </a>
                </li>
                @if(!is_null($logged_user))
                    <li class="{!! Request::is(route('post.add')) ? 'active':'' !!}">
                        <a href="{!! route('post.add') !!}" class="upload-btn">
                            <i class="fa fa-cloud-upload"></i> {!! trans('lang.upload') !!}
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @else
        <li class="{!! Request::is('login') ? 'active':'' !!}">
            <a href="{!! URL::to('/login?redirectUrl='.URL::current()) !!}">{!! trans('lang.sign_in') !!}</a>
        </li>
        <li class="{!! Request::is('register') ? 'active':'' !!}">
            <a href="{!! URL::to('/register?redirectUrl='.URL::current()) !!}">{!! trans('lang.sign_up') !!}</a>

        </li>
        <li class="{!! Request::is(route('post.add')) ? 'active':'' !!}">
            <a href="{!! route('post.add') !!}" class="upload-btn">
                <i class="fa fa-cloud-upload"></i> {!! trans('lang.upload') !!}
            </a>
        </li>
    @endif
</ul>