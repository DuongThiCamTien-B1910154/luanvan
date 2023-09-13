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
                    <a href="{{asset('admin/trip/addTrip')}}" class="nav-link text-light "><i class="fa-solid fa-plus"></i> Thêm chuyến xe</a>

                </div>
            </div>


            @if (session('success'))
            <div class="alert alert-success">

                {{ session('success') }}
            </div>
            @endif
            <table id="contacts" class="bg-white table table-bordered mt-2 w-100">
                @csrf
                <caption class="my-caption">

                    <h2 class="col-12 text-uppercase  p-3 text-black border bg-white text-center" style=" font-family: Cursive;"><b>Danh mục chuyến xe</b></h2>
                </caption>
                <thead class="text-uppercase">
                    <tr style="background-color:DodgerBlue; color: #fff;">
                        <th>STT</th>
                        <th>Chạy chuyến </th>
                        <th>Xe chạy</th>
                        <th>Loại xe</th>
                        <th>Giờ xuất bến</th>

                        <th>Ngày chạy</th>
                        <th>Tài xế</th>
                        <th style="width: 100px;">Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $key => $data)
                    <tr>
                        <td>{{$key+1}}</td>

                        <td>{{$data->tentuyen}}</td>


                        <td>{{$data->bienso}}</td>
                        <td>{{$data->tenloai}}</td>

                        <td>{{$data->tg_xuatben}}</td>
                        <td>{{$data->ngaychay}}</td>
                        @foreach ($users as $user)
                        @if($user->idnd == $data->idnd)
                        <td>{{$user->tennd}}</td>
                        @endif
                        @endforeach
                        <form action="" method="post">
                            <td class="text-primary btn">
                                <a href="{{asset('admin/trip/editTrip')}}/{{$data->idchuyen}}"><i class="fa-solid fa-pen-to-square"></i></a>

                            </td>
                            <td class="text-danger btn">
                                @csrf
                                @method('delete')
                                <a href="{{asset('admin/trip/deleteTrip')}}/{{$data->idchuyen}}" class="text-danger" onclick="return confirm('Bạn có chắc muốn xóa không?')">
                                    <i class="fa-solid fa-trash"></i>
                                </a>

                            </td>

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