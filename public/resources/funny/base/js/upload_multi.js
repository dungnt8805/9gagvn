/**
 * Created by nguyentuan on 9/7/2015.
 */

var __upload_index = 1;

uploadMulti.Upload = function (button, id_container, url) {
    if (id_container == undefined) {
        id_container = 'container-upload';
    }
    if (typeof position_img === "undefined") {
        position_img = 0;
    }

    var uploader = new plupload.Uploader({
        browse_button: button,
        container: id_container,
        max_file_size: "20mb",
        url: main_url + '/' + url,
        filters: [
            {title: "Image files", extensions: "jpg,gif,png,jpeg"}
        ]
    });
    uploader.bind('Init', function (up, params) {

    });
    uploader.init();
    uploader.bind("FilesAdded", function (up, files) {
        jQuery.each(files, function (i, file) {
            __upload_index++;
            if (file.size > (20480 * 1024)) {
                alert("Ảnh phải có kích thước <= 10MB");
                jQuery('.up_preview_' + file.id).remove();
                up.removeFile(file);
            } else {
                if (__upload_index >= 50) {//check chỉ cho upload tối đa 50 ảnh

                    up.removeFile(file);

                } else {

                    var html = jQuery('.data_img').html();
                    var str = html.replace(/xINDEX/gi, file.id);

                    jQuery("#" + id_container + ' .photoPreviews').append(str);
                }
            }
        });
        uploader.start();
        up.refresh(); // Reposition Flash/Silverlight
    });
    uploader.bind('UploadProgress',function(up,file){
        jQuery
    })
}
