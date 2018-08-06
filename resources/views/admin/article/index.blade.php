@extends('admin.common.base')

@section('content')

    @include('admin.common.header')
    @include('admin.common.nav')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> 文章列表</h1>
                <p>Table to display analytical data effectively</p>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">文章管理</li>
                <li class="breadcrumb-item active"><a href="#">文章列表</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form class="row" id="search-form" action="{{ route('admin::article.index') }}" method="get">
                            <div class="form-group col-md-2">
                                <input class="form-control" autocomplete="off" type="text" name="title" value="{{ request()->get('title') }}" placeholder="标题">
                            </div>
                            <div class="form-group col-md-2">
                                <select class="form-control" name="delete">
                                    <option value="">选择删除状态</option>
                                    <option @if(request()->get('delete') == 1) selected @endif value="1">未删除</option>
                                    <option @if(request()->get('delete') == 2) selected @endif value="2">已删除</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <select class="form-control" name="publish">
                                    <option value="">选择发布状态</option>
                                    <option @if(request()->get('publish') == 1) selected @endif value="1">发布</option>
                                    <option @if(request()->get('publish') == 2) selected @endif value="2">未发布</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3"></div>
                            <div class="form-group col-md-1 align-self-end">
                                <a class="btn btn-outline-info pull-right" href="javascript:$('#search-form').submit();"><i class="fa fa-fw fa-lg fa-check-circle"></i>搜索</a>
                            </div>
                            <div class="form-group col-md-1 align-self-end">
                                <a class="btn btn-outline-secondary pull-right" href="{{ route('admin::article.index') }}"><i class="fa fa-fw fa-lg fa-check-circle"></i>重置</a>
                            </div>
                            <div class="form-group col-md-1 align-self-end">
                                <a class="btn btn-outline-success pull-right" href="{{ route('admin::article.create') }}"><i class="fa fa-fw fa-lg fa-check-circle"></i>新增</a>
                            </div>
                        </form>
                    </div>
                    <div class="tile-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>名称</th>
                                <th>等级</th>
                                <th>排序</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(isset($results['data']['list']))
                                    @foreach($results['data']['list'] as $v)
                                        <tr class="parent_{{ $v['parent_id'] }}">
                                            <td>┏━━━{{ $v['html'] }} {{ $v['title'] }}</td>
                                            <td>{{ $v['level'] }}</td>
                                            <td>{{ $v['order'] }}</td>
                                            <td width="120">
                                                {!! \App\Helper\OptionBtnHelper::get('edit', route('admin::article.edit', ['article' => $v['id']])) !!}
                                                {!! \App\Helper\OptionBtnHelper::get('del', 'del_record(\''. $v['id'] .'\')') !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('otherStaticSecond')
    <script type="text/javascript">
        function del_record(id)
        {
            layer.confirm('确定删除该条记录？', {
                skin: 'layui-layer-molv',
                btn: ['确定','取消']
            }, function() {
                $.ajax({
                    'url': "/admin/category/" + id,
                    'type': 'post',
                    'data': {'_method': 'DELETE', '_token': '{{ csrf_token() }}'},
                    'dataType': 'json',
                    'success': function (results) {
                        if (results.status) {
                            layer.msg('删除成功！', {'anim': -1, 'time': 4,}, function () {
                                location.href = '{{ route('admin::category.index') }}'
                            });
                        } else {
                            layer.msg('只能从最低层分类开始删除！');
                        }
                    }
                });
            });
        }
    </script>
@endsection