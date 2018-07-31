@extends('admin.common.base')

@section('content')

    @include('admin.common.header')
    @include('admin.common.nav')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> 家庭成员列表</h1>
                <p>Table to display analytical data effectively</p>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active"><a href="#">Data Table</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form class="row">
                            <div class="form-group col-md-9">
                            </div>
                            <div class="form-group col-md-1 align-self-end">
                                <button class="btn-sm btn btn-outline-primary pull-right" name="search" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>搜索</button>
                            </div>
                            <div class="form-group col-md-1 align-self-end">
                                <button class="btn-sm btn btn-outline-info pull-right" name="reset" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>重置</button>
                            </div>
                            <div class="form-group col-md-1 align-self-end">
                                <a class="btn-sm btn btn-outline-success pull-right" href="{{ route('family.create') }}"><i class="fa fa-fw fa-lg fa-check-circle"></i>新增</a>
                            </div>
                            <div class="form-group col-md-3">
                                <input class="form-control" type="text" name="name" placeholder="请输入名称">
                            </div>
                            <div class="form-group col-md-3">
                                <input class="form-control" type="text" placeholder="Enter your email">
                            </div>
                            <div class="form-group col-md-3">
                                <input class="form-control" type="text" placeholder="Enter your email">
                            </div>
                            <div class="form-group col-md-3">
                                <input class="form-control" type="text" placeholder="Enter your email">
                            </div>
                        </form>
                    </div>
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="data-table-info"></table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('otherStaticSecond')
    <!-- Data table plugin-->
    <script type="text/javascript" src="{{ asset('/static/admin/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/static/admin/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        var option = {
            'columns': [
                {"data": 'id', 'title': 'ID', 'orderable': true},
                {"data": 'name', 'title': '名称', 'orderable': false},
                {"data": 'title', 'title': '称谓', 'orderable': false},
                {"data": 'age', 'title': '年龄', 'orderable': true},
                {"data": 'description', 'title': '描述', 'orderable': false},
                {"data": null, 'title': '操作', 'orderable': false},
            ],
            'columnDefs': [
                {
                    targets: 5,
                    render: function (a, b, c, d) {
                        var context = '<a href="javascript:void(0);" onclick="edit('+ a.id +')" class="badge badge-pill badge-info">编 辑</a>';
                        context += ' <a href="javascript:void(0);" onclick="del('+ a.id +')" class="badge badge-pill badge-warning">删 除</a>';
                        context += ' <a href="javascript:void(0);" onclick="show('+ a.id +')" class="badge badge-pill badge-primary">详 情</a>';
                        return context;
                    },
                    width: 120
                }
            ]
        };
        var table = $.sys_page('#data-table-info', '{{ route('family.index') }}', option);
        $('button[name=search]').click(function(){
            window.formData.name = $('input[name=name]').val();
            table.draw(true);
        });
    </script>
@endsection