@extends('admin.common.base')

@section('content')

    @include('admin.common.header')
    @include('admin.common.nav')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> 分类列表</h1>
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
                                <button class="btn-sm btn btn-outline-primary pull-right" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>搜索</button>
                            </div>
                            <div class="form-group col-md-1 align-self-end">
                                <button class="btn-sm btn btn-outline-info pull-right" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>重置</button>
                            </div>
                            <div class="form-group col-md-1 align-self-end">
                                <a class="btn-sm btn btn-outline-success pull-right" href="{{ route('category.create') }}"><i class="fa fa-fw fa-lg fa-check-circle"></i>新增</a>
                            </div>

                            <div class="form-group col-md-3">
                                <input class="form-control" type="text" placeholder="Enter your name">
                            </div>
                        </form>
                    </div>
                    <div class="tile-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>名称</th>
                                <th>等级</th>
                                <th>排序</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($results['list']['data'] as $v)
                                    <tr class="@if($v['level'] == 1){{ 'table-success' }}@elseif($v['level'] == 2){{ 'table-info' }}@else{{ 'table-danger' }}@endif">
                                        <td>{{ $v['id'] }}</td>
                                        <td>---{{ $v['html'] }} {{ $v['title'] }}</td>
                                        <td>{{ $v['level'] }}</td>
                                        <td>{{ $v['order'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('otherStaticSecond')
    <!-- Data table plugin-->
    <script type="text/javascript">

    </script>
@endsection