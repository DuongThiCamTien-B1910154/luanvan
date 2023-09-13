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
                            <a href="{{asset('admin/route')}}"><i class="fa-solid fa-left-long"></i></a>
                            <span style="margin-left: 90px; color: red;">Thêm tuyến đường</span>
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
                            <input type="hidden" name="tentuyen">
                            <div class="form-group">
                                <label for="diemKH">Điểm khởi hành: </label>
                                <select name="diemKH" id="">
                                    <option value="">--- Chọn ---</option>
                                    @foreach ($province as $pro)
                                    <option value="{{$pro->idtp}}">{{$pro->name_city}}</option>
                                    @endforeach
                                </select>

                                @error('diemKH')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="diemKT">Điểm kết thúc: &nbsp;&nbsp; </label>
                                <select name="diemKT" id="">
                                    <option value="">--- Chọn ---</option>
                                    @foreach ($province as $pro)
                                    <option value="{{$pro->idtp}}">{{$pro->name_city}}</option>
                                    @endforeach
                                </select>
                                @error('diemKT')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tg_dukien">Thời gian dư kiến</label>
                                <input type="text" class="form-control" id="tg_dukien" name="tg_dukien" placeholder="3h20">
                                @error('tg_dukien')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tansuat">Tần suất:</label>
                                <input type="text" class="form-control" id="tansuat" name="tansuat" placeholder="chuyến/ngày">
                                @error('tansuat')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="giave">Giá vé:</label>
                                <input type="text" class="form-control" id="giave" name="giave" placeholder="ví dụ: 100000">
                                @error('giave')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success " style="float: right; font-size: 20px;">Thêm</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('admin.layout.script')

</body>

</html>