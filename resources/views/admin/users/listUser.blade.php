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
                <div class="btn btn-primary " style="font-size: 15px;">
                    <a href="{{asset('admin/user/addUser')}}" class="nav-link text-light "><i class="fa-solid fa-plus"></i> Thêm nhân viên</a>

                </div>
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

                    <h2 class="col-12 text-uppercase  p-3 text-black border bg-white text-center" style=" font-family: Cursive;"><b>Danh mục nhân viên</b></h2>
                </caption>
                <thead class="text-uppercase">
                    <tr style="background-color:DodgerBlue; color: #fff;">
                        <th>STT</th>
                        <th>Mã số</th>
                        <th>Tên </th>
                        <th>Năm sinh</th>
                        <th>Giới tính</th>
                        <th>Chức vụ</th>
                        <th>Điện thoại</th>
                        <th>Email</th>
                        <th ">Địa chỉ</th>
                        <th style=" width: 100px;">Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $key => $data)
                    </tr>
                    <td>{{$key+1}}</td>
                    <td>{{$data->mand}}</td>
                    <td>{{$data->tennd}}</td>
                    <td>{{$data->namsinh}}</td>
                    @if ($data->gtinh == 1)
                    <td>Nam</td>
                    @else
                    <td>Nữ</td>
                    @endif
                    <td>{{$data->tencv}}</td>
                    <td>{{$data->sdt}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->diachi}}</td>

                    <form action="" method="post">
                        <td class="text-primary btn">
                            <a href="{{asset('admin/user/editUser')}}/{{$data->idadmin}}"><i class="fa-solid fa-pen-to-square"></i></a>

                        </td>
                        <td class="text-danger btn">
                            @csrf
                            @method('delete')
                            <a href="{{asset('admin/user/deleteUser')}}/{{$data->idadmin}}" class="text-danger" onclick="return confirm('Bạn có chắc muốn xóa không?')">
                                <i class="fa-solid fa-trash"></i>
                            </a>

                        </td>

                    </form>
                    </tr>
                    @endforeach
                </tbody>


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