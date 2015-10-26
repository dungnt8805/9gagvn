@extends("gag.layouts.frontend.default")
@section("content")
    <div class="navbar gallery-sub-header" style="z-index: 9">

    </div>
    <div class="container main_home_container main_home">
        <div class="col-md-8 col-lg-8" style="display: block; clear: both; margin: 0 auto; padding: 0 0 70px 0">
            <div id="media" style="padding-bottom: 70px; position: relative; height: 1000px">

            </div>
        </div>
        <div class="col-lg-4 col-md-4" id="sidebar_container">
            <!-- Options bar -->
            <div class="options_bar">

            </div>
            <!-- end options bar -->
            @include('gag.frontend.includes.side_bar')
        </div>
    </div>
@stop