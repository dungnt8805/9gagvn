/**
 * Created by dungnt on 10/23/15.
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});