<!DOCTYPE html>
<html lang="en">

@include('client.layout.header')

<style>
    body {
        background-color: white;
    }

    .card {
        padding: 1.5rem;
        background: #fff;
        border-radius: .5rem;
        border: .1rem solid rgba(0, 0, 0, .2);
        box-shadow: var(--box-shadow);
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .fa-heart,
    .fa-eye {
        position: absolute;
        top: 1.5rem;
        background: #eee;
        border-radius: 50%;
        height: 5rem;
        width: 5rem;
        line-height: 5rem;
        font-size: 2rem;
        color: var(--black);
    }

    .fa-heart {
        position: absolute;
        top: 2.5rem;
        right: 2.5rem;
        height: 5rem;
        width: 5rem;
        line-height: 5rem;
        text-align: center;
        font-size: 2rem;
        background: #fff;
        border-radius: 50%;
        color: var(--black);
    }

    .fa-heart:hover {
        background-color: var(--green);
        color: #fff;
    }

    .fa-heart {
        right: -15rem;
    }

    .fa-eye {
        left: -15rem;
    }

    .box:hover .fa-heart {
        right: 1.5rem;
    }

    .box:hover .fa-eye {
        left: 1.5rem;
    }

    .rating_active {
        color: yellow;
    }
</style>

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

                <h2 class="col-12 text-uppercase bg-white p-3 mt-2 text-yellow text-center"><b>Các tuyến đường phổ biến</b></h2>
                @foreach ($routes as $key => $route)
                @if($key < 9) <div class="col-4 mt-3">
                    <div class="card">

                        <a href="{{asset('client/schedule/timeSchedule')}}/{{$route->idtuyen}}" class="">

                            <img src="{{asset('uploads/'.$route->file_upload)}}" height="200px" width="100%" />
                        </a>
                        <div class=" card-body ">
                            <div class="stars text-center">
                                @for($i = 1; $i<=5; $i++) <i class="fa fa-star  {{$i <= $route->rating ? 'rating_active':''}}" data-key="{{$i}}"></i>
                                    @endfor
                            </div>
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
    <hr>
    <!-- <div class="toastt">
        <div class="" data-autohide="false">
            <div class="toast-body">

                <div class="spinner-grow text-danger border-2"><i class="fa-solid fa-phone"></i></div>

                <strong class="mr-auto text-danger  text-capitalize">tư vấn trực tiếp</strong>

                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button> 

            </div>
        </div>
    </div>
    <hr>
 -->

    <!-- noi dung -->
    @include('client.layout.footer')
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
    </div>




</body>

</html>