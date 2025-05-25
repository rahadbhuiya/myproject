<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from srbthemes.kcubeinfotech.com/playhost/html/homepage-9.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 22 Apr 2025 05:38:41 GMT -->
<head>
    <title>Playhost - Game Hosting Website Template</title>
    <link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16">
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <meta content="Playhost - Game Hosting Website Template" name="description" >
    <meta content="" name="keywords" >
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="SRBThemes" name="author" >
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


<!-- Mirrored from srbthemes.kcubeinfotech.com/playhost/html/homepage-9.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 22 Apr 2025 05:38:47 GMT -->
</html>