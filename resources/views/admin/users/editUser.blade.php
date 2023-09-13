<!DOCTYPE html>
<html lang="en">
@include('admin.layout.header')


<body>
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
                            <span style="margin-left: 50px; color: red;">Thông Tin Tài Khoản</span>
                        </h2>
                    </div>
                    <div class=" card-body border ">
                        <form action="" enctype=" multipart/form-data" method="POST"  id="form-id">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="idnd" value="{{$datas->idnd}}" />
                            </div>
                            <div class="form-group">
                                <label for="mand">Mã nhân viên:</label>
                                <input type="text" class="form-control" id="mand" name="mand" value="{{$datas->mand}}">
                                @error('mand')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tennd">Tên:</label>
                                <input type="text" class="form-control" id="tennd" name="tennd" value="{{$datas->tennd}}">
                                @error('tennd')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="namsinh">Năm sinh:</label>
                                <input type="date" class="form-control" id="namsinh" name="namsinh" value="{{$datas->namsinh}}">
                                @error('namsinh')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="sdt">Số điện thoại:</label>
                                <input type="text" class="form-control" id="sdt" name="sdt" value="{{$datas->sdt}}">
                                @error('sdt')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Chức vụ:&nbsp; &nbsp; &nbsp;</label>
                                <select name="idcv" id="">
                                    @foreach ($position as $posi)
                                    @if($posi->idcv == $datas->idcv)
                                    <option value="{{$posi->idcv}}">{{$posi->tencv}}</option>
                                    @endif
                                    @endforeach

                                    @foreach ($position as $posi)
                                    @if($posi->idcv != $datas->idcv)
                                    <option value="{{$posi->idcv}}">{{$posi->tencv}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('idcv')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="usernameInput">
                                    Giới tính: </label>
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                @if ($datas->gtinh == 1)
                                <input type="radio" name="gtinh" checked value="1"> Nam &nbsp; &nbsp; &nbsp;
                                <input type="radio" name="gtinh" value="0"> Nữ
                                @else
                                <input type="radio" name="gtinh" value="1"> Nam &nbsp; &nbsp; &nbsp;
                                <input type="radio" name="gtinh" checked value="0"> Nữ


                                @endif
                            </div>

                            <input type="hidden" class="form-control" id="" value="" name="diachi">
                            <!-- <input type="hidden" class="form-control" id="" name="idxa"> -->

                            <div class="form-group">
                                <label for="">Tỉnh:&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</label>
                                <select name="idtp" id="city" class="choose city">
                                    @foreach ($province as $pro)
                                    @if($pro->idtp == $datas->idtp)
                                    <option value="{{$pro->idtp}}">{{$pro->name_city}}</option>
                                    @endif
                                    @endforeach

                                    @foreach ($province as $pro)
                                    @if($pro->idtp != $datas->idtp)
                                    <option value="{{$pro->idtp}}">{{$pro->name_city}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Quận/Huyện:&nbsp; &nbsp; &nbsp;</label>
                                <select name="idqh" id="district" class="choose district">
                                    @foreach ($district as $dis)
                                    @if($dis->idqh == $datas->idqh)
                                    <option value="{{$dis->idqh}}">{{$dis->name_district}}</option>
                                    @endif
                                    @endforeach

                                    @foreach ($district as $dis)
                                    @if($dis->idqh != $datas->idqh && $dis->idtp == $datas->idtp)
                                    <option value="{{$dis->idqh}}">{{$dis->name_district}}</option>
                                    @endif
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="">Xã/phường:&nbsp; &nbsp; &nbsp; &nbsp;</label>
                                <select name="idxa" id="town" class="choose town">
                                    @foreach ($town as $to)
                                    @if($to->idxa == $datas->idxa)
                                    <option value="{{$to->idxa}}">{{$to->name_town}}</option>
                                    @endif
                                    @endforeach

                                    @foreach ($town as $to)
                                    @if($to->idxa != $datas->idxa && $to->idqh == $datas->idqh)
                                    <option value="{{$to->idxa}}">{{$to->name_town}}</option>
                                    @endif
                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$datas->email}}">
                                @error('email')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="button" class="btn btn-success " onclick="document.getElementById('form-id').submit();" style="float: right; font-size: 20px;">Cập nhật</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('admin.layout.script')

</body>

</html>
