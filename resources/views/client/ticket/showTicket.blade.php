<!DOCTYPE html>
<html lang="en">

@include('client.layout.header')

<style lang="">
    .seat {
        background-color: #b6b6c7;
        height: 50px;
        width: 53px;
        margin: 5px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        /* size: 10px; */
        text-align: center;
        padding-top: 10px;
    }

    .row {
        /* width: 300px; */
        display: flex;
    }

    .entrance {
        margin-left: 43px;
    }

    .floor1 {
        margin-left: 40px;
    }

    .floor2 {
        margin-left: 122px;
    }
</style>
<!-- <script>
    var msg = '{{Session::get("alert")}}';
    var exist = '{{Session::has("alert")}}';
    if (exist) {
        alert(msg);
    }
</script> -->

<body class="preloading">

    @include('client.layout.nav')
    <div class="main">

        <br>
        <div class="container-fluid row">
            <div class="col-1"></div>
            <div class="pl-3"></div>
            <div class="col-10 row bg-white">

                <!-- day la noi dung -->
                <h2 class="col-12 text-uppercase  p-3 mt-2 text-black text-center" style="background-color: #48f0df; font-family: Cursive;"><b>Đặt vé</b></h2>
                <div class="w-100 mt-4"><u><i>Vui lòng chọn các thông tin phía dưới để tìm xe phù hợp cho chuyến đi!</i></u></div>
                <hr class="w-100 mt-4">
                @if (session('error'))
                <div class=" alert alert-danger w-100">
                    {{ session('error') }}
                </div>
                @endif
                <form action="{{asset('client/ticket/findBus')}}" enctype="multipart/form-data" class="container-fluid row mt-3" method="" id="form-id">
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
                    <button type="button" class="btn btn-primary " onclick="document.getElementById('form-id').submit();">Tìm xe</button>
                </form>


                <!-- het noi dung -->
            </div>
            <div class="col-1"></div>

        </div>
        <br>
        <!-- noi dung -->
        @include('client.layout.footer')
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script src="js/script.js"></script>
        @include('client.layout.script')

    </div>

</body>

</html>