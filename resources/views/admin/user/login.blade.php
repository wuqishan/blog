@extends('admin.common.base')
@section('content')

    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h1>后台管理</h1>
        </div>
        <div class="login-box">
            <form class="login-form" action="{{ route('admin::user.do_login') }}">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>登陆</h3>
                <div class="form-group">
                    <label class="control-label">邮箱</label>
                    <input class="form-control" type="text" placeholder="Email" autofocus>
                </div>
                <div class="form-group">
                    <label class="control-label">密码</label>
                    <input class="form-control" type="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <div class="utility">
                        {{--<div class="animated-checkbox">--}}
                            {{--<label>--}}
                                {{--<input type="checkbox"><span class="label-text">记住密码</span>--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        <div class="login-with-other">
                            <a href="javascript:void(0);">
                                <img src="{{ asset('/static/admin/images/wechat.png') }}">
                            </a>
                        </div>

                        <p class="semibold-text mb-2"><a href="#" data-toggle="flip">忘记密码 ?</a></p>
                    </div>
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>登陆</button>
                </div>
            </form>
            <form class="forget-form" action="index.html">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>忘记密码 ?</h3>
                <div class="form-group">
                    <label class="control-label">邮箱</label>
                    <input class="form-control" type="text" placeholder="Email">
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>重置</button>
                </div>
                <div class="form-group mt-3">
                    <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> 返回登陆</a></p>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('otherStaticSecond')
    <script type="text/javascript">
        $('.login-content [data-toggle="flip"]').click(function() {
            $('.login-box').toggleClass('flipped');
            return false;
        });
    </script>
@endsection