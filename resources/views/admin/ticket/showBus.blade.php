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


            <div class="container-fluid row mt-2 " style="">
                <div class="row bg-white">
                    <!-- day la noi dung -->

                    <h2 class="col-12 text-uppercase  p-3 mt-2 text-black text-center" style="background-color: #48f0df; font-family: Cursive;">
                        <a href="{{asset('admin/ticket/addTicket')}}" style="float: left;"><i class="fa-solid fa-left-long text-dark"></i></a>

                        <b>Đặt vé</b>
                    </h2>



                    <hr class="w-100 mt-4">
                    @if (session('error'))
                    <div class=" alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="container-fluid row ml-3 mt-4 mb-4">
                        <div class="col-5">
                            <div class="">
                                <div class=" text-uppercase " style="margin-left: 30%;"><b>Sơ đồ ghế</b> </div>
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

                                    <div class="col-7 mb-2">
                                        <span class="seat1">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                        Đã đặt
                                    </div>

                                    <div class=""><span class="seat0">&nbsp;&nbsp;&nbsp;&nbsp;</span> Trống</div>
                                </div>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="">
                                <span class="text-uppercase font-weight-bold text-danger ml-5" style="font-size: 30px;"> Thông tin chuyến đi</span>
                            </div>

                            <div class="card-body border ">
                                <form action="" enctype="multipart/form-data" method="POST" id="form-id" class="mb-5">
                                    @csrf
                                    <table>
                                        <tr>
                                            <td><label for="tennd2">Họ tên: </label></td>
                                            <td>
                                                <input type="text" id="" name="tennd2" value="" placeholder="Họ tên">
                                                @error('tennd2')
                                                <div style="color: red;" class="mb-2">{{ $message }}</div>

                                                @enderror
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><label for="sdt2">SĐT:</label></td>
                                            <td>

                                                <input type="text" id="sdt2" name="sdt2" value="" placeholder="Số điện thoại">
                                                @error('sdt2')
                                                <div style="color: red;" class="mb-2">{{ $message }}</div>

                                                @enderror

                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="giave">Giá vé:</label></td>
                                            <td>
                                                <input type="text" id="giave" name="giave" readonly value="{{$route->giave}}">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><label for="id_c_ng_g_x">Xe:</label></td>
                                            <td><select name="id_c_ng_g_x" id="bus" class="bus">
                                                    <option value="">--- Chọn ---</option>
                                                    @foreach ($buss as $bus)
                                                    <option value="{{$bus->id_c_ng_g_x}}">{{$bus->bienso}} - {{$bus->tenloai}}</option>
                                                    @endforeach
                                                </select>
                                                @error('id_c_ng_g_x')
                                                <div style="color: red;" class="mb-2">{{ $message }}</div>

                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="maghe">Chỗ ngồi: </label></td>
                                            <td>
                                                <input type="text" id="maghe" name="maghe" value="" placeholder="Ví dụ: A1">
                                                @error('maghe')
                                                <div style="color: red;" class="mb-2">{{ $message }}</div>

                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="note">Ghi chú: </label></td>
                                            <td>
                                                <textarea id="note" name="note" placeholder="(Nếu có)"></textarea>

                                            </td>
                                        </tr>
                                    </table>
                                    <button type="button" class="btn btn-primary float-right" onclick="document.getElementById('form-id').submit();">Đặt vé</button>
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

                    </div>

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