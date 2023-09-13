<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login V5</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('images/icons/favicon.ico')}}" />
    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" type="text/css" href="css/util.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" /> -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/util.css')}}" rel="stylesheet">
    <!--===============================================================================================-->
</head>

<body>
    <div class="limiter">
        <div class="container-login100 bg-info">
            <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
                <div class="card-body">
                    <div class=" text-center">
                        <h2 class="text-uppercase font-weight-bold " style="color:red"> Đăng Nhập</h2>

                        <hr>
                    </div>
                    @if (session('error'))
                    <div class="alert alert-success">
                        {{ session('error') }}
                    </div>
                    @endif
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
                        <div class="d-flex">
                            <div class="pr-5 form-group form-check ">
                                <input type="checkbox" class="form-check-input">
                                <label class="form-check-label"> Ghi nhớ tôi</label>
                            </div>
                            <div class="pr-5"></div>
                            <div class="pr-5"></div>
                            <div class="pr-4">
                                <a href="#" style="float: right;">Quên mật khẩu?</a>
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
        </div>
    </div>

    <!--===============================================================================================-->
</body>

</html>