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

            <div class="d-flex justify-content-between">
                <form class="d-flex align-items-center h-100 " action="">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control border-1 border-dark " placeholder="Tìm kiếm..." style="font-size: 15px;" name="search" value="{{$search}}">
                        <div class="input-group-prepend bg-transparent">
                            <i class="input-group-text border-1 btn border-primary mdi mdi-magnify bg-primary" style="font-size: 20px; color: #fff;"></i>
                        </div>
                    </div>
                </form>
                <div class="btn btn-primary " style="font-size: 15px;">
                    <a href="{{asset('admin/ticket/addTicket')}}" class="nav-link text-light "><i class="fa-solid fa-plus"></i> Thêm vé xe</a>

                </div>
            </div>


            @if (session('success'))
            <div class="alert alert-success">

                {{ session('success') }}
            </div>
            @endif

            <table id="contacts" class="table table-bordered  mt-2 w-100 bg-white">
                @csrf
                <caption class="my-caption">
                    <h2 class="col-12 text-uppercase  p-3 text-black border bg-white text-center" style=" font-family: Cursive;"><b>Danh mục vé xe</b></h2>

                </caption>
                <thead class="text-uppercase">
                    <tr style="background-color:DodgerBlue; color: #fff; text-align: center;">
                        <th>STT</th>
                        <th>Họ tên </th>
                        <th>SĐT</th>
                        <th>Tuyến</th>
                        <th>Ngày chạy</th>
                        <th>Giờ chạy</th>
                        <th>PTTT</th>
                        <th>Chi tiết</th>
                        <th style="width: 50px; ">Tùy chọn</th>
                        <th style=" width: 50px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $key => $ticket)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$ticket->tennd2}}</td>
                        <td>{{$ticket->sdt2}}</td>
                        <td>{{$ticket->tentuyen}}</td>
                        <td>{{$ticket->ngaychay}}</td>
                        <td>{{$ticket->tg_xuatben}}</td>
                        @if($ticket->PTTT == 0)
                        <td>Tiền mặt</td>
                        @else
                        <td>Chuyển khoản</td>
                        @endif
                        <td>
                            <a href="{{asset('admin/ticket/detailTicket')}}/{{$ticket->iddc}}"><b>Chi tiết</b></a>

                        </td>
                        <form action="" method="post">
                            @csrf
                            @if ($ticket->idttv == 1)
                            <td>
                                <a href="{{asset('admin/ticket/browseTicket')}}/{{$ticket->iddc}}" class="btn btn-warning w-100">{{$ticket->tentrangthai}}</a>
                            </td>
                            @elseif($ticket->idttv == 2)
                            <td>
                                <a href="#" class="btn btn-info w-100">{{$ticket->tentrangthai}}</a>
                            </td>
                            @else
                            <td>
                                <a href="#" class="btn btn-success">Hoàn thành</a>
                            </td>
                            @endif

                            <td>
                                @method('delete')
                                <a href="{{asset('admin/ticket/deleteTicket')}}/{{$ticket->iddc}}" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa</a>
                            </td>

                        </form>
                    </tr>
                    @endforeach

                </tbody>
            </table>
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