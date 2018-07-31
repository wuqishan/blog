/**
 *  自定义jquery扩展方法
 */

$.extend({
    /**
     * 自定义分页函数
     *
     * @param selector
     * @param server
     * @param option
     */
    sys_page: function (selector, server, option) {
        var optionDefault = {
            "searching": false,
            "ordering": true,
            "paging": true,
            "pagingType": "full_numbers",
            // 是否显示情报 就是"当前显示1/100记录"这个信息
            "info": true,
            // 水平滚动条
            "scrollX": false,
            // 垂直滚动条
            "scrollY": false,
            // 件数选择功能 默认true
            "lengthChange": false,
            // 件数选择下拉框内容
            "lengthMenu": [3, 25, 50, 75, 100],
            // 每页的初期件数 用户可以操作lengthMenu上的值覆盖
            "pageLength": 10,
            // 自动列宽
            "autoWidth": true,
            // 是否表示 "processing" 加载中的信息，这个信息可以修改
            "processing": true,
            // 每次创建是否销毁以前的DataTable,默认false
            "destroy": false,
            "language": {
                "processing": "Loading...",
                // 当前页显示多少条
                "lengthMenu": "每页显示 _MENU_",
                // _START_（当前页的第一条的序号） ,_END_（当前页的最后一条的序号）,_TOTAL_（筛选后的总件数）,
                // _MAX_(总件数),_PAGE_(当前页号),_PAGES_（总页数）
                "info": "<span style='font-size: 12px;'>当前页：_PAGE_, 总页数：_PAGES_, 共 _TOTAL_ 条数据</span>",
                "infoEmpty": "显示第 0 至 0 项结果，共 0 项",
                // 没有数据的显示（可选），如果没指定，会用zeroRecords的内容
                "emptyTable": "No data available in table",
                // 筛选后，没有数据的表示信息，注意emptyTable优先级更高
                "zeroRecords": "No records to display",
                // 翻页按钮文字控制
                "paginate": {
                    "first": "首页",
                    "last": "末页",
                    "next": " > ",
                    "previous": " < "
                },
                "infoFiltered": '',
                // Client-Side用，Server-Side不用这个属性
                "loadingRecords": "Please wait - loading..."
            },
            // 服务器端处理方式
            "serverSide": true,
            "ajax": {
                url: server,
                type: 'GET',
                data: function (param) {
                    param.formData = window.formData;
                    return param;
                },
                dataSrc: function (myJson) {
                    if (myJson.timeout) {
                        return "";
                    }
                    return myJson.data;
                }
            },
            "columns": []
        };
        var settings = $.extend(optionDefault, option);

        return $(selector).DataTable(settings);
    },
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