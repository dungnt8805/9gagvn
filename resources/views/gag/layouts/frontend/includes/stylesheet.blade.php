<link href="{!! asset('resources/gag/components/bootstrap/css/bootstrap_modified.css') !!}" rel="stylesheet"
      type="text/css"/>
<link href="{!! asset('resources/gag/components/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet"
      type="text/css"/>
<link href="{!! asset('resources/gag/components/animate/css/animate.min.css') !!}" rel="stylesheet"
      type="text/css"/>
<link href="{!! asset('resources/gag/frontend/css/style.css') !!}" rel="stylesheet" type="text/css"/>
<style type="text/css">
    {!! $app_settings['custom_css'] !!}
</style>
@include('gag.layouts.frontend.includes.custom_css')
<style type="text/css">
    .notifications {
        margin-top: -7px;
        display: inline-block;
        float: right;
    }

    .dropdownNotifi .dropdown-menu {
        display: none;
        opacity: 1 !important;
        visibility: visible !important;
    }
</style>