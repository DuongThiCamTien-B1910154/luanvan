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
                    <a href="{{asset('admin/route/addRoute')}}" class="nav-link text-light "><i class="fa-solid fa-plus"></i> Thêm tuyến đường</a>

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
            <table id="contacts" class="table bg-white table-bordered mt-2 w-100">
                @csrf
                <caption class="my-caption">

                    <h2 class="col-12 text-uppercase  p-3 text-black border bg-white text-center" style=" font-family: Cursive;"><b>Danh mục tuyến đường</b></h2>
                </caption>

                <thead class="text-uppercase">
                    <tr style="background-color:DodgerBlue; color: #fff;">
                        <th>STT</th>
                        <th>Tên tuyến </th>
                        <th>Khởi hành</th>
                        <th>Điểm đến</th>
                        <th>TG dự kiến</th>
                        <th>Tần suất</th>
                        <th>Giá vé</th>
                        <th style="width: 100px;">Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $key => $data)
                    </tr>
                    <td>{{$key+1}}</td>
                    <td>{{$data->tentuyen}}</td>
                    @foreach ($province as $pro)
                    @if($pro->idtp == $data->diemKH)
                    <td>{{$pro->name_city}}</td>
                    @endif
                    @endforeach
                    @foreach ($province as $pro)
                    @if($pro->idtp == $data->diemKT)
                    <td>{{$pro->name_city}}</td>
                    @endif
                    @endforeach
                    <td>{{$data->tg_dukien}}</td>
                    <td>{{$data->tansuat}} chuyến/ngày</td>
                    <td>{{$data->giave}}</td>

                    <form action="" method="post">
                        <td class="text-primary btn">
                            <a href="{{asset('admin/route/editRoute')}}/{{$data->idtuyen}}"><i class="fa-solid fa-pen-to-square"></i></a>

                        </td>
                        <td class="text-danger btn">
                            @csrf
                            @method('delete')
                            <a href="{{asset('admin/route/deleteRoute')}}/{{$data->idtuyen}}" class="text-danger" onclick="return confirm('Bạn có chắc muốn xóa không?')">
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