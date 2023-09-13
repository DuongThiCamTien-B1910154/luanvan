<!DOCTYPE html>
<html lang="en">
@include('admin.layout.header')


<body>
    <!-- <div class="container-scroller">
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0">
                <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
                    <div class="ps-lg-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                            <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template/"><i class="mdi mdi-home me-3 text-white"></i></a>
                        <button id="bannerClose" class="btn border-0 p-0">
                            <i class="mdi mdi-close text-white me-0"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div> -->
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

                <h2 class="mt-2">
                    <b>
                        <a href="{{asset('admin/bus')}}"><i class="fa-solid fa-left-long"></i></a>
                        &nbsp;&nbsp;&nbsp;
                        Chi tiết ghế => Xe: {{$bus->bienso}}
                    </b>
                </h2>
                <div class="d-flex justify-content-between ">
                    <div style="font-size: 15px; ">
                        <button class="btn btn-success" onclick="document.getElementById('form-id').submit();">Lưu thay đổi</button>
                    </div>
                </div>
            </div>



            @if (session('success'))
            <div class="alert alert-success">

                {{ session('success') }}
            </div>
            @endif
            <table id="contacts" class="table table-bordered table-striped mt-2 w-100">
                @csrf
                <thead>
                    <tr style="background-color:DodgerBlue; color: #fff;">
                        <th>STT</th>
                        <th>Mã số </th>
                        <th>Tình trạng </th>

                    </tr>
                </thead>
                <form action="" enctype=" multipart/form-data" method="POST" id="form-id">
                    <tbody>
                        @csrf
                        @foreach ($datas as $key => $data)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$data->maghe}}</td>
                            <td>
                                <select name="idtt" id="">
                                    @foreach ($status as $sta)
                                    @if($sta->idtt == $data->idtt)
                                    <option value="{{$sta->idtt}}">{{$sta->tentt}}</option>
                                    @endif
                                    @endforeach
                                    @foreach ($status as $sta)
                                    @if($sta->idtt != $data->idtt)
                                    <option value="{{$sta->idtt}}">{{$sta->tentt}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        @endforeach
                        <!-- <tr style="background-color: #fff">
                            <td>12</td>
                            <td>3</td>
                            <td>
                                <label for="">hỏng&nbsp; &nbsp; &nbsp;</label>
                                <select name="tinhtrang" id="myList" class="">
                                </select>
                            </td>
                            <td>
                                <input type="checkbox" class="showStatus">
                            </td>
                        </tr> -->
                    </tbody>
                </form>
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