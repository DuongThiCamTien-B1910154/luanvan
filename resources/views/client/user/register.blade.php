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
                    <div class="">
                        <h2 class="text-uppercase font-weight-bold p-4" style="color:palevioletred">
                            <span style="margin-left:100px; color: red;">Đăng Ký Tài Khoản</span>
                        </h2>
                    </div>
                    @if (session('success'))
                    <div class=" alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class=" card-body border ">
                        <form action="{{asset('client/user/register')}}" enctype=" multipart/form-data" method="POST" id="form-id">
                            @csrf
                            <div class="form-group">
                                <label for="tennd">Họ tên:</label>
                                <input type="text" class="form-control" id="tennd" placeholder="Nhập họ tên" name="tennd">
                                @error('tennd')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="Nhập email" name="email">
                                @error('email')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="sdt">Số điện thoại:</label>
                                <input type="text" class="form-control" id="sdt" placeholder="Nhập số điện thoại" name="sdt">
                                @error('sdt')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="hidden" class="form-control" id="" name="diachi">

                            <div class="form-group">
                                <label for="">
                                    Giới tính: </label>
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                <input type="radio" name="gtinh" checked value="1"> Nam &nbsp; &nbsp; &nbsp;
                                <input type="radio" name="gtinh" value="0"> Nữ
                            </div>
                            <div class="form-group">
                                <label for="">Tỉnh:&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</label>
                                <select name="idtp" id="city" class="choose city">
                                    <option value="">--- Chọn Tỉnh ---</option>
                                    @foreach ($province as $pro)
                                    <option value="{{$pro->idtp}}">{{$pro->name_city}}</option>
                                    @endforeach
                                </select>
                                @error('idtp')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Quận/Huyện:&nbsp; &nbsp; &nbsp;</label>
                                <select name="idqh" id="district" class="choose district">
                                    <option value="">--- Chọn quận/huyện---</option>
                                </select>
                                @error('idqh')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Xã/phường:&nbsp; &nbsp; &nbsp; &nbsp;</label>
                                <select name="idxa" id="town" class="choose town">
                                    <option value="">---Chọn xã/phường---</option>
                                </select>
                                @error('idxa')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pwd">Mật khẩu:</label>
                                <input type="password" class="form-control" id="pwd" placeholder="Nhập mật khẩu" name="password">
                                @error('password')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pwd">Nhập lại mật khẩu:</label>
                                <input type="password" class="form-control" id="pwd" placeholder="Nhập lại mật khẩu" name="password_confirmation">
                                @error('password_confirmation')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="button" class="p btn btn-primary btn-block justify-content-end" onclick="document.getElementById('form-id').submit();" style="font-size: 20px;">
                                Đăng ký
                            </button>
                            <!-- <button type="button" class="btn btn-primary " style=" font-size: 20px;" onclick="document.getElementById('form-id').submit();">Đăng ký</button> -->
                            <!-- <button type="button" class="btn btn-success add-user" name="add-user" style="float: right; font-size: 20px;">Đăng ký</button> -->
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
        <!-- @include('client.layout.script') -->
    </div>

</body>

</html>