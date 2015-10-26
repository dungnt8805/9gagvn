@extends("gag.layouts.admin.default")

@section("content")
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        <?= $posts ?>
                    </h3>

                    <p>
                        Posts
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-images"></i>
                </div>
                <a data-section="media" href="{!! route('admin.posts.index') !!}" class="small-box-footer ajax"
                   data-header="<i class='fa fa-picture-o'></i><span> Media </span>">
                    View All <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        <?= $users ?>
                    </h3>

                    <p>
                        User Registrations
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a data-section="users" href="{!! route('admin.posts.index') !!}"
                   data-header="<i class='ion ion-person'></i><span> Users </span>" class="small-box-footer ajax">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                        <?= $comments ?>
                    </h3>

                    <p>
                        Comments
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-chatbubbles"></i>
                </div>
                <a data-section="comments" data-header="<i class='ion ion-chatbubble'></i><span> Comments </span>"
                   href="" class="small-box-footer ajax">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>
                        <?= $categories ?>
                    </h3>

                    <p>
                        Categories
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios7-albums"></i>
                </div>
                <a data-section="categories" href="{!! route('admin.categories.index') !!}"
                   data-header="<i class='ion ion-ios7-albums'></i><span> Categories </span>"
                   class="small-box-footer ajax">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
    </div>
@stop