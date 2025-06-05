<!-- header begin -->
<header class="transparent">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="de-flex sm-pt10">
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

                    <div class="de-flex-col header-col-mid">
                        <!-- Add navigation here if needed -->
                        {{-- 
                        <ul id="mainmenu">
                            <li><a class="menu-item" href="{{ url('/') }}">Home</a></li>
                        </ul> 
                        --}}
                    </div>

                    <div class="de-flex-col">
                        <!-- Desktop buttons -->
                        <div class="menu_side_area d-none d-md-flex" style="gap: 10px;">
                            @guest
                                <a href="{{ route('login') }}" class="btn-main btn-line"><span>Login</span></a>
                                <a href="{{ route('register') }}" class="btn-main btn-line"><span>Register</span></a>
                            @endguest

                            @auth
                                <a href="{{ route('dashboard') }}" class="btn-main btn-line"><span>Dashboard</span></a>
                            @endauth
                        </div>

                        <!-- Mobile menu button -->
                        <span id="menu-btn" class="d-md-none"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile sidebar menu -->
    <div id="mobile-menu" class="mobile-menu d-md-none">
        @guest
            <a href="{{ route('login') }}" class="btn-main btn-line d-block mb-3"><span>Login</span></a>
            <a href="{{ route('register') }}" class="btn-main btn-line d-block mb-3"><span>Register</span></a>
        @endguest

        @auth
            <a href="{{ route('dashboard') }}" class="btn-main btn-line d-block mb-3"><span>Dashboard</span></a>
        @endauth
    </div>
</header>

<style>
    /* Hide menu-btn by default */
    #menu-btn {
        display: none;
        cursor: pointer;
        font-size: 28px;
        user-select: none;
    }

    /* Show menu-btn only on small screens */
    @media (max-width: 767px) {
        #menu-btn {
            display: block;
        }

        .menu_side_area {
            display: none !important;
        }
    }

    /* Show desktop menu only on md and up */
    @media (min-width: 768px) {
        .menu_side_area {
            display: flex !important;
        }

        .d-md-none {
            display: none !important;
        }
    }

    /* Mobile menu styling */
    #mobile-menu {
        display: none;
        background: #111;
        padding: 15px;
        position: fixed;
        top: 0;
        right: 0;
        height: 100vh;
        width: 250px;
        z-index: 1000;
        overflow-y: auto;
    }

    #mobile-menu .btn-main {
        width: 100%;
        text-align: center;
        margin-bottom: 1rem;
    }
</style>

<script>
    document.getElementById('menu-btn').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        if(menu.style.display === 'block') {
            menu.style.display = 'none';
        } else {
            menu.style.display = 'block';
        }
    });

    // Close menu if clicking outside on mobile
    window.addEventListener('click', function(e) {
        const menu = document.getElementById('mobile-menu');
        const btn = document.getElementById('menu-btn');
        if (menu.style.display === 'block' && !menu.contains(e.target) && !btn.contains(e.target)) {
            menu.style.display = 'none';
        }
    });
</script>
