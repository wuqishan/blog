@extends('common.base')
@section('otherJs')
    <!-- Add fancyBox main JS and CSS files -->
    <script src="{{ asset('/static/js/jquery.magnific-popup.js') }}" type="text/javascript"></script>
    <link href="{{ asset('/static/css/magnific-popup.css') }}" rel="stylesheet" type="text/css">
    <script>
        $(document).ready(function() {
            $('.popup-with-zoom-anim').magnificPopup({
                type: 'inline',
                fixedContentPos: false,
                fixedBgPos: true,
                overflowY: 'auto',
                closeBtnInside: true,
                preloader: false,
                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-zoom-in'
            });
        });
    </script>
    <!--animate-->
    <link href="{{ asset('/static/css/animate.css') }}" rel="stylesheet" type="text/css" media="all">
    <script src="{{ asset('/static/js/wow.min.js') }}"></script>
    <script>
        new WOW().init();
    </script>
@endsection

@section('content')

    @include('common.header', ['current' => 'gallery'])

    @include('common.gallery')

    @include('common.footer')

@endsection
