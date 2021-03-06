@extends('admin.common.base')
@section('otherStaticFirst')
    <link rel="stylesheet" type="text/css" href="{{ asset('/static/admin/css/upload.css') }}">
@endsection
@section('content')

    @include('admin.common.header')
    @include('admin.common.nav')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-plus-square"></i> 商品导入</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">商品导入管理</li>
                <li class="breadcrumb-item"><a href="#">编辑</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form id="form-data" class="row">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <div class="form-group col-md-6">
                                <label>导入商品(名称 / 库存) :</label>
                                <select class="form-control" name="goods_id">
                                    <option value="">请选择</option>
                                    @foreach($results['form'] as $v)
                                        <option @if($results['detail']['goods_id'] == $v['id']) selected @endif value="{{ $v['id'] }}">{{ $v['title'] }} / {{ $v['stock'] }}</option>
                                    @endforeach
                                </select>
                                <div class="form-control-feedback"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>导入数量 :</label>
                                <input class="form-control" type="text" name="number" value="{{ $results['detail']['number'] }}" placeholder="请输入">
                                <div class="form-control-feedback"></div>
                            </div>
                            <div class="form-group col-md-6"></div>
                            <div class="form-group col-md-12 upload_area"></div>
                            <div class="form-group col-md-12">
                                <label>简述 :</label>
                                <textarea class="form-control" name="description" rows="3">{{ $results['detail']['description'] }}</textarea>
                            </div>
                        </form>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary submit" type="button">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('otherStaticSecond')
    <script src="{{ asset('/static/admin/js/plugins/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('/static/admin/js/plugins/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('/static/admin/js/plugins/jquery.fileupload.js') }}"></script>
    <!-- Data table plugin-->
    <script type="text/javascript">
        $(function () {
            var option = {
                'url': '{{ route("admin::upload") }}',
                'defaultImg': "{{ asset('/static/admin/images/upload.png') }}",
                'uploadAreaObj': $('.upload_area'),
                'formData': {'_token': '{{ csrf_token() }}', 'name': 'photo'},
                'multiple': true,
                'hiddenName': 'image_id',
                'label': '导入凭据',
                'initInfo': $.parseJSON('{!! json_encode($results["detail"]["images"]) !!}')
            };
            $.sys_upload_img(option);

            var sub_opt = {
                'formSelector': '#form-data',
                'url': '{{ route("admin::goods_import.update", ['goods_import_id' => request()->goods_import_id]) }}',
                'goTo': '{{ route('admin::goods_import.index') }}'
            };
            $('.submit').click(function () {
                $.sys_submit(sub_opt);
            });
        });
    </script>
@endsection