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
                <h1><i class="fa fa-plus-square"></i> 添加家庭成员</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">家庭成员管理</li>
                <li class="breadcrumb-item"><a href="#">列表</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form id="form-data" class="row">
                            {{ csrf_field() }}
                            <div class="form-group col-md-6">
                                <label>名称 :</label>
                                <input class="form-control" type="text" name="name" placeholder="请输入">
                                <div class="form-control-feedback"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>年龄 :</label>
                                <input class="form-control" type="number" name="age" placeholder="请输入">
                                <div class="form-control-feedback"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>关系 :</label>
                                <input class="form-control" type="text" name="relationship" placeholder="请输入">
                            </div>
                            <div class="form-group col-md-6"></div>
                            <div class="form-group col-md-12">
                                <label>照片 :</label><br>

                                <div class="upload-img-box" id="file-input-position-control">
                                    <input type="file" name="photo" id="photo" multiple>
                                    <img src="{{ asset('/static/admin/images/upload.png') }}">
                                </div>
                                <div class="bs-component upload-progress">
                                    <div class="progress mb-2">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="temp_files" class="temp_files" value="">
                            </div>
                            <div class="form-group col-md-12">
                                <label>简述 :</label>
                                <textarea class="form-control" name="description" rows="3"></textarea>
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
                'selector': '#photo',
                'showPosition': '#file-input-position-control',
                'url': '{{ route("upload.photo") }}',
                'formData': {'_token': '{{ csrf_token() }}'},
                'multiple': false
            };
            $.sys_upload_img(option);

            $('.submit').click(function(){
                $('#form-data').ajaxSubmit({
                    url: '{{ route("family.store") }}',
                    type: 'post',
                    dataType: 'json',
                    clearForm: true,
                    success: function(res){
                        // console.log(res);
                    },
                    error: function(err){
                        console.log(err);
                        if (err.hasOwnProperty('responseJSON') && err.responseJSON.hasOwnProperty('errors')) {
                            for (var i in err.responseJSON.errors) {
                                $('[name='+ i +']').next('.form-control-feedback').html(err.responseJSON.errors[i][0]);
                            }
                        }

                    }
                });
            });
        });
    </script>
@endsection