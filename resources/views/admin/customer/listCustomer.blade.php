<!DOCTYPE html>
<html lang="en">
@include('admin.layout.header')


<style>
    .my-caption {
        caption-side: top;

        font-weight: bold;
        text-transform: uppercase;
        text-align: center;

    }
</style>

<body>

    <!-- partial:partials/_navbar.html -->
    @include('admin.layout.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.layout.sidebar')

        <!-- partial -->
        <div class="main-panel mt-3 " style="margin-left: 20px; margin-right: 20px;">

            <!-- content-wrapper -->

            <div class="d-flex justify-content-between">
                <form class="d-flex align-items-center h-100 " action="">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control border-1 border-dark " placeholder="Tìm kiếm..." style="font-size: 15px;" name="search" value="{{$search}}">
                        <div class="input-group-prepend bg-transparent">
                            <i class="input-group-text border-1 btn border-primary mdi mdi-magnify bg-primary" style="font-size: 20px; color: #fff;"></i>
                        </div>
                    </div>
                </form>
                <!-- <div class="btn btn-primary " style="font-size: 15px;">
                    <a href="{{asset('admin/user/addUser')}}" class="nav-link text-light "><i class="fa-solid fa-plus"></i> Thêm nhân viên</a>

                </div> -->
            </div>
            @if (Session::has('success'))
            <script>
                swal("Thành công!", "{!!session('success')!!}", "success", {
                    button: "ok",
                })
            </script>
            @endif
            <!-- @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif -->
            <table id="contacts" class="table table-bordered bg-white mt-2 w-100">
                @csrf
                <caption class="my-caption">

                    <h2 class="col-12 text-uppercase  p-3 text-black border bg-white text-center" style=" font-family: Cursive;"><b>Danh mục hành khách</b></h2>
                </caption>
                <thead class="text-uppercase text-center">
                    <tr style="background-color:DodgerBlue; color: #fff;">
                        <th>STT</th>
                        <th>Tên </th>
                        <th>Giới tính</th>
                        <th>Điện thoại</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Trạng thái</th>
                        <th>Tuỳ chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $key => $data)<?php
                                                        $check = 0;
                                                        ?>
                    </tr>
                    <td>{{$key+1}}</td>
                    <td>{{$data->tennd}}</td>
                    @if ($data->gtinh == 1)
                    <td>Nam</td>
                    @else
                    <td>Nữ</td>
                    @endif
                    <td>{{$data->sdt}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->diachi}}</td>

                    <form action="" method="post">

                        @foreach ($IsExits as $key => $IsExit)
                        @if($IsExit->idkh == $data->idkh)
                        <td>
                            <div class="text-danger text-center w-100">Đã khóa</div>
                        </td>
                        <?php $check++ ?>
                        @endif
                        @endforeach
                        @if ($check == 0)
                        <td>
                            <div href="#" class="text-success text-center w-100">Hoạt động</div>
                        </td>

                        <!-- <td class="text-danger btn justify-content-center ">
                            @csrf
                            @method('delete')
                            <a href="{{asset('admin/customer/delete')}}/{{$data->idkh}}" class="text-danger" onclick="return confirm('Tài khoản này sẽ bị vô hiệu hóa ?')">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        </td> -->
                        @endif
                        <!-- <td>
                            <a href="#" class="btn btn-primary w-100">Kích hoạt</a>
                        </td> -->
                        @foreach ($IsExits as $key => $IsExit)
                        @if($IsExit->idkh == $data->idkh)
                        <td>
                            <a href="{{asset('admin/customer/active')}}/{{$data->idkh}}" onclick="return confirm('Tài khoản này sẽ được kích hoạt lại ?')" class="btn btn-success w-100">Kích hoạt</a>
                        </td>
                        <?php $check++ ?>
                        @endif
                        @endforeach
                        @if ($check == 0)
                        <td>
                            <a href="{{asset('admin/customer/delete')}}/{{$data->idkh}}" onclick="return confirm('Tài khoản này sẽ bị vô hiệu hóa ?')" class="btn btn-danger w-100">Vô hiệu hóa</a>
                        </td>

                        <!-- <td class="text-danger btn justify-content-center ">
                            @csrf
                            @method('delete')
                            <a href="{{asset('admin/customer/delete')}}/{{$data->idkh}}" class="text-danger" onclick="return confirm('Tài khoản này sẽ bị vô hiệu hóa ?')">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        </td> -->
                        @endif
                    </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <!-- @include('admin.layout.footer') -->

            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.layout.script')

    <!-- End custom js for this page -->
</body>

</html>