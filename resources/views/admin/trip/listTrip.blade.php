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
                <span class="d-flex align-items-center h-100 ">
                    <div class="input-group">
                        <input type="text" class="form-control border-1 border-dark searchTripValue" placeholder="Tìm kiếm..." style="font-size: 15px;" name="searchTrip" value="{{ $_COOKIE['searchTrip'] ?? ''}}">
                        <div class="input-group-prepend bg-transparent searchTrip">
                            <i class="input-group-text border-1 btn border-primary mdi mdi-magnify bg-primary" style="font-size: 20px; color: #fff;"></i>
                        </div>
                    </div>
                </span>
                <!-- <div class="btn btn-primary " style="font-size: 15px; ">
                    <a href="{{asset('admin/trip/addTripAuto')}}" class="nav-link text-light " onclick="return confirm('Toàn bộ chuyễn đã đăng ký trước đó sẽ được thêm cho 1 tuần tới.')"><i class="fa-solid fa-plus"></i> Thêm chuyến tự động</a>
                </div> -->
                <div class="btn btn-primary " style="font-size: 15px; ">
                    <a href="{{asset('admin/trip/addTrip')}}" class="nav-link text-light "><i class="fa-solid fa-plus"></i> Thêm chuyến </a>
                </div>
            </div>
            <div class="m-3">
                <form action="#" class="row  pt-3 text-black border bg-white">
                    @csrf
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="input_from"><b>Từ Ngày:</b> </label>
                            <input type="text" class="form-control input_from" id="input_from" name="input_from" value="{{$_COOKIE['input_from'] ?? now()->format('Y-m-d')}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="input_to"><b>Đến Ngày: </b></label>
                            <input type="text" class="form-control input_to" id="input_to" name="input_to" placeholder="End Date" value="{{$_COOKIE['input_to'] ?? now()->format('Y-m-d')}}">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <button type="button" class="btn btn-success mt-4 filter" style="  font-size: 15px;">LỌC</button>
                        </div>
                    </div>

                </form>
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
            <table id="contacts" class="bg-white table table-bordered  w-100">
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
                        <th>Đánh giá</th>

                        <th>Tài xế</th>
                        <th style="width: 100px;">Tùy chọn</th>
                    </tr>
                </thead>
                <tbody class="filterTrip">


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