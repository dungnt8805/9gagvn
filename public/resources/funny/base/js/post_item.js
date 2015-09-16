/**
 * Created by dungnt13 on 9/10/2015.
 */

if (typeof objPostItem == 'undefined') {
    var objPostItem = {
        isSubmit: false,
        init: function () {
            window.onbeforeunload = function (e) {
                if (objPostItem.isSubmit == false) {
                    e = e || window.event;
                    // For IE and Firefox prior to version 4
                    if (e) {
                        e.returnValue = 'Are you sure?';
                    }
                    // For Safari
                    return 'Are you sure?';
                }
            }
        },

        /**
         * Insert img to content editor
         * @param img url
         */
        insertImageEditor: function (imgUrl) {
            var htmlContent = '<p style="text-align: center;"><img src="' + imgUrl + '" style="padding: 10px 0; text-align: center" /></p><p style="text-align: center;"><em style="font-style: italic">Nhập mô tả hình ảnh của bạn</em></p>';
            CKEDITOR.instances.ckeditor.insertHtml(htmlContent);
            //console.log(CKEDITOR.instances.ckeditor)
        },

        /**
         Delete img from post entry
         * @param obj
         * @param imgId
         */
        deleteImageEntry: function (obj, imgId) {
            if (confirm('Bạn có chắc chắn muốn xóa không?') == true) {
                if (obj != undefined) {
                    jQuery(obj).parents('.thump').remove();
                }
                $.post(main_url + "/medias/delete", {
                    id: imgId,
                    _token: $('[name="csrf_token"]').attr('content')
                }, function (data) {
                    if (data.error != 'success') {//Ko xóa được ảnh
                        if (data.error == 'not_login') {
                            alert('Bạn chưa đăng nhập, hãy đăng nhập lại hệ thống trước khi sử dụng chức năng này!');
                        }
                        else if (data.error == 'not_perm') {
                            alert('Bạn không được thực hiện được chức năng này, ấn F5 để load lại trang!');
                        }
                        else if (data.error == 'item_not_exit') {
                            alert('Tin rao không tồn tại, ấn F5 để load lại trang!');
                        }
                        else if (data.error == 'not_exists') {
                            alert('Ảnh không tồn tại, ấn F5 để load lại trang!');
                        } else {
                            alert(data.error);
                        }
                    }
                    else {
                        position_img--;
                        if (position_img <= 0) {
                            jQuery(".tooltip-1").hide();//tool tip chèn ảnh
                        }

                        if (obj != undefined) {
                            jQuery(obj).parents('.thumb').remove();
                        }
                    }
                }, 'json');
                return true;
            } else
                return false;
        }

    }
}