<?php
$tennd = null;
$sdt = null;
foreach ($users as $key => $user) {
    if (auth('client')->user()) {
        if ($user->idnd == auth('client')->user()->idnd) {
            $tennd = $user->tennd;
            $sdt = $user->sdt;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

@include('client.layout.header')

<style lang="">
    /* .seat {
        background-color: #b6b6c7;
        height: 50px;
        width: 53px;
        margin: 5px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        text-align: center;
        padding-top: 10px;
    } */

    .row {
        /* width: 300px; */
        display: flex;
    }

    .entrance {
        margin-left: 30px;
    }

    .floor1 {
        margin-left: 40px;
    }

    .floor2 {
        margin-left: 122px;
    }

    .tx {
        border-radius: 20px;
        border: 2px solid black;
        text-align: center;
        background-color: aqua;
        width: 50%;
        height: 5px;
    }

    .seat1 {
        border: 2px solid black;
        text-align: center;
        background-color: red;
        width: 10px;
        height: 3px;
        /* padding: 3px; */
    }

    .seat0 {
        border: 2px solid black;
        text-align: center;
        background-color: light;
        width: 10px;
        height: 3px;
        /* padding: 3px; */
    }

    input[type=checkbox][disabled]:checked {
        outline: 2px solid green;
        accent-color: green !important;
        background-color: #FA9E57 !important;
    }
</style>


<body class="preloading">

    @include('client.layout.nav')
    <div class="main">

        <br>
        <div class="container-fluid row">
            <div class="col-1"></div>
            <div class="pl-3"></div>
            <div class="col-10 row bg-white">

                <!-- day la noi dung -->
                <h2 class="col-12 text-uppercase  p-3 mt-2 text-black text-center" style="background-color: #48f0df; font-family: Cursive;">
                    <a href="{{asset('client/ticket')}}" style="float: left;"><i class="fa-solid fa-left-long text-dark"></i></a>

                    <b>Đặt vé</b>
                </h2>
                <hr class="w-100 mt-4">
                <div class="container-fluid row ml-3 mt-4 mb-4">
                    <div class="col-3">
                        <div class="">
                            <div class="ml-5 text-uppercase"><b>Sơ đồ ghế</b> </div>
                            <div class="container-fluid row mb-2">
                                <div class="col-6 ">
                                    <span class="tx"> &nbsp;&nbsp;tx &nbsp;&nbsp;</span>
                                </div>

                                <div class="col-2 justify-content-end entrance"><i class="fa-solid fa-left-long"></i></div>
                            </div>
                            <div class="container-fluid row seatBus mb-2">
                            </div>

                            <hr>
                            <div class="container-fluid row">

                                <div class="col-7">
                                    <span class="seat1">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    Đã đặt
                                </div>

                                <div class=""><span class="seat0">&nbsp;&nbsp;&nbsp;&nbsp;</span> Trống</div>
                            </div>
                        </div>

                    </div>
                    <div class="col-5">
                        <div class="">
                            <span class="text-uppercase font-weight-bold text-danger ml-5" style="font-size: 30px;"> Thông tin chuyến đi</span>
                        </div>
                        @if (session('error') && session('errorChair'))
                        <div class=" alert alert-danger">
                            {{ session('error') }}
                            <br>
                            {{ session('errorChair') }}
                        </div>
                        @endif


                        <div class=" card-body border ">
                            <form action="{{asset('client/ticket/findBus')}}" enctype="multipart/form-data" method="POST" id="form-id" class="mb-5">
                                @csrf
                                <table>
                                    <tr>
                                        <td class="pt-1"><label for="tennd2">Họ tên: </label></td>
                                        <td>
                                            <input type="text" class="" style="width: 300px;" oninput="Cookies.set('tennd2', this.value)" value="{{$tennd ?? $_COOKIE['tennd2']?? '' }}" id="bienso" name="tennd2" placeholder="Họ tên">
                                            @error('tennd2')
                                            <div style="color: red;" class="mb-2">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pt-1"><label for="sdt2">SĐT:</label></td>
                                        <td>
                                            <input type="text" class="w-100" id="sdt2" oninput="Cookies.set('sdt2', this.value)" value="{{$sdt ?? $_COOKIE['sdt2'] ?? ''}}" name="sdt2" placeholder="Số điện thoại">
                                            @error('sdt2')
                                            <div style="color: red;" class="mb-2">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pt-1"><label for="giave">Tuyến:</label></td>
                                        <td>
                                            <input type="text" class="w-100" id="giave" name="" readonly value="{{$route->tentuyen}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pt-1"><label for="giave">Giờ chạy:</label></td>
                                        <td>
                                            <input type="text" class="w-100" id="giave" name="" readonly value="{{$times->tg_xuatben}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pt-1"><label for="giave">Ngày chạy:</label></td>
                                        <td>
                                            <input type="text" class="w-100" id="giave" name="" readonly value="{{$days->ngaychay}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pt-1"><label for="giave">Giá vé:</label></td>
                                        <td>
                                            <input type="text" class="w-100" id="giave" name="giave" readonly value="{{$route->giave}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="idtt">PTTT:</label></td>
                                        <td>
                                            <select name="idtt" class="p-1 w-100">
                                                @foreach ($pttts as $pttt)
                                                <option value="{{$pttt->idtt}}" {{ old('idtt') == '0' ? 'selected' : '' }}>{{$pttt->tentt}}</option>
                                                @endforeach
                                            </select>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="id_c_ng_g_x">Xe:</label></td>
                                        <td><select name="id_c_ng_g_x" id="bus" class="bus w-100">
                                                <option value="">--- Chọn ---</option>
                                                @foreach ($buss as $bus)
                                                <option value="{{$bus->id_c_ng_g_x}}" {{old('id_c_ng_g_x') == $bus->id_c_ng_g_x ?  'selected':''}}>{{$bus->bienso}} - {{$bus->tenloai}}</option>
                                                @endforeach
                                            </select>
                                            @error('id_c_ng_g_x')
                                            <div style="color: red;" class="mb-2">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 7px;"><label for="maghe">Ghế: </label></td>
                                        <td>
                                            <div class="check_seat">

                                                <!-- <input type="checkbox" name="idghes[]" id="checkbox-2" value="" disabled style="width: 15px;height: 15px;"/><span>A1 &nbsp;&nbsp;&nbsp;</span> 
                                                <input type="checkbox" name="idghes[]" id="checkbox-3" value="" style="width: 15px;height: 15px;"/> <span>A2  &nbsp;&nbsp;&nbsp;</span> 
                                                <input type="checkbox" name="idghes[]" id="checkbox-2" value="" style="width: 15px;height: 15px;"/> <span>A3  &nbsp;&nbsp;&nbsp;</span> 
                                                <input type="checkbox" name="idghes[]" id="checkbox-3" value="" style="width: 15px;height: 15px;"/> <span>A4</span>  -->
                                            </div>

                                            <!-- <input type="text" class="w-100" oninput="Cookies.set('maghe', this.value)" value="{{$_COOKIE['maghe'] ?? ''}}" id="maghe" name="maghe" placeholder="Ví dụ: A1"> -->
                                            @error('idghes')
                                            <div style="color: red;" class="mb-2">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="note">Ghi chú: </label></td>
                                        <td class="pt-1">
                                            <textarea id="note" class="w-100 " name="note" placeholder="(Nếu có)"></textarea>
                                        </td>
                                    </tr>
                                </table>
                                <!-- <button type="submit" class="submitOrderTicket">submitOrderTicket</button> -->
                                <button name="submitOrderTicket" type="button" class="btn btn-primary float-right " style="margin-right: 30px;" onclick="document.getElementById('form-id').submit();">Đặt vé</button>
                            </form>
                            @if (session('success'))
                            <script>
                                swal("Thành công!", "{!!session('success')!!}", "success", {
                                    button: "ok",
                                })
                            </script>
                            @endif
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <h4 class="card-header bg-warning text-center"><b>ĐIỀU KHOẢN SỬ DỤNG</b></h4>
                            <div class="card-body bg-light">
                                <div><b>(*) Quý khách vui xuất trình mã vé (sẽ được gửi đến <u><i>email</i></u> sau khi đặt vé)
                                        cho nhân viên soát vé để hoàn tất thủ tục và khởi hành.</b></div>
                                <div>(*) Thông tin hành khách phải chính xác, nếu không sẽ không thể lên xe hoặc hủy đổi vé.</div>
                                <div>(*) Quý khách không được đổi trả vé vào các ngày Lễ Tết, ngày thường quý khách được quyền chuyển đồi hoặc hủy vé
                                    trước khi xe chạy 24h, phí hủy vé 20%.
                                </div>
                                <div>(*) Nếu quý khách có nhu cầu trung chuyển. Vui lòng liên hệ số điện thoại <b><i><u>0392657984</u></i></b> trước khi đặt vé.
                                    Chúng tôi không thể trung chuyển đến những nơi xe trung chuyển không thể tới.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- het noi dung -->
            </div>
            <div class="col-1"></div>

        </div>
        <br>
        <!-- noi dung -->
        @include('client.layout.footer')
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <!-- <script src="js/script.js"></script> -->
        <!-- @include('client.layout.script') -->

    </div>

</body>

</html>