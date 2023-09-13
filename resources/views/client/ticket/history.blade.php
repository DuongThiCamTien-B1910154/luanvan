<?php
$stt = 1;
?>
<!DOCTYPE html>
<html lang="en">

@include('client.layout.header')


<body class="preloading">

    @include('client.layout.nav')
    <div class="main">


        <hr>
        <div class="text-center row ">
            <div class="col-3"></div>
            <nav class="col-6 deliver position-fixed " id="demo2">
                <a href="{{asset('client/history/'.'0')}}" class="btn btn-warning  text-white {{(request()->is('client/history/0')) ? 'active' : '' }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Chờ duyệt</a>
                <a href="{{asset('client/history/'.'1')}}" class="btn btn-warning  text-white {{(request()->is('client/history/1')) ? 'active' : '' }}"><i class="fa fa-car" aria-hidden="true"></i>&nbsp;&nbsp;Đã duyệt</a>
                <a href="{{asset('client/history/'.'2')}}" class="btn btn-warning  text-white {{(request()->is('client/history/2')) ? 'active' : '' }}"><i class="fa-solid fa-thumbs-up"></i>&nbsp;&nbsp;Hoàn thành</a>
                <a href="{{asset('client/history/'.'-1')}}" class="btn btn-warning text-white  {{(request()->is('client/history/-1')) ? 'active' : '' }}"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Đã hủy</a>
            </nav>
            <div class="col-3"></div>
        </div>
        <div class="container-fluid row mt-3">
            <div class="col-3"></div>
            <div class="pl-3"></div>
            <div class="col-6 row bg-white">
                <!-- day la noi dung -->
                @foreach ($seats as $seat)
                @if($seat->idkh == auth('client')->user()->idkh)
                <div class="col-md-12 ">
                    <hr>
                    <h4 class=" text-uppercase " style="margin-bottom: 20px; float: right;">Ngày Đặt: {{$seat->created_at}} </h4>
                    <h4 class="text-uppercase " style="margin-bottom: 20px;">Số thứ tự: {{$stt++}}</h4>
                </div>

                <div class="col-2"></div>
                <div class="col-8">
                    <div class="">
                        <span class="text-uppercase font-weight-bold text-danger ml-5" style="font-size: 30px;"> Thông tin chuyến đi</span>
                    </div>
                    <div class=" card-body border mb-3 ">
                        <form action="{{asset('client/ticket/booking')}}" enctype="multipart/form-data" method="POST" id="form-id" class="">
                            @csrf
                            <table>
                                <tr>
                                    <td><label for="tennd">Họ tên: </label></td>
                                    <td>

                                        <input type="text" id="bienso" readonly name="tennd2" value="{{$seat->tennd2}}" placeholder="Họ tên">

                                    </td>
                                </tr>
                                <input type="text" id="idkh" name="idkh" hidden value="{{auth('client')->user()->idkh}}" placeholder="Email">

                                <tr>
                                    <td><label for="sdt2">SĐT:</label></td>
                                    <td>
                                        <input type="text" id="sdt2" name="sdt2" readonly value="{{$seat->sdt2}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="sdt2">Tuyến:</label></td>
                                    <td>
                                        <input type="text" id="sdt2" name="sdt2" readonly value="{{$seat->tentuyen}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="sdt2">Ngày chạy:</label></td>
                                    <td>
                                        <input type="text" id="sdt2" name="sdt2" readonly value="{{$seat->ngaychay}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="sdt2">Giờ chạy:</label></td>
                                    <td>
                                        <input type="text" id="sdt2" name="sdt2" readonly value="{{$seat->tg_xuatben}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="gia">Giá vé:</label></td>
                                    <td>
                                        <input type="text" id="gia" name="gia" readonly value="{{$seat->giave}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="PTTT">PT thanh toán:</label></td>
                                    <td>
                                        @if($seat->PTTT == 0)
                                        <input type="text" id="gia" name="gia" readonly value="Thanh toán khi nhận vé">
                                        @else
                                        <input type="text" id="gia" name="gia" readonly value="Thanh toán với PAYPAL">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="id_c_ng_g_x">Xe:</label></td>
                                    <td> <input type="text" id="gia" name="gia" readonly value="{{$seat->bienso}} - {{$seat->tenloai}}">

                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="maghe">Chỗ ngồi: </label></td>
                                    <td>
                                        <input type="text" id="maghe" name="maghe" readonly value="{{$seat->maghe}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="note">Ghi chú: </label></td>
                                    <td>
                                        <textarea id="note" name="note" class="w-100" readonly value="">{{$seat->note}}</textarea>
                                    </td>
                                </tr>
                            </table>
                            @method('delete')
                            @if ($seat->TTV == 0)
                            <td class="text-danger btn " style="height: 70px;">
                                <a href="{{asset('client/history/deleteSeat')}}/{{$seat->idghe}}" class="btn btn-primary" style="margin-left: 40%;" onclick="return confirm('Bạn có chắc muốn hủy vé không?')">
                                    Hủy vé
                                </a>
                            </td>
                            @elseif ( $seat->TTV == 2)
                            <td class=" btn " style="height: 70px;">
                                <a href="{{asset('client/history/deleteTicket')}}/{{$seat->idghe}}" class="btn btn-danger" style="margin-left: 35%;" onclick="return confirm('Bạn có chắc muốn xóa không?')">
                                    Xóa
                                </a>
                                <a href="{{asset('client/history/deleteTicket123456')}}/{{$seat->idghe}}" class="btn btn-primary">
                                    Nhận xét
                                </a>
                            </td>
                            <td class="text-danger btn " style="height: 70px;">

                            </td>
                            @elseif ($seat->TTV == -1  )
                            <td class=" btn " style="height: 70px;">
                                <a href="{{asset('client/history/deleteTicket')}}/{{$seat->idghe}}" class="btn btn-danger" style="margin-left: 40%;" onclick="return confirm('Bạn có chắc muốn xóa không?')">
                                    Xóa
                                </a>
                            </td>
                            <td class="text-danger btn " style="height: 70px;">
                               
                            </td>
                            @endif

                        </form>
                    </div>
                </div>
                @endif
                @endforeach



                <div class="col-2"></div>
                <!-- het noi dung -->
            </div>
            <div class="col-3"></div>

        </div>
        <br>
        <!-- noi dung -->
        @include('client.layout.footer')
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script src="js/script.js"></script>
    </div>

</body>

</html>