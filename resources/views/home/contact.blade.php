@extends('common.base')
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

    @include('common.header', ['current' => 'contact'])

    @include('common.contact')

    @include('common.footer')
    
@endsection
