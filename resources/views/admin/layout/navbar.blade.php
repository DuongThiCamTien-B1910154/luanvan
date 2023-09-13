<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row ">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html"><i class="fa-solid fa-van-shuttle"></i><b> BusLine</b> </a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{asset('/images/logo-mini.svg')}}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <div class="search-field d-none d-md-block">

        </div>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                @if (!Auth::guest())
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="nav-profile-img">
                        <img src="{{asset('/images/faces/logo.png')}}" alt="image">
                        <span class="availability-status online"></span>
                    </div>
                    <div class="nav-profile-text">
                        @foreach ($users as $key => $user)
                        @if($user->idnd == auth('admin')->user()->idnd)
                        <p class="mb-1 text-black">{{ $user->tennd}}</p>
                        @endif
                        @endforeach
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">

                    <!-- <a class="dropdown-item" href="#">
                        <i class="mdi mdi-logout me-2 text-primary"></i><span class="text-dark">Signout</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{asset('/admin/logout')}}">
                        <i class="mdi mdi-power me-2 text-danger"></i> <span class="text-dark">Logout</span>
                    </a> -->

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{asset('/admin/logout')}}">
                        <i class="mdi mdi-power me-2 text-danger"></i> <span class="text-dark">Đăng xuất</span>
                    </a>
                </div>

                @endif
            </li>


        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>