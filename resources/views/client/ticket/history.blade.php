<?php
$stt = 1;
$maghes = "";
$money = 0;

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
                <a href="{{asset('client/history/'.'1')}}" class="btn btn-warning  text-white {{(request()->is('client/history/1')) ? 'active' : '' }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Chờ duyệt</a>
                <a href="{{asset('client/history/'.'2')}}" class="btn btn-warning  text-white {{(request()->is('client/history/2')) ? 'active' : '' }}"><i class="fa fa-car" aria-hidden="true"></i>&nbsp;&nbsp;Đã duyệt</a>
                <a href="{{asset('client/history/'.'3')}}" class="btn btn-warning  text-white {{(request()->is('client/history/3')) ? 'active' : '' }}"><i class="fa-solid fa-thumbs-up"></i>&nbsp;&nbsp;Hoàn thành</a>
                <a href="{{asset('client/history/'.'0')}}" class="btn btn-warning text-white  {{(request()->is('client/history/0')) ? 'active' : '' }}"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Đã hủy</a>
            </nav>
            <div class="col-3"></div>
        </div>
        <div class="container-fluid row mt-3">
            <div class="col-3"></div>
            <div class="pl-3"></div>
            <div class="col-6 row bg-white">
                <!-- day la noi dung -->
                @foreach ($seats as $seat)
                <?php
                $temp = 0;
                ?>
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

                                        <input type="text" style="width: 300px;" id="bienso" readonly name="tennd2" value="{{$seat->tennd2}}" placeholder="Họ tên">

                                    </td>
                                </tr>
                                <input type="text" id="idkh" name="idkh" class="w-100" hidden value="{{auth('client')->user()->idkh}}" placeholder="Email">

                                <tr>
                                    <td><label for="sdt2">SĐT:</label></td>
                                    <td>
                                        <input type="text" id="sdt2" name="sdt2" class="w-100" readonly value="{{$seat->sdt2}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="sdt2">Tuyến:</label></td>
                                    <td>
                                        <input type="text" id="sdt2" name="sdt2" class="w-100" readonly value="{{$seat->tentuyen}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="sdt2">Ngày chạy:</label></td>
                                    <td>
                                        <input type="text" id="sdt2" name="sdt2" class="w-100" readonly value="{{$seat->ngaychay}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="sdt2">Giờ chạy:</label></td>
                                    <td>
                                        <input type="text" id="sdt2" name="sdt2" class="w-100" readonly value="{{$seat->tg_xuatben}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="gia">Giá vé:</label></td>
                                    <td>
                                        <input type="text" id="gia" name="gia" class="w-100" readonly value="{{$seat->giave}} vnd">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="PTTT">PTTT:</label></td>
                                    <td>
                                        @foreach ($pttts as $pttt)
                                        @if($seat->idtt == $pttt->idtt)
                                        <input type="text" id="idtt" name="idtt" class="w-100" readonly value="{{$pttt->tentt}}">
                                        @endif
                                        @endforeach

                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="id_c_ng_g_x">Xe:</label></td>
                                    <td><input type="text" id=" " name=" " class="w-100" readonly value="{{$seat->bienso}} - {{$seat->tenloai}}">

                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="maghe">Chỗ ngồi: </label></td>
                                    <td>
                                        @foreach ($chairs as $chair)
                                        @if($chair->iddc == $seat->iddc)

                                        <?php
                                        $money++;
                                        $maghes .= $chair->maghe . "  " ?>
                                        @endif
                                        @endforeach
                                        <input type="text" id="maghe" class="w-100" name="maghe" readonly value="{{$maghes}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="note">Tổng tiền: </label></td>
                                    <td>
                                        <input id="note" name="" class="w-100" readonly value="{{$seat->giave * $money}} vnd">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="note">Ghi chú: </label></td>
                                    <td>
                                        <textarea id="note" name="note" class="w-100" style="height: 30px;" readonly value="">{{$seat->note}}</textarea>
                                    </td>
                                </tr>
                            </table>
                            @method('delete')
                            @if ($seat->idttv == 1)
                            <td class="text-danger btn " style="height: 70px;">
                                <a href="{{asset('client/history/deleteSeat')}}/{{$seat->iddc}}" class="btn btn-primary" style="margin-left: 40%;" onclick="return confirm('Bạn có chắc muốn hủy vé không?')">
                                    Hủy vé
                                </a>
                            </td>
                            @elseif ( $seat->idttv == 3 or $seat->idttv == 4)
                            <td class=" btn " style="height: 70px;">
                                <a href="{{asset('client/history/deleteTicket')}}/{{$seat->iddc}}" class="btn btn-danger" style="margin-left: 30%;" onclick="return confirm('Bạn có chắc muốn xóa không?')">
                                    Xóa
                                </a>
                                @if ($rates->isEmpty())
                                    <div data-toggle="modal" data-target="#ModalCreateRating" class="btn btn-primary id_rating 1 " id="{{$seat->iddc}}">
                                        Đánh giá
                                    </div>
                                @else
                                    @foreach ($rates as $rate)
                                        @if ($rate->iddc == $seat->iddc && $temp==0)
                                            <div data-toggle="modal" data-target="#ModalReviewRating" class="btn btn-primary id_rating_view 2" id="{{$seat->iddc}}">
                                                Xem đánh giá
                                            </div>
                                            <input type="hidden" value="{{$rate->rating}}" class="rating_number">
                                            <input type="hidden" value="{{$rate->noidungbl}}" class="rating_content">
                                            <?php $temp++ ?>
                                        @endif
                                    @endforeach
                                @if($temp == 0)
                                <div data-toggle="modal" data-target="#ModalCreateRating" class="btn btn-primary id_rating 3 " id="{{$seat->iddc}}">
                                    Đánh giá
                                </div>
                                @endif
                                @endif


                                <!-- <input type="text" value="{{$seat->idghe}}" id="{{$seat->idghe}}" class="idghe"> -->
                                <input type="hidden" value="5" class="number_rating">

                                <input type="hidden" value="{{auth('client')->user()->idkh}}" class="idkh">
                            </td>
                            <td class="text-danger btn " style="height: 70px;">

                            </td>
                            @elseif ($seat->idttv == 0 )
                            <td class=" btn " style="height: 70px;">
                                <a href="{{asset('client/history/deleteTicketDes')}}/{{$seat->iddc}}" class="btn btn-danger" style="margin-left: 30%;" onclick="return confirm('Bạn có chắc muốn xóa không?')">
                                    Xóa
                                </a>
                                <a href="{{asset('client/history/deleteTicketRe')}}/{{$seat->iddc}}" class="btn btn-info">
                                    Đặt lại
                                </a>
                            </td>
                            <td class="text-danger btn " style="height: 70px;">

                            </td>
                            @endif

                        </form>
                    </div>
                </div>
                @endforeach

                <div class="col-2"></div>
                @if (Session::has('success'))
                    <script>
                        swal("Thành công!", "{!!session('success')!!}", "success", {
                            button: "ok",
                        })
                    </script>
                @endif
                <!-- het noi dung -->
            </div>
            <div class="col-3"></div>
            <div class="col-4"></div>
            <div class="col-4">

                <div style="position: relative; text-align: justify;" class="mt-3">{{$seats->onEachSide(1)->links()}}</div>
            </div>
            <div class="col-4"></div>
            



        </div>
        <br>
        @include('client.ticket.modal.createModalRating')
        @include('client.ticket.modal.reviewModalRating')
        <!-- noi dung -->
        @include('client.layout.footer')
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <!-- @include('client.layout.script') -->
    </div>

</body>

</html>