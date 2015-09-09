/**
 * Created by nguyentuan on 9/7/2015.
 */
if (typeof uploadMulti == 'undefined') {
    var uploadMulti = {

        configs: function () {
        }
    };
    window.uploadMulti = uploadMulti;
    uploadMulti.configs();
}

function PreviewImage(file) {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(file);

    oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
};

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
        ],
        multipart_params: {
            "_token": $('[name="csrf_token"]').attr('content')
        }
    });
    uploader.bind('Init', function (up, params) {
    });
    uploader.init();
    uploader.bind('FilesAdded', function (up, files) {
        jQuery.each(files, function (i, file) {
            __upload_index++;
            if (file.size > (20480 * 1024)) { //check kiểu này vì khi drag 2 file nó sẽ vẫn nhận dù size ko hợp lệ
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

    uploader.bind('UploadProgress', function (up, file) {

        jQuery('.process_img_' + file.id).show();
    });

    uploader.bind('Error', function (up, err) {

        jQuery('#filelist').append("<div>Error: " + err.code +
            ", Message: " + err.message +
            (err.file ? ", File: " + err.file.name : "") +
            "</div>"
        );

        up.removeFile(err.file);
        up.refresh(); // Reposition Flash/Silverlight

        alert("Ảnh phải có định dạng jpg,png,jpeg và có kích thước <= 10MB");
        return false;
    });
    uploader.bind('FileUploaded', function (up, file, info) {

        var json = jQuery.parseJSON(info["response"]);

        if (json.error != undefined && json.error == 'success') {
            position_img++;

            var objImage = new Image();
            objImage.src = json.image_thumb;
            objImage.onload = function () {
                var img_show = '<img src="' + json.image_thumb + '" />';
                jQuery('div.preview_img_' + file.id).append(img_show);
            }

            jQuery('a.insert_img_' + file.id).attr('onClick', "objPostItem.insertImageEditor('" + json.image_500 + "')");
            jQuery('a.del_img_' + file.id).attr('onClick', 'objPostItem.deleteImageEntry(this, ' + json.id + ');');
            jQuery('input.input_' + file.id).attr('id', json.id);
            jQuery('.process_img_' + file.id).hide();

            jQuery('.number_img_' + file.id).text(position_img).show();
            jQuery('#is_avatar_' + file.id).val(json.id);
            jQuery(".tooltip-1").show(); //tool tip chèn ảnh

            if (position_img == 1) { //ảnh đầu tiên là ảnh đại diện luôn
                jQuery('#is_avatar_' + file.id).trigger('click');
            }

            if (uploader.total.uploaded == uploader.files.length) { //upload het anh da chon

            }

        } else {
            alert(json.error);
            jQuery('.preview_img_' + file.id).parent().parent().remove();
            jQuery('.process_img_' + file.id).hide();
            if (uploader.total.uploaded == uploader.files.length) { //upload het anh da chon
                //jQuery('.check_upload_sub_item').val(0);
            }
        }

    });

}
