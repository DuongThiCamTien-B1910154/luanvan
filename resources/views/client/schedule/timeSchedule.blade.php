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
            <div class="col-10 row ">

                <!-- day la noi dung -->
                <h2 class="col-12 text-uppercase  p-3 mt-2 text-black text-center" style="background-color: #48f0df; font-family: Cursive;">
                <a href="{{asset('client/schedule')}}" style="float: left;"><i class="fa-solid fa-left-long text-dark"></i></a>
                <b>Tuyến xe</b>
            </h2>

                <h4>
                    @foreach ($province as $pro)
                    @if($pro->idtp == $routes->diemKH)
                    <h4 class="mt-3 text-info "><i class="fa-solid fa-bus"></i> <b><u>{{$pro->name_city}}</u> </b> </h4>
                    @endif
                    @endforeach
                </h4>
                <table id="contacts" class="table table-bordered table-striped  w-100">
                    @csrf
                    <thead>
                        <tr style="background-color:DodgerBlue; color: #fff;">
                            <th>STT</th>
                            <th>Chạy chuyến </th>
                            <th>Xe chạy</th>
                            <th>Loại xe</th>
                            <th>Giờ chạy</th>
                            <th>Ngày chạy</th>
                            <th>Tài xế</th>
                            <th style="width: 120px;">Đặt vé</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trips as $key => $trip)
                        <tr>
                            <td>{{$key+1}}</td>
                            @if($routes->idtuyen == $trip->idtuyen)
                            <td>{{$routes->tentuyen}}</td>
                            @endif
                            @foreach ($buss as $bus)
                            @if($bus->idxe == $trip->idxe)
                            <td>{{$bus->bienso}}</td>
                            @endif
                            @endforeach
                            @foreach ($buss as $bus)
                            @if($bus->idxe == $trip->idxe)
                            @foreach ($typeBus as $type)
                            @if($type->idlx == $bus->idlx)
                            <td>{{$type->tenloai}}</td>
                            @endif
                            @endforeach
                            @endif
                            @endforeach
                            <td>{{$trip->tg_xuatben}}</td>
                            <td>{{$trip->ngaychay}}</td>
                            @foreach ($admins as $user)
                            @if($user->idadmin == $trip->idadmin)
                            <td>{{$user->tennd}}</td>
                            @endif
                            @endforeach
                            <form action="" method="GET" enctype=" multipart/form-data" >
                                @csrf
                                <td>
                                    <button type="button" class=" btn btn-warning">
                                        <a href=" {{asset('client/ticket/findBus')}}/{{$trip->idtuyen}}/{{$trip->idgio}}/{{$trip->idngay}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </button>
                                </td>
                            </form>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
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