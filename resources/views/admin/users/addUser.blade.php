<!DOCTYPE html>
<html lang="en">
@include('admin.layout.header')


<body>
    <!-- <div class="container-scroller">
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0">
                <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
                    <div class="ps-lg-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                            <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template/"><i class="mdi mdi-home me-3 text-white"></i></a>
                        <button id="bannerClose" class="btn border-0 p-0">
                            <i class="mdi mdi-close text-white me-0"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div> -->
    <!-- partial:partials/_navbar.html -->
    @include('admin.layout.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.layout.sidebar')

        <!-- partial -->
        <div class="main-panel bt-5">
            <!-- content-wrapper -->
            <div class="container-fluid row ">

                <div class="col-3"></div>
                <div class="card col-6 mt-3">
                    <div class="">
                        <h2 class="text-uppercase font-weight-bold p-4" style="color:palevioletred">
                            <a href="{{asset('admin/user')}}"><i class="fa-solid fa-left-long"></i></a>
                            <span style="margin-left: 80px; color: red;">Đăng Ký Tài Khoản</span>
                        </h2>
                    </div>
                    @if (session('success'))
                    <div class=" alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class=" card-body border ">
                        <form action="{{asset('admin/user/add')}}" enctype=" multipart/form-data" method="POST" id="form-id">
                            @csrf
                            <input type="hidden" class="form-control" id="" name="level">

                            <div class="form-group">
                                <label for="mand">Mã nhân viên:</label>
                                <input type="text" class="form-control" id="mand" name="mand">
                                @error('mand')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tennd">Tên:</label>
                                <input type="text" class="form-control" id="tennd" name="tennd">
                                @error('tennd')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="namsinh">Năm sinh:</label>
                                <input type="date" class="form-control" id="namsinh" name="namsinh">
                                @error('namsinh')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="sdt">Số điện thoại:</label>
                                <input type="text" class="form-control" id="sdt" name="sdt">
                                @error('sdt')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Chức vụ:&nbsp; &nbsp; &nbsp;</label>
                                <select name="idcv" id="">
                                    <option value="">---Chọn---</option>
                                    @foreach ($position as $pro)
                                    <option value="{{$pro->idcv}}">{{$pro->tencv}}</option>
                                    @endforeach
                                </select>
                                @error('idcv')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Giới tính: </label>
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                <input type="radio" name="gtinh" checked value="1"> Nam &nbsp; &nbsp; &nbsp;
                                <input type="radio" name="gtinh" value="0"> Nữ
                            </div>
                            <!-- <div class="form-group">
                                <label for="diachi">Địa chỉ:</label>
                                <input type="text" class="form-control" id="diachi" name="diachi">
                                @error('diachi')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div> -->
                            <input type="hidden" class="form-control" id="" name="diachi">
                            <!-- <input type="hidden" class="form-control" id="" name="idxa"> -->

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
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email">
                                @error('email')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="pwd">Mật khẩu:</label>
                                <input type="password" class="form-control" id="pwd" name="password">
                                @error('password')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pwd">Nhập lại mật khẩu:</label>
                                <input type="password" class="form-control" id="pwd" name="password_confirmation">
                                @error('password_confirmation')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="button" class="btn btn-success " style="float: right; font-size: 20px;" onclick="document.getElementById('form-id').submit();">Đăng ký</button>
                            <!-- <button type="button" class="btn btn-success add-user" name="add-user" style="float: right; font-size: 20px;">Đăng ký</button> -->
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('admin.layout.script')

</body>

</html>