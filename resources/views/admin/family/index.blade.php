@extends('admin.common.base')

@section('content')

    @include('admin.common.header')
    @include('admin.common.nav')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Data Table</h1>
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
                            <div class="form-group col-md-3">
                                <input class="form-control" type="text" placeholder="Enter your name">
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
                            <div class="form-group col-md-9 margin-bottom0">
                            </div>
                            <div class="form-group col-md-2 align-self-end margin-bottom0">
                                <button class="btn btn-primary pull-right" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>搜索</button>
                            </div>
                            <div class="form-group col-md-1 align-self-end margin-bottom0">
                                <button class="btn btn-primary pull-right" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>重置</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable"></table>
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
                {"data": 'age', 'title': '年龄', 'orderable': true},
                {"data": 'description', 'title': '描述', 'orderable': false},
                {"data": null, 'title': '操作', 'orderable': false, 'width': 100},
            ],
            'columnDefs': [
                {
                    targets: 4,
                    render: function (a, b, c, d) {
                        var context = '<input type="button" onclick="edit('+ a.id +')" class="btn btn-info btn-sm" value="编辑">'
                        context += ' <input type="button" del('+ a.id +') class="btn btn-danger btn-sm" value="删除">';

                        console.log(a,b,c,d);

                        return context;
                    }
                }

            ]
        };
        $.sys_page('#sampleTable', '{{ route('family.index') }}', option, {});
    </script>
@endsection