<!DOCTYPE html>
<html lang="en">

@include('client.layout.header')


<body class="preloading">

    @include('client.layout.nav')
    <div class="main">

        <br>
        <div class="container-fluid row">
            <div class="col-1"></div>
            <div class="pl-3"></div>
            <div class="col-10 row ">

                <!-- day la noi dung -->
                <div class="col-3"></div>
                <div class="card col-6 mt-3">
                    <div class=" text-center">
                        <h2 class="text-uppercase font-weight-bold mt-3 " style="color:red"> Đăng Nhập</h2>

                        <hr>
                    </div>
                    @if (session('error'))
                    <div class="alert alert-success">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class=" card-body border ">
                        <form action="" enctype="multipart/form-data" method="post" class="mt-4">

                            <div class="form-group">
                                <label for="usernameInput" class="mb-2">
                                    Email:
                                </label>

                                <input type="email" name="email" id="email" class="form-control " placeholder="Nhập tên Email">
                                @error('email')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="passwordInput" class="mb-2">
                                    Mật khẩu:
                                </label>
                                <input type="password" name="password" id="passwordInput" class="form-control" placeholder="Nhập mật khẩu">
                                @error('password')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            <div class="row">
                                <a class="btn btn-lg btn-google  btn-outline btn-block " href="{{asset('client/user/login/google/redirect')}}"><img src="https://img.icons8.com/color/16/000000/google-logo.png" height="30px"> Login with Google</a>
                            </div>
                            <br>
                            <div class="d-flex">
                                <div class="pr-5 form-group form-check ">
                                    <input type="checkbox" class="form-check-input">
                                    <label class="form-check-label"> Ghi nhớ tôi</label>
                                </div>
                                <div class="pr-5"></div>
                                <div class="pr-5"></div>
                                <div class="pr-5"></div>
                                <div class="pr-3"></div>
                                <div class="pr-4 row">
                                    Quên mật khẩu? &nbsp;<a href="{{asset('client/user/register')}}" style="float: right;"> Đăng ký</a>
                                </div>
                            </div>
                            <br>

                            <button class="p btn btn-primary btn-block justify-content-end" style="font-size: 20px;">
                                Đăng Nhập
                            </button>

                            @csrf
                        </form>
                    </div>
                </div>
                <div class="col-3"></div>
                <!-- het noi dung -->
            </div>
            <div class="col-1"></div>

        </div>
        <br>
        <!-- noi dung -->
        @include('client.layout.footer')
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script src="js/script.js"></script>
        @include('client.layout.script')
    </div>

</body>

</html>