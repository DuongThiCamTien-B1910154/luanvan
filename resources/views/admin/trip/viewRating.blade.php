<!DOCTYPE html>
<html lang="en">
@include('admin.layout.header')

<style>
    span i {
        font-size: 30px;
        color: gray;
    }

    span span {
        font-size: 20px;
    }

    .rating_active {
        color: yellow;
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
        <div class="main-panel bt-5">
            <!-- content-wrapper -->
            <div class="container-fluid row ">

                <div class="col-2"></div>
                <div class="card col-8 mt-3">
                    <div class="">
                        <h2 class="text-uppercase font-weight-bold p-4" style="color:palevioletred">
                            <a href="{{asset('admin/trip')}}"><i class="fa-solid fa-left-long"></i></a>
                            <span style="margin-left: 100px; color: red;">Đánh giá của khách hàng</span>
                        </h2>

                    </div>
                    <span style="display: flex;
                            justify-content: center;
                            align-items: center;
                            ">
                        @for($i = 1; $i<=5; $i++) <i class="fa fa-star {{$i <= $total_rating ? 'rating_active':''}}" data-key="{{$i}}"></i>
                            @endfor
                            <span> &nbsp;{{$total_rating}}</span>
                    </span>
                    <hr>
                    @foreach($datas as $key => $data)
                    <table >
                        <tr >
                            <td style="width:150px;">Ngày chạy:</td>
                            <td>{{$data->ngaychay}}</td>
                        </tr>

                        <tr>
                            <td>Đánh giá:</td>
                            <td>@for($i = 1; $i<=5; $i++) <i class="fa fa-star {{$i <= $data->rating ? 'rating_active':''}}" data-key="{{$i}}"></i>
                                    @endfor</td>
                        </tr>
                        <tr>
                            <td>Nội dung bình luận:</td>
                            <td>{{$data->noidungbl}}</td>
                        </tr>
                        <tr>
                            <td> Thông tin vé:</td>
                            <td><a href="{{asset('admin/ticket/detailTicket')}}/{{$data->iddc}}"><b>Chi tiết</b></a></td>
                        </tr>
                    </table>
                    <hr>
                    @endforeach
                </div>

            </div>

        </div>
    </div>
    </div>
    @include('admin.layout.script')

</body>

</html>