<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <meta name="csrf-token" content="{{ csrf_token() }}"/>
  <title>KalaChan Admin Dashboard</title>

  <!-- loader -->
  <link href="{{ asset('backend/assets/css/pace.min.css') }}" rel="stylesheet"/>
  <script src="{{ asset('backend/assets/js/pace.min.js') }}"></script>

  <!-- favicon -->
  <link rel="icon" href="{{ asset('backend/assets/images/favicon.ico') }}" type="image/x-icon">

  <!-- Vector CSS -->
  <link href="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>

  <!-- simplebar CSS -->
  <link href="{{ asset('backend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet"/>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet"/>

  <!-- animate CSS -->
  <link href="{{ asset('backend/assets/css/animate.css') }}" rel="stylesheet" type="text/css"/>

  <!-- Icons CSS -->
  <link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet" type="text/css"/>

  <!-- Sidebar CSS -->
  <link href="{{ asset('backend/assets/css/sidebar-menu.css') }}" rel="stylesheet"/>

  <!-- Custom Style -->
  <link href="{{ asset('backend/assets/css/app-style.css') }}" rel="stylesheet"/>

  <style>
    html, body {
      height: 100%;
      margin: 0;
      overflow-x: hidden; /* avoid horizontal scroll */
      overflow-y: auto;
      display: flex;
      flex-direction: column;
    }

    #wrapper {
      flex: 1 1 auto;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      padding-bottom: 60px; /* footer height */
      overflow: hidden; /* prevent double scroll */
    }

    .content-wrapper {
      flex: 1 1 auto;
      padding: 70px 20px 20px 20px;
      overflow-y: auto; /* scroll only content */
    }

    footer.footer {
      position: fixed;
      bottom: 0;
      width: 100%;
      height: 60px;
      color: white;
      line-height: 60px;
      text-align: center;
      z-index: 1000;
      box-shadow: 0 -2px 5px rgba(0,0,0,0.2);
    }
  </style>
</head>

<body class="bg-theme bg-theme1">

  <div id="wrapper">

    @include('admin.partials.topbar')
    @include('admin.partials.sidebar')

    <div class="content-wrapper">
      <div class="container-fluid">
        @yield('content')
      </div>
    </div>

    <a href="javascript:void(0);" class="back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright © 2025 KalachanStore
        </div>
      </div>
    </footer>

  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/bootstrap.min.js') }}"></script>

  <!-- simplebar js -->
  <script src="{{ asset('backend/assets/plugins/simplebar/js/simplebar.js') }}"></script>

  <!-- sidebar-menu js -->
  <script src="{{ asset('backend/assets/js/sidebar-menu.js') }}"></script>

  <!-- Custom scripts -->
  <script src="{{ asset('backend/assets/js/app-script.js') }}"></script>

  <!-- Index js -->
  <script src="{{ asset('backend/assets/js/index.js') }}"></script>

</body>
</html>
