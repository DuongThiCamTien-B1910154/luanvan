<!DOCTYPE html>
<html lang="en">

@include('client.layout.header')


<body class="preloading">

    @include('client.layout.nav')
    <div class="main">

        <br>
        <div class="container-fluid row">
            <div class="col-1"></div>
            <div class="pl-3"></div>
            <div class="col-10 row bg-white">

                <!-- day la noi dung -->
                <h2 class="col-12 text-uppercase  p-3 mt-2 text-black text-center" style="background-color: #48f0df; font-family: Cursive;"><b>Tuyến xe</b></h2>
                @foreach ($diemKHs as $key => $diemKH)
                <h4>
                    @foreach ($province as $pro)
                    @if($pro->idtp == $diemKH->diemKH)
                    <h4 class="mt-3 text-info "><i class="fa-solid fa-bus"></i> <b><u>{{$pro->name_city}}</u> </b> </h4>
                    @endif
                    @endforeach
                </h4>
                <table id="contacts" class="table table-bordered table-striped  w-100">
                    @csrf
                    <thead>
                        <tr style="background-color:DodgerBlue; color: #fff;">
                            <th>STT</th>
                            <th>Khởi hành</th>
                            <th>Điểm đến</th>
                            <th>TG dự kiến</th>
                            <th>Tần suất</th>
                            <th>Giá vé</th>
                            <th>Giờ chạy</th>
                            <th style="width: 120px;">Đặt vé</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($routes as $key => $route)
                        @if($route->diemKH == $diemKH->diemKH)
                        <tr>
                            <td>{{$key+1}}</td>
                            @foreach ($province as $pro)
                            @if($pro->idtp == $route->diemKH)
                            <td>{{$pro->name_city}}</td>
                            @endif
                            @endforeach
                            @foreach ($province as $pro)
                            @if($pro->idtp == $route->diemKT)
                            <td>{{$pro->name_city}}</td>
                            @endif
                            @endforeach
                            <td>{{$route->tg_dukien}}</td>
                            <td>{{$route->tansuat}} chuyến/ngày</td>
                            <td>{{$route->giave}}</td>
                            <td>
                                <a href=" {{asset('client/schedule/timeSchedule')}}/{{$route->idtuyen}}">Chi tiết</i></a>
                            </td>

                            <td>
                                <button class=" btn btn-warning">
                                    <a href=" {{asset('client/ticket')}}"><i class="fa-solid fa-pen-to-square"></i></i></a>

                                    <!-- <a href=" {{asset('client/ticket/')}}/{{$route->idtuyen}}"><i class="fa-solid fa-pen-to-square"></i></a> -->

                                    <!-- <a href=" {{asset('client/schedule/timeSchedule')}}/{{$route->idtuyen}}"><i class="fa-solid fa-pen-to-square"></i></a> -->
                                </button>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
                @endforeach
                <!-- het noi dung -->
            </div>
            <div class="col-1"></div>

        </div>
        <br>
        <!-- noi dung -->
        @include('client.layout.footer')
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script src="js/script.js"></script>
    </div>

</body>

</html>