@extends('admin.common.base')

@section('content')

    @include('admin.common.header')
    @include('admin.common.nav')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> 评论列表</h1>
                <p>Table to display analytical data effectively</p>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">评论管理</li>
                <li class="breadcrumb-item active"><a href="#">评论列表</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form class="row" id="search-form" action="{{ route('admin::comment.index') }}" method="get">
                            <div class="form-group col-md-2">
                                <input class="form-control" autocomplete="off" type="text" name="keyword" value="{{ request()->get('keyword') }}" placeholder="用户名 | 标题 | IP">
                            </div>
                            <div class="form-group col-md-2">
                                <input class="form-control" autocomplete="off" id="start_time" type="text" name="start_time" value="{{ request()->get('start_time') }}" placeholder="评论开始时间">
                            </div>
                            <div class="form-group col-md-2">
                                <input class="form-control" autocomplete="off" id="end_time" type="text" name="end_time" value="{{ request()->get('end_time') }}" placeholder="评论结束时间">
                            </div>
                            <div class="form-group col-md-2">
                                <select class="form-control" name="show">
                                    <option value="">选择评论状态</option>
                                    <option @if(request()->get('show') == 1) selected @endif value="1">显示</option>
                                    <option @if(request()->get('show') == 2) selected @endif value="2">隐藏</option>
                                </select>
                            </div>
                            <div class="form-group col-md-1"></div>
                            <div class="form-group col-md-1 align-self-end">
                                <a class="btn btn-outline-info pull-right" href="javascript:$('#search-form').submit();"><i class="fa fa-fw fa-lg fa-check-circle"></i>搜索</a>
                            </div>
                            <div class="form-group col-md-1 align-self-end">
                                <a class="btn btn-outline-secondary pull-right" href="{{ route('admin::comment.index') }}"><i class="fa fa-fw fa-lg fa-check-circle"></i>重置</a>
                            </div>
                            <div class="form-group col-md-1 align-self-end">
                                <a class="btn btn-outline-success pull-right" href="{{ route('admin::category.create') }}"><i class="fa fa-fw fa-lg fa-check-circle"></i>新增</a>
                            </div>
                        </form>
                    </div>
                    <div class="tile-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>用户名</th>
                                <th>标题</th>
                                <th>IP</th>
                                <th>评论状态</th>
                                <th>评论日期</th>
                                <th width="50">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($results['data']['list'] as $v)
                                    <tr>
                                        <td>{{ $v['name'] }}</td>
                                        <td>{{ $v['title'] }}</td>
                                        <td>{{ $v['ip'] }}</td>
                                        <td id="show_{{ $v['id'] }}">@if($v['show'] == 1){{ '显示' }}@else{{ '隐藏' }}@endif</td>
                                        <td>{{ $v['created_at'] }}</td>
                                        <td>
                                            <div class="toggle">
                                                <label title="显示 | 隐藏">
                                                    <input data-id="{{ $v['id'] }}" onchange="change_show(this)" type="checkbox" @if($v['show'] == 1){{ 'checked' }}@endif>
                                                    <span class="button-indecator"></span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @include('admin.common.paging')
                </div>
            </div>
        </div>
    </main>
@endsection

@section('otherStaticSecond')
    <script type="text/javascript">
        $(function () {
            $('#start_time, #end_time').datepicker({
                format: "yyyy-mm-dd",
                autoclose: true,
                todayHighlight: true,
                constrainInput:true,
                // container: '#search-form'
                disableTouchKeyboard: true,
                toggleActive: true
            });
        });
        function change_show(obj)
        {
            var id = $(obj).attr('data-id');
            var show = $(obj).prop('checked') === true ? 1 : 2;
            var showVal = show === 1 ? '显示' : '隐藏';
            $.ajax({
                'url': "/admin/comment/change_show/" + id,
                'type': 'post',
                'data': {'_token': '{{ csrf_token() }}', 'show': show},
                'dataType': 'json',
                'success': function (results) {
                    if (results.status) {
                        layer.msg('操作成功！');
                        $('#show_'+id).html(showVal);
                    } else {
                        layer.msg('操作失败！');
                    }
                }
            });
        }
    </script>
@endsection