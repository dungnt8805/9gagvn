<script type="text/javascript">
    $(document).ready(function () {
        $('.comment-type').click(function () {
            var comment_type = $(this).data('comments');
            $('#current_comments, #facebook_comments').hide();
            $(comment_type).show();
            $('.comment-type').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>