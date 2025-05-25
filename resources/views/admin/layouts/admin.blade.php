<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Dashtreme Admin - Free Dashboard for Bootstrap 4 by Codervent</title>
  <!-- loader-->
  <link href="{{asset('backend/assets/css/pace.min.css')}}" rel="stylesheet"/>
  <script src="{{asset('backend/assets/js/pace.min.js')}}"></script>
  <!--favicon-->
  <link rel="icon" href="{{asset('backend/assets/images/favicon.ico')}}" type="image/x-icon">
  <!-- Vector CSS -->
  <link href="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
  <!-- simplebar CSS-->
  <link href="{{asset('backend/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="{{asset('backend/assets/css/animate.css')}}" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="{{asset('backend/assets/css/icons.css')}}" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="{{asset('backend/assets/css/sidebar-menu.css')}}" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="{{asset('backend/assets/css/app-style.css')}}" rel="stylesheet"/>
  
</head>

<body class="bg-theme bg-theme1">
 	
    <!-- Start wrapper-->
 <div id="wrapper">
    
    
    @include('admin.partials.topbar')
    @include('admin.partials.sidebar')
    <!--Start content-wrapper-->
    <div class="content-wrapper">
        <div class="container-fluid">
            <!--Start Dashboard Content-->
            @yield('content')
            <!--End Dashboard Content-->
        </div>
        <!--End container-fluid-->
        <!--Start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->
    
    
    
    
    <!--start overlay-->
    <div class="overlay toggle-menu"></div>
    <!--end overlay-->
    
</div>
<!-- End container-fluid-->

</div><!--End content-wrapper-->
<!--Start Back To Top Button-->
<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
<!--End Back To Top Button-->

<!--Start footer-->
<footer class="footer">
  <div class="container">
    <div class="text-center">
      Copyright © 2018 Admin 🫁
    </div>
  </div>
</footer>
<!--End footer-->

{{-- <!--start color switcher-->
<div class="right-sidebar">
<div class="switcher-icon">
  <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
</div>
<div class="right-sidebar-content"> --}}

  {{-- <p class="mb-0">Gaussion Texture</p>
  <hr>
  
  <ul class="switcher">
    <li id="theme1"></li>
    <li id="theme2"></li>
    <li id="theme3"></li>
    <li id="theme4"></li>
    <li id="theme5"></li>
    <li id="theme6"></li>
  </ul>

  <p class="mb-0">Gradient Background</p>
  <hr>
  
  <ul class="switcher">
    <li id="theme7"></li>
    <li id="theme8"></li>uuu
    <li id="theme14"></li>
    <li id="theme15"></li>
  </ul> --}}
  
 </div>
</div>
<!--end color switcher-->

</div><!--End wrapper-->

<!-- Bootstrap core JavaScript-->
<script src="{{asset('backend/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('backend/assets/js/popper.min.js')}}"></script>
<script src="{{asset('backend/assets/js/bootstrap.min.js')}}"></script>

<!-- simplebar js -->
<script src="{{asset('backend/assets/plugins/simplebar/js/simplebar.js')}}"></script>
<!-- sidebar-menu js -->
<script src="{{asset('backend/assets/js/sidebar-menu.js')}}"></script>
<!-- loader scripts -->
{{-- <script src="{{asset('backend/assets/js/jquery.loading-indicator.js')}}"></script> --}}
<!-- Custom scripts -->
<script src="{{asset('backend/assets/js/app-script.js')}}"></script>
<!-- Chart js -->

{{-- <script src="{{asset('backend/assets/plugins/ChascriptChart.min.js')}}"></script> --}}

<!-- Index js -->
<script src="{{asset('backend/assets/js/index.js')}}"></script>


</body>
</html>