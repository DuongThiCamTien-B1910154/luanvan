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
                            <a href="{{asset('admin/trip')}}"><i class="fa-solid fa-left-long"></i></a>
                            <span style="margin-left: 70px; color: red;">Cập nhật chuyến xe</span>
                        </h2>
                    </div>
                    @if (session('success'))
                    <div class=" alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class=" card-body border ">
                        <form action="" enctype=" multipart/form-data" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Ngày chạy:</label>
                                <input type="date" class="form-control dateRunEdit" id="dateRunEdit" name="ngaychay" value="{{$data->ngaychay}}">
                                @error('ngaychay')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="diemKH">Chạy tuyến: </label>
                                <select name="idtuyen" id="">
                                    @foreach ($routes as $route)
                                    @if($route->idtuyen == $data->idtuyen)
                                    <option value="{{$route->idtuyen}}">{{$route->tentuyen}}</option>
                                    @endif
                                    @endforeach
                                    @foreach ($routes as $route)
                                    @if($route->idtuyen != $data->idtuyen)
                                    <option value="{{$route->idtuyen}}">{{$route->tentuyen}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            @foreach ($buss as $bus)
                                @if($bus->idxe == $data->idxe)
                                <input type="hidden" value="{{$bus->idxe}}" class="idxeOld" id="idxeOld"></input>
                                @endif
                            @endforeach
                            <input type="hidden" class="form-control dateOld" id="dateOld" name="ngaychay" value="{{$data->ngaychay}}">
                            <div class="form-group">
                                <label for="idxe">Xe chạy: &nbsp;&nbsp; </label>
                                <select name="idxe" id="idxe">
                                    @foreach ($buss as $bus)
                                    @if($bus->idxe == $data->idxe)
                                    <option value="{{$bus->idxe}}">{{$bus->bienso}}-{{$bus->tenloai}}</option>
                                    @endif
                                    @endforeach
                                    @foreach ($busRunEdits as $busRunEdit)
                                    <option value="{{$busRunEdit->idxe}}">{{$busRunEdit->bienso}}-{{$busRunEdit->tenloai}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Giờ xuất bến:</label>
                                <input type="time" class="form-control" id="tg_xuatben" name="tg_xuatben" value="{{$data->tg_xuatben}}">
                                @error('tg_xuatben')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="">Tài xế: &nbsp;&nbsp; </label>
                                <select name="idadmin" id="">
                                    @foreach ($admins as $admin)
                                    @if($admin->idadmin == $data->idadmin)
                                    @foreach ($users as $user)
                                    @if ($admin->idnd == $user->idnd)
                                    <option value="{{$admin->idadmin}}">{{$user ->tennd}}</option>
                                    @endif
                                    @endforeach
                                    @endif
                                    @endforeach
                                    @foreach ($drivers as $driver)
                                        @foreach ($users as $user)
                                            @if ($user->idnd == $driver->idnd && $driver->idadmin != $data->idadmin)
                                            <option value="{{$driver->idadmin}}">{{$user ->tennd}}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>
                                @error('idadmin')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success " style="float: right; font-size: 20px;">Cập nhật</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('admin.layout.script')

</body>

</html>