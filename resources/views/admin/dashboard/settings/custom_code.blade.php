<div class="white_container">

    <h4 style="padding-bottom:0px;"><i class="ion ion-android-developer"></i><span> Custom CSS</span></h4>
    <pre id="editor" class="ace-editor" style="min-height:350px; width:auto;">{{ $custom_css }}</pre>
    <div class="btn btn-success pull-right" id="submit-code"><i
                class="ion ion-android-developer"></i> {{ Lang::get('lang.submit_custom_code') }}</div>
    <div style="clear:both"></div>

    <hr/>

    <h4 style="padding-bottom:0px;"><i class="fa fa-code"></i><span> Custom Javascript</span></h4>
    <pre id="js_editor" class="ace-editor" style="min-height:350px;">{{ $custom_js }}</pre>
    <div class="btn btn-success pull-right" id="submit-js-code"><i
                class="fa fa-code"></i> {{ Lang::get('lang.submit_custom_code') }}</div>
    <div style="clear:both"></div>

</div>


<script type="text/javascript" src="{!! asset('resources/components/ace/ace.js') !!}"></script>
<script type="text/javascript" src="{!! asset('resources/components/ace/mode-css.js') !!}"></script>
<script type="text/javascript" src="{!! asset('resources/components/ace/mode-javascript.js') !!}"></script>
<style type="text/css">.ace-github .ace_print-margin {
        width: auto;
    }</style>
<script>

    /********* HANDLE THE CUSTOM CSS CODE **********/

    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/github");
    editor.getSession().setMode("ace/mode/css");

    $(document).ready(function () {
        $('#submit-code').click(function () {
            var new_css = editor.getSession().getValue();
            $.post('{{ URL::to("/") }}/admin/custom_css', {css: editor.getSession().getValue()}, function (data) {
                if (data) {
                    var n = noty({
                        text: 'Successfully Updated Your Custom Code',
                        layout: 'top',
                        type: 'success',
                        template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
                        closeWith: ['button'],
                        timeout: 2000
                    });
                    $('#new_css').remove();
                    $('body').append('<div id="new_css"><style type="text/css">' + new_css + '</style></div>');
                }
            });
        });
    });


    /********* HANDLE THE CUSTOM CSS CODE **********/

    var js_editor = ace.edit("js_editor");
    js_editor.setTheme("ace/theme/github");
    js_editor.getSession().setMode("ace/mode/javascript");

    $(document).ready(function () {
        $('#submit-js-code').click(function () {
            var new_js = js_editor.getSession().getValue();
            $.post('{{ URL::to("/") }}/admin/custom_js', {js: js_editor.getSession().getValue()}, function (data) {
                if (data) {
                    var n = noty({
                        text: 'Successfully Updated Your Custom Code',
                        layout: 'top',
                        type: 'success',
                        template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
                        closeWith: ['button'],
                        timeout: 2000
                    });
                    $('#new_js').remove();
                    $('body').append('<div id="new_js"><script>' + new_js + '<\/script></div>');
                }
            });
        });
    });

</script>