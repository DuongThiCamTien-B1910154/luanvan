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

<body>

    <!-- partial:partials/_navbar.html -->
    @include('admin.layout.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.layout.sidebar')

        <!-- partial -->
        <div class="main-panel mt-3 " style="margin-left: 20px; margin-right: 20px;">

            <!-- content-wrapper -->


            <div class="container-fluid row mt-2 " style="margin-left: 25%;">
                <div class="col-6 row bg-white">
                    <!-- day la noi dung -->
                    <div class="col-md-12 ">
                        <h4 class=" text-uppercase mt-3" style="float: right;">Ngày Đặt: {{$ticket->created_at}} </h4>
                        <h4><a href="{{asset('admin/ticket')}}" style="float: left; font-size: 30px; margin-top: 1%;"><i class="fa-solid fa-left-long text-info"></i></a></h4>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-9">
                        <div class="">
                            <span class="text-uppercase font-weight-bold text-danger" style="font-size: 25px; margin-left: 10%;"> Thông tin chuyến đi</span>
                        </div>
                        <div class=" card-body border mb-3 ">
                            <form action="{{asset('client/ticket/booking')}}" enctype="multipart/form-data" method="POST" id="form-id" class="">
                                @csrf
                                <table>
                                    <tr>
                                        <td><label for="tennd">Họ tên: </label></td>
                                        <td>

                                            <input type="text" id="bienso" readonly name="tennd2" value="{{$ticket->tennd2}}" placeholder="Họ tên">

                                        </td>
                                    </tr>
                                    <input type="text" id="idkh" name="idkh" hidden value="" placeholder="Email">

                                    <tr>
                                        <td><label for="sdt2">SĐT:</label></td>
                                        <td>
                                            <input type="text" id="sdt2" name="sdt2" readonly value="{{$ticket->sdt2}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="sdt2">Tuyến:</label></td>
                                        <td>
                                            <input type="text" id="sdt2" name="sdt2" readonly value="{{$ticket->tentuyen}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="sdt2">Ngày chạy:</label></td>
                                        <td>
                                            <input type="text" id="sdt2" name="sdt2" readonly value="{{$ticket->ngaychay}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="sdt2">Giờ chạy:</label></td>
                                        <td>
                                            <input type="text" id="sdt2" name="sdt2" readonly value="{{$ticket->tg_xuatben}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="gia">Giá vé:</label></td>
                                        <td>
                                            <input type="text" id="gia" name="gia" readonly value="{{$ticket->giave}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="PTTT">PT thanh toán:</label></td>
                                        <td>
                                            @if($ticket->PTTT == 0)
                                            <input type="text" id="gia" name="gia" readonly value="Thanh toán khi nhận vé">
                                            @else
                                            <input type="text" id="gia" name="gia" readonly value="Thanh toán với PAYPAL">
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="id_c_ng_g_x">Xe:</label></td>
                                        <td>
                                            <input type="text" id="gia" name="gia" readonly value="{{$ticket->bienso}} - {{$ticket->tenloai}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="maghe">Chỗ ngồi: </label></td>
                                        <td>
                                            <input type="text" name="maghe" readonly value="{{$ticket->maghe}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="note">Ghi chú: </label></td>
                                        <td>
                                            <textarea id="note" name="note" readonly value="">{{$ticket->note}}</textarea>
                                        </td>
                                    </tr>
                                </table>


                            </form>
                        </div>
                    </div>
                    @if($ticket->TTV == 1)
                    <span><a target="_blank" class="btn btn-success" href="{{asset('admin/ticket/invoice')}}/{{$ticket->idvx}}" style="float: right;  margin-bottom: 5%;">Xuất vé</a></span>
                    @endif



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