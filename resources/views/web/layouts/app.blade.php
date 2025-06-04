<!DOCTYPE html>
<html lang="en">



<head>
    <title>KalaChan Store</title>
    <link rel="icon" href="/kalachan.png" type="image/png" sizes="16x16">
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <meta content="This is kalachan gaming website" name="description" >
    <meta content="" name="keywords" >
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS Files
    ================================================== -->
    <link href="{{asset('fontend/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="{{asset('fontend/css/plugins.css')}}" rel="stylesheet" type="text/css" >
    <link href="{{asset('fontend/css/swiper.css')}}" rel="stylesheet" type="text/css" >
    <link href="{{asset('fontend/css/style.css')}}" rel="stylesheet" type="text/css" >
    <link href="{{asset('fontend/css/coloring.css')}}" rel="stylesheet" type="text/css" >
    <!-- color scheme -->
    <link id="colors" href="{{asset('fontend/css/colors/scheme-01.css')}}" rel="stylesheet" type="text/css" >
    @stack('styles')
</head>

<body class="dark-scheme">
    <div id="wrapper">
        <div class="float-text show-on-scroll">
            <span><a href="#">Scroll to top</a></span>
        </div>
        <div class="scrollbar-v show-on-scroll"></div>
        <!-- page preloader begin -->
        <div id="de-loader"></div>
        <!-- page preloader close -->

        @include('web.partials.header')

      

            @yield('content')

        @include('web.partials.footer')





 
    <!-- Javascript Files
    ================================================== -->
    <script src="{{asset('fontend/js/plugins.js')}}"></script>
    <script src="{{asset('fontend/js/designesia.js')}}"></script>
    <script src="{{asset('fontend/js/jquery.countdown.js')}}"></script>
    <script src="{{asset('fontend/js/countdown-custom.js')}}"></script>
    <script src="{{asset('fontend/js/custom-marquee.js')}}"></script>
    <script src="{{asset('fontend/js/swiper.js')}}"></script>
    <script src="{{asset('fontend/js/custom-swiper-1.js')}}"></script>
    @stack('scripts')

</body>


</html>