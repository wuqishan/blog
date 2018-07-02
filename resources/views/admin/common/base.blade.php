<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="后台管理系统">
    <title>后台管理系统</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/static/admin/css/main.css') }}">
    <!-- Modify CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/static/admin/css/modify.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/static/admin/css/font-awesome.min.css') }}">

    @yield('otherStaticFirst')
</head>
<body class="app sidebar-mini rtl">

@yield('content')

<!-- Essential javascripts for application to work-->
<script src="{{ asset('/static/admin/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('/static/admin/js/popper.min.js') }}"></script>
<script src="{{ asset('/static/admin/js/bootstrap.min.js') }}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{ asset('/static/admin/js/plugins/pace.min.js') }}"></script>

<script src="{{ asset('/static/admin/js/main.js') }}"></script>
<script src="{{ asset('/static/admin/js/jquery.extend.js') }}"></script>

@yield('otherStaticSecond')
</body>
</html>
