@extends('home.common.base')
@section('otherJs')
    <!--animate-->
    <link href="{{ asset('/static/css/animate.css') }}" rel="stylesheet" type="text/css" media="all">
    <script src="{{ asset('/static/js/wow.min.js') }}"></script>
    <script>
        new WOW().init();
    </script>
    <!--//end-animate-->
@endsection

@section('content')

    @include('home.common.header', ['current' => 'contact'])

    @include('home.common.contact')

    @include('home.common.footer')
    
@endsection
