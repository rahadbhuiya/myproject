<!-- header begin -->
<header class="transparent">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="de-flex sm-pt10 justify-content-between align-items-center">
                    <!-- Logo -->
                    <div class="de-flex-col">
                        <div id="logo">
                            <h2>KalachanStore</h2>
                        </div>
                    </div>

                    <!-- Optional center column -->
                    <div class="de-flex-col header-col-mid"></div>

                    <!-- Menu / Buttons -->
                    <div class="de-flex-col position-relative">
                        <div class="menu_side_area">

                            <!-- Desktop Buttons -->
                            <div class="menu-desktop d-none d-md-inline-block" >
                                @guest
                                    <a href="{{ route('login') }}" class="btn-main btn-line"><span>Login</span></a>
                                    <a href="{{ route('register') }}" class="btn-main btn-line"><span>Register</span></a>
                                @endguest
                                @auth
                                    <a href="{{ route('dashboard') }}" class="btn-main btn-line"><span>Dashboard</span></a>
                                @endauth
                            </div>

                            <!-- Mobile Menu Button -->
                            <div class="menu-mobile d-md-none">
                                <span id="menu-btn" class="btn-main btn-line" style="cursor: pointer;"></span>

                                <!-- Dropdown -->
                                <div id="menu-dropdown" class="menu-dropdown">
                                    @guest
                                        <a href="{{ route('login') }}" class="btn-main btn-line d-block mb-2 text-center"><span>Login</span></a>
                                        <a href="{{ route('register') }}" class="btn-main btn-line d-block text-center"><span>Register</span></a>
                                    @endguest
                                    @auth
                                        <a href="{{ route('dashboard') }}" class="btn-main btn-line d-block text-center"><span>Dashboard</span></a>
                                    @endauth
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header close -->

<!-- CSS -->
<style>
    .menu-dropdown {
        display: none;
        position: absolute;
        bottom:  50px;
        padding-left: 20px;
        z-index: 9999;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        min-width: 180px;
    }

    @media (max-width: 767.98px) {
        .menu-dropdown {
            width: 100%;
            left: -300px;
            right: 0;
            top: 200px;
            border-radius: 0;
        }
    }
</style>

<!-- JS -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const menuBtn = document.getElementById("menu-btn");
        const dropdown = document.getElementById("menu-dropdown");

        if (menuBtn) {
            menuBtn.addEventListener("click", function () {
                dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
            });

            document.addEventListener("click", function (event) {
                if (!menuBtn.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.style.display = "none";
                }
            });
        }
    });
</script>
