/**
 * Created by dungnt13 on 5/21/2015.
 */

function films() {
    $.ajax({
        type: "GET",
        url: "/converts/films",
        data: "",
        ifModified: false,
        success: function (data) {
            if (data != "finish") {
                $('#result').html('<p>Đã chuyển thành công ' + data + ' films');
                films();
            }
            else
                $('#result').html('aaaaaaaaaaaaaaaaaa');
        }
    });
}
function episodes() {
    $.ajax({
        type: "GET",
        url: "/converts/episodes",
        data: "",
        ifModified: false,
        success: function (data) {
            if (data != "finish") {
                $('#result').html('<p>Đã chuyển thành công ' + data + ' films');
                episodes();
            }
            else
                $('#result').html('aaaaaaaaaaaaaaaaaa');
        }
    });
}