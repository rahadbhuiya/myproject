<!-- header begin -->
<header class="transparent">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="de-flex sm-pt10">
                    <div class="de-flex-col">
                        <div class="de-flex-col">
                            <!-- logo begin -->
                            <div id="logo">
                                <a href="{{ url('/') }}">
                                    {{-- Uncomment below if you want to use logo image --}}
                                    {{-- 
                                    <img class="logo-main" style="height: 100px" src="{{ asset('fontend/images/kalachanLogo.jpeg') }}" alt="">
                                    <img class="logo-mobile" src="{{ asset('fontend/images/kalachanLogo.jpeg') }}" alt="">
                                    --}}
                                    <h2>KalachanStore</h2>
                                </a>
                            </div>
                            <!-- logo close -->
                        </div>
                    </div>

                    <div class="de-flex-col header-col-mid">
                        <!-- Add navigation here if needed -->
                        <!-- 
                        <ul id="mainmenu">
                            <li><a class="menu-item" href="{{ url('/') }}">Home</a></li>
                        </ul> 
                        -->
                    </div>

                    <div class="de-flex-col">
                        <div class="menu_side_area">
                            @guest
                                <a href="{{ route('login') }}" class="btn-main btn-line"><span>Login</span></a>
                                <a href="{{ route('register') }}" class="btn-main btn-line"><span>Register</span></a>
                            @endguest

                            @auth
                                <a href="{{ route('dashboard') }}" class="btn-main btn-line"><span>Dashboard</span></a>
                                <!-- <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-main btn-line"><span>Logout</span></button>
                                </form> -->
                            @endauth

                            <span id="menu-btn"></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>
<!-- header close -->
