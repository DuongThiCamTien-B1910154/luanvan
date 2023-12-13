<!DOCTYPE html>
<html lang="en">
@include('admin.layout.header')

<body>

    @include('admin.layout.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper ">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.layout.sidebar')

        <!-- partial -->
        <div class="main-panel ">
            <div class="content-wrapper">
                <!-- 
                <caption class="my-caption mb-2">
                    <h2 class="col-12 text-uppercase  p-2 text-black border bg-white text-center"><b>Thống kê Doanh Thu </b></h2>
                </caption> -->
                <div class="row">
                    <div class="col-md-4 stretch-card ">
                        <div class="card bg-gradient-danger card-img-holder text-white shadow">
                            <a href="{{asset('admin/ticket/show/1')}}" class="nav-link text-white">
                                <div class="card-body">
                                    <img src="{{asset('/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">Chờ duyệt <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                                    </h4>
                                    <h2 class="mb-5">{{$wait}}</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card ">
                        <div class="card bg-gradient-info card-img-holder text-white  shadow">
                            <a href="{{asset('admin/ticket/show/2')}}" class="nav-link text-white">
                                <div class="card-body">
                                    <img src="{{asset('/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">Đã duyệt <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                                    </h4>
                                    <h2 class="mb-5">{{$approve}}</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card ">
                        <div class="card bg-gradient-success card-img-holder text-white shadow">
                            <a href="{{asset('admin/ticket/show/3')}}" class="nav-link text-white">
                                <div class="card-body">
                                    <img src="{{asset('/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">Hoàn thành <i class="mdi mdi-diamond mdi-24px float-right"></i>
                                    </h4>
                                    <h2 class="mb-5">{{$success}}</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- <caption class="my-caption">
                    <h3 class="col-12  p-3 mb-3 border bg-white">
                        <label for="idtuyen">Thống kê theo:</label>
                        <select name="statistic" id="statistic" class="statistic">
                            <option value="">--- Chọn ---</option>
                            <option value="1" id="a">Doanh thu vé xe</option>
                            <option value="2" id="b">Doanh thu tuyến đường</option>
                            <option value="3" id="c">Doanh thu quý</option>
                        </select>
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <div class="form-group">
                            <label for="pwd">Năm:</label>
                            <input type="text" class="form-control yearSta" id="yearSta" name="statistic">
                        </div>
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>

                        <button class="btn btn-primary sortSta">LỌC </button>
                    </h3>
                </caption> -->
                <div class="row" style="margin-left: 4px; margin-right: 4px;">
                    <div class="bg-white" >
                        <table style="margin-left: 20px;">
                            <tr>
                                <td>
                                    <h3 for="idtuyen" class="text-black "> Doanh thu xe: &nbsp;&nbsp;&nbsp;&nbsp;</h3>
                                </td>
                                <td>
                                    <form action="#" class="row  text-black mt-3">
                                        @csrf
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <!-- <label for="input_from"><b>Từ Ngày:</b> </label> -->
                                                <input type="text" class="form-control input_froms" id="input_from" name="input_froms" value="{{now()->subYear()->format('Y-m-d')}}">
                                            </div>
                                        </div>
                                        <span class="col-md-1 mt-3">Đến</span>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <!-- <label for="input_to"><b>Đến Ngày: </b></label> -->
                                                <input type="text" class="form-control input_tos" id="input_to" name="input_tos" placeholder="End Date" value="{{ now()->format('Y-m-d')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-success sortSta" style="  font-size: 15px;">LỌC</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        </table>
                        <div id="myfirstchart" class="bg-white" style="height: 250px; width: 1150px;"></div>
                        <div class="mb-3 profit">
                            <div>Doanh thu xe cao nhất:</div>
                            <div>Doanh thu xe thấp nhất:</div>
                            <!-- <div>Doanh thu tuyến đường cao nhất:</div>
                            <div>Doanh thu tuyến đường thấp nhất:</div> -->
                        </div>
                    </div>
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