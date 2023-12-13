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
        <div class="main-panel mt-3 " style="margin-left: 40px; margin-right: 20px;">

            <!-- content-wrapper -->


            <div class="container-fluid row mt-2 "  >
                <div class="row bg-white">
                    <!-- day la noi dung -->

                    <h2 class="col-12 text-uppercase  p-3 mt-2 text-black text-center" style="background-color: #48f0df; font-family: Cursive;">
                        <a href="{{asset('admin/ticket/show/1')}}" style="float: left;"><i class="fa-solid fa-left-long text-dark"></i></a>
                        <b>Đặt vé</b>
                    </h2>
                    <div class="w-100 mt-4"><u><i>Vui lòng chọn các thông tin phía dưới để tìm xe phù hợp cho chuyến đi!</i></u></div>
                    <hr class="w-100 mt-4">
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <form action="{{asset('admin/ticket/findBus')}}" enctype="multipart/form-data" class="container-fluid row mt-3" method="" id="form-id">
                        @csrf
                        <div class="form-group col-4">
                            <label for="idtuyen"><span class="text-danger font-weight-bold ">(*1)</span> Chọn tuyến xe:</label>
                            <select name="idtuyen" id="route" class="findRoute">
                                <option value="">--- Chọn ---</option>
                                @foreach ($routes as $route)    
                                <option value="{{$route->idtuyen}}">{{$route->tentuyen}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label for="idgio"><span class="text-danger font-weight-bold">(*2)</span> Chọn giờ chạy:</label><br>
                            <select name="idgio" id="time" class="findRoute">
                                <option value="">--- Chọn ---</option>

                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label for="idngay"><span class="text-danger font-weight-bold">(*3)</span> Chọn ngày chạy</label><br>
                            <select name="idngay" id="day" class="findRoute">
                                <option value="">--- Chọn ---</option>

                            </select>
                        </div>
                        <button type="button" class="btn btn-primary mb-3  " onclick="document.getElementById('form-id').submit();">Tìm xe</button>
                    </form>



                    <!-- het noi dung -->
                </div>

            </div>

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