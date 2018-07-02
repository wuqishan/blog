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
    sys_page: function (selector, server, option, formData) {
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
            "lengthChange": true,
            // 件数选择下拉框内容
            "lengthMenu": [3, 25, 50, 75, 100],
            // 每页的初期件数 用户可以操作lengthMenu上的值覆盖
            "pageLength": 3,
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
                    param.formData = formData;
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
        $(selector).DataTable(settings);
    },
});