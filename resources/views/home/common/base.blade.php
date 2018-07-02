<!DOCTYPE HTML>
<html>
<head>
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);
        function hideURLbar(){
            window.scrollTo(0,1);
        }
    </script>
    <link href="{{ asset('/static/css/bootstrap.css') }}" rel='stylesheet' type='text/css' />
    <!--Custom-Theme-files-->
    <link href="{{ asset('/static/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('/static/css/component.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('/static/css/nav.css') }}" rel='stylesheet' type='text/css' />

    <script src="{{ asset('/static/js/jquery.min.js') }}"> </script>
    <!--/script-->
    <script src="{{ asset('/static/js/modernizr.custom.js') }}"> </script>
    <script type="text/javascript" src="{{ asset('/static/js/move-top.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/static/js/easing.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},900);
            });
        });
    </script>
    @yield('otherJs')
</head>
<body>


@yield('content')


<!--copy-right-->
<div class="copy">
    <p class="wow fadeInUp animated animated" data-wow-delay=".5s">Copyright &copy; 2018 Wells.All rights reserved</p>
</div>

<!--start-smooth-scrolling-->
<script type="text/javascript">
    $(document).ready(function() {
        $().UItoTop({ easingType: 'easeOutQuart' });
    });
</script>
<a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<script src="{{ asset('/static/js/rAF.js') }}"></script>
<script src="{{ asset('/static/js/demo-2.js') }}"></script>
<script src="{{ asset('/static/js/main.js') }}"></script> <!-- Resource jQuery -->

<!-- for bootstrap working -->
<script src="{{ asset('/static/js/bootstrap.js') }}"></script>
<!-- //for bootstrap working -->

</body>
</html>