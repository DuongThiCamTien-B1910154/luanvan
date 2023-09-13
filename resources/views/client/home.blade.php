<!DOCTYPE html>
<html lang="en">

@include('client.layout.header')


<body class="preloading">

    @include('client.layout.nav')
    <div class="main">

        <div class="container-fluid row">
            <div class="col-1"></div>
            <div class="col-10">
                @include('client.layout.slide')
            </div>
            <div class="col-1"></div>
        </div>
        <hr>
        <div class="container-fluid row">
            <div class="col-1"></div>
            <div class="pl-3"></div>
            <div class="col-10 row ">
                <!-- day la noi dung -->

                <h2 class="col-12 text-uppercase card-color p-3 mt-2 text-white"><b><u>Các tuyến đường phổ biến</u></b></h2>
                @foreach ($routes as $key => $route)
                @if($key < 9) <div class="col-4 mt-3">
                    <div class="card">
                        <a href="" class="">
                            <img src="{{asset('uploads/'.$route->file_upload)}}" height="200px" width="100%" />
                        </a>
                        <div class=" card-body">
                            @foreach ($province as $pro)
                            @if($pro->idtp == $route->diemKH)
                            <dt class=""><i class="text-primary fa-solid fa-car"></i> Điểm khởi hành: {{$pro->name_city}}</dt>
                            @endif
                            @endforeach
                            @foreach ($province as $pro)
                            @if($pro->idtp == $route->diemKT)
                            <dt class=" mt-2 mb-2"><i class="text-primary fa-solid fa-circle-check"></i> Điểm đến: {{$pro->name_city}}</dt>
                            @endif
                            @endforeach
                            <dt class=""><a href="#" class="text-primary fa-solid fa-phone"></a> Hotline:+849789457545</dt>

                            <div class="input-group justify-content-center">
                                <div class="input-group-prepend ">
                                    <form action="" method="post">
                                        @csrf
                                        <input type="hidden" name="idsp" value="" min="0" max="100" size="3">
                                        <input type="hidden" name="qty" value="1">


                                    </form>


                                </div>
                            </div>

                        </div>
                        <!-- <div class=" card-body">

                            <dt class=""><i class="text-primary fa-solid fa-car"></i> Điểm khởi hành: BX Gạch Giá</dt>
                            <dt class=" mt-2 mb-2"><i class="text-primary fa-solid fa-circle-check"></i> Điểm đến: Sài Gòn, Cần Thơ, Hà Tiên...</dt>
                            <dt class=""><a href="#" class="text-primary fa-solid fa-phone"></a> Hotline:+849789457545</dt>

                            <div class="input-group justify-content-center">
                                <div class="input-group-prepend ">
                                    <form action="" method="post">
                                        @csrf
                                        <input type="hidden" name="idsp" value="" min="0" max="100" size="3">
                                        <input type="hidden" name="qty" value="1">


                                    </form>


                                </div>
                            </div>

                        </div> -->
                    </div>
            </div>
            @endif
            @endforeach
            <!-- het noi dung -->
        </div>
        <div class="col-1"></div>

    </div>
    <br>
    <div class="toastt">
        <div class="" data-autohide="false">
            <div class="toast-body">

                <div class="spinner-grow text-danger border-2"><i class="fa-solid fa-phone"></i></div>

                <strong class="mr-auto text-danger  text-capitalize">tư vấn trực tiếp</strong>

                <!-- <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button> -->

            </div>
        </div>
    </div>
    <hr>

    <!-- noi dung -->
    @include('client.layout.footer')
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
    </div>



</body>

</html>