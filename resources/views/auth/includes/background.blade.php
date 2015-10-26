<style type="text/css">
    .backstretch {
        z-index: 9
    }
</style>
<div id="overlay"></div>

<script type="text/javascript" src="{!! asset('resources/gag/components/jquery.backstretch.min.js') !!}"></script>
<script type="text/javascript">

    var RecaptchaOptions = {
        theme: 'white'
    };

    var images = ['01.jpg', '02.jpg', '03.jpg', '04.jpg', '05.jpg', '06.jpg', '07.jpg', '08.jpg', '09.jpg', '10.jpg'];

    $(document).ready(function () {
        $.backstretch(main_url + '/resources/gag/frontend/img/background/' + images[Math.floor(Math.random() * images.length)]);
//        $('.backstretch').css('z-index', 9);
        position_elements();
    });

    $(window).resize(function () {
        position_elements();
    });

    function position_elements() {
        $('#overlay').css('height', $(window).height());
        $('.form-signin').css('top', ( ($(window).height() / 2) - ($('.form-signin').height() / 2) ) - $('.navbar').height() + 'px');
        $('.backstretch, #overlay, .form-signin').fadeIn();

    }
</script>