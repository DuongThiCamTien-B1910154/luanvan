<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{asset('/images/faces/logo.png')}}" alt="profile">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    @foreach ($users as $key => $user)
                    @if($user->idnd == auth('admin')->user()->idnd)
                    <span class="font-weight-bold ">{{$user->tennd}}</span>
                    @endif
                    @endforeach
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>

        @if(Auth::user()->idcv == '1' && auth('admin')->user()->level != 0 || Auth::user()->idcv == '4')
        <li class="nav-item">
            <a class="nav-link" href="{{asset('admin/bus')}}">
                <span class="menu-title">Xe</span>
                <i class="fa-solid fa-bus menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{asset('admin/route')}}">
                <span class="menu-title">Tuyến đường</span>
                <i class="fa-solid fa-route menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{asset('admin/trip')}}">
                <span class="menu-title">Chuyến xe</span>
                <i class="fa-solid fa-business-time menu-icon"></i>
            </a>
        </li>
        @elseif (Auth::user()->idcv == '2' )

        <li class="nav-item">
            <a class="nav-link" href="{{asset('admin/ticket')}}">
                <span class="menu-title">Vé Xe</span>
                <i class="fa fa-ticket menu-icon"></i>
            </a>
        </li>
        @elseif (Auth::user()->idcv == '3')
        <li class="nav-item">
            <a class="nav-link" href="{{asset('admin/user')}}">
                <span class="menu-title">Nhân viên</span>
                <i class=" fa-solid fa-user menu-icon"></i>
            </a>
        </li>
        @else
        <!-- <li class="nav-item">
            <a class="nav-link" href="{{asset('admin')}}">
                <span class="menu-title">Trang chủ</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" href="{{asset('admin/user')}}">
                <span class=" menu-title">Nhân viên</span>
                <i class=" fa-solid fa-user menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{asset('admin/bus')}}">
                <span class="menu-title">Xe</span>
                <i class="fa-solid fa-bus menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{asset('admin/route')}}">
                <span class="menu-title">Tuyến đường</span>
                <i class="fa-solid fa-route menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{asset('admin/trip')}}">
                <span class="menu-title">Chuyến xe</span>
                <i class="fa-solid fa-business-time menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{asset('admin/ticket')}}">
                <span class="menu-title">Vé Xe</span>
                <i class="fa fa-ticket menu-icon"></i>
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="{{asset('admin/statistic')}}">
                <span class="menu-title">Thống kê</span>
                <i class="fa fa-ticket menu-icon"></i>
            </a>
        </li> -->
        @endif

        <!-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Quản lý nhân viên</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
            </a>
            <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                </ul>
            </div>
        </li> -->

    </ul>
</nav>