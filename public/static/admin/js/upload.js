/**
 * 图片上传的js
 */
$(function () {


});

function upload_img(selector, url, formData)
{
        $(selector).fileupload({
            url: url,
            dataType: 'json',
            autoUpload: true,
            formData: formData,
            maxFileSize: 1000000, // 10 MB
            add: function (e, data) {
                data.submit();
                $('.upload-progress').show();
            },
            done: function (e, data) {
                // $.each(data.result.files, function (index, file) {
                //     $('<p/>').text(file.name).appendTo(document.body);
                // });
                console.log(data);
                // $('.upload-progress').hide();
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                // $('.upload-progress').css('width', progress + '%');
            }
        });

}
