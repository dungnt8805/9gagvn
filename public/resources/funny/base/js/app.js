/**
 * Created by dungnt13 on 9/10/2015.
 */

App = {
    init: function () {
        this.config = {
            duration: 0
        }
    },

    /**
     * Insert img to content editor
     * @param img url
     */
    insertImageEditor: function (imgUrl) {
        var htmlContent = '<p style="text-align: center;"><img src="' + imgUrl + '" style="padding: 10px 0; text-align: center" /></p><p style="text-align: center;"><em style="font-style: italic">Nhập mô tả hình ảnh của bạn</em></p>';
        CKEDITOR.instances.textareabox.insertHtml(htmlContent);
    },


}
