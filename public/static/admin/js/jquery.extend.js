/**
 *  自定义jquery扩展方法
 */

$.extend({
    /**
     * @param option
     */
    sys_upload_img: function (option)
    {
        var optionDefault = {
            'selector': '#upload',
            'showPosition': '#file-input-position-control',
            'url': '',
            'formData': {},
            'multiple': false
        };
        var settings = $.extend(optionDefault, option);
        $(settings.selector).fileupload({
            url: settings.url,
            dataType: 'json',
            autoUpload: true,
            formData: settings.formData,
            maxFileSize: 1000000, // 10 MB
            add: function (e, data) {
                data.submit();
                $('.upload-progress').show();
            },
            done: function (e, data) {
                var htmlTemplate = '<div class="upload-img-box upload-img-show">' +
                    '<img src="{{src}}">' +
                    '<a href="javascript:void(0);" onclick="$.sys_del_upload_img({{id}})" title="删除">×</a>' +
                    '</div>';
                if (data.result.status) {
                    if (settings.multiple) {
                        var html = htmlTemplate.replace('{{src}}', data.result.data.filepath + data.result.data.filename);
                        html = html.replace('{{id}}', data.result.data.id);
                        $(settings.showPosition).before(html);
                        var hasVal = $('.temp_files').val() == '' ? false : true;
                        if (hasVal) {
                            $('.temp_files').val($('.temp_files').val() + ',' + data.result.data.id);
                        } else {
                            $('.temp_files').val(data.result.data.id)
                        }
                    } else {
                        var html = htmlTemplate.replace('{{src}}', data.result.data.filepath + data.result.data.filename);
                        html = html.replace('{{id}}', data.result.data.id);
                        $('.upload-img-show').remove();
                        $(settings.showPosition).before(html);
                        $('.temp_files').val(data.result.data.id);
                    }

                    $.sys_notify("上传附件 : ", "附件上传成功！", 'fa fa-check', "success");
                } else {
                    $.sys_notify("上传附件 : ", "附件上传失败！", 'fa fa-warning', "warning");
                }

                $('.upload-progress').hide();
                $('.upload-progress .progress-bar').css('width', '0%');
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('.upload-progress .progress-bar').css('width', progress + '%');
            }
        });
    },
    sys_del_upload_img: function (temp_files_id) {
        $.ajax({
            url: '/admin/upload/delete/' + temp_files_id,
            type: 'get',
            data: {},
            dataType: 'json',
            success: function (res){
                if (res.status) {
                    $.sys_notify("删除附件 : ", "附件删除成功！", 'fa fa-check', "success");
                    $('.upload-img-show').remove();
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    },
    sys_submit: function (option) {
        var optionDefault = {
            'formSelector': '#form-data',
            'url': '',
            'goTo': '',
            'data': {}
        };
        var settings = $.extend(optionDefault, option);
        $(settings.formSelector).ajaxSubmit({
            url: settings.url,
            type: 'post',
            dataType: 'json',
            data:settings.data,
            clearForm: true,
            success: function(results){
                if (results.status) {
                    location.href = settings.goTo;
                }
            },
            error: function(err){
                if (err.hasOwnProperty('responseJSON') && err.responseJSON.hasOwnProperty('errors')) {
                    for (var i in err.responseJSON.errors) {
                        $('[name='+ i +']').next('.form-control-feedback').html(err.responseJSON.errors[i][0]);
                    }
                }
            }
        });
    },
    sys_notify: function (title, message, icon, type, delay) {
        delay = typeof delay !== 'undefined' ?  delay : 1000;
        $.notify({
            title: title,
            message: message,
            icon: icon

        },{
            type: type,
            delay:delay
        });
    }
});