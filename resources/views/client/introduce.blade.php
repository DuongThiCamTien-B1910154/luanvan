<!DOCTYPE html>
<html lang="en">

@include('client.layout.header')


<body class="preloading">

    @include('client.layout.nav')
    <div class="main">


        <hr>
        <div class="container-fluid row">
            <div class="col-2"></div>
            <div class="pl-3"></div>
            <div class="col-8 row ">
                <!-- day la noi dung -->

                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="">
                            <div class="mt-3">
                                <img src="{{asset('/images/faces/logo1.jpg')}}" height="200px" width="250px" style="margin-left: 35%; " />
                            </div>
                        </div>
                        <hr>
                        <!-- <a href="" class="">
                            <img src="{{asset('/images/in1.jpg')}}" height="500px" width="100%" />
                        </a> -->
                        <div class=" card-body">
                            <dt class=""> Công ty BUSLINE được thành lập năm 2001.
                                Trải qua 20 năm phát triển đặt khách hàng làm trọng tâm,
                                chúng tôi tự hào trở thành doanh nghiệp vận tải nòng cốt đóng góp tích cực vào
                                sự phát triển chung của ngành vận tải nói riêng và nền kinh tế đất nước nói chung.
                                Luôn cải tiến mang đến chất lượng dịch vụ tối ưu nhất dành cho khách hàng,
                                Công ty BUSLINE được ghi nhận qua nhiều danh hiệu danh giá như
                                “Top 5 Công ty Uy tín ngành Vận Tải và Logistics”, “Top 50 Nhãn hiệu nổi tiếng Việt Nam”,
                                “Sản phẩm và Dịch vụ Chất lượng Châu Á”, “Top 10 Thương hiệu chất lượng Châu Á”,…
                            </dt>
                        </div>

                        <a href="" class="">
                            <img src="{{asset('/images/in1.jpg')}}" height="500px" width="100%" />
                        </a>
                        <div class=" card-body">
                            <dt class="">
                                Tuân thủ phương châm “Chất lượng là danh dự”,
                                Công ty Cổ phần Xe Khách BUSLINE – FUTA Bus Lines hiện đang khai thác hơn 60 tuyến vận tải
                                hành khách liên tỉnh cố định trải dài từ Nam ra Bắc với hơn 250 phòng vé và
                                trạm trung chuyển, hơn 2,000 đầu xe các loại, phục vụ hơn 20 triệu lượt khách mỗi năm.
                            </dt>
                        </div>
                        <a href="" class="">
                            <img src="{{asset('/images/in3.jpg')}}" height="500px" width="100%" />
                        </a>
                        <div class=" card-body">
                            <dt class="">
                                BUSLINE cũng ra mắt dịch vụ taxi với việc thành lập Công ty Cổ phần Taxi BUSLINE - FUTA Taxi.
                                FUTA Taxi hiện đã có mặt tại Thành phố Hồ Chí Minh và Bà Rịa Vũng Tàu.
                                Không chỉ đầu tư vào các loại xe đời mới, FUTA Taxi còn luôn nâng cao chất
                                lượng dịch vụ bằng thái độ phục vụ chu đáo, tận tâm, và trung thực.
                                AN TOÀN - NHANH CHÓNG - GIÁ HỢP LÝ là các giá trị mà FUTA Taxi đem đến cho khách hàng
                                với mong muốn khách hàng sẽ có những chuyến đi trọn vẹn và nhiều ý nghĩa. Đó cũng sứ mệnh
                                mà mỗi tài xế FUTA Taxi luôn cố gắng gìn giữ và phát huy.

                            </dt>
                        </div>
                        <a href="" class="">
                            <img src="{{asset('/images/in5.jpg')}}" height="500px" width="100%" />
                        </a>
                        <div class=" card-body">
                            <dt class="">
                                Bên cạnh đó, chúng tôi còn đầu tư vào lĩnh vực truyền thông, 
                                quảng cáo với việc thành lập Công ty Cổ phần Quảng Cáo FUTA Việt Nam – FUTA Ads, là đơn vị khai thác quảng cáo trên toàn bộ hệ sinh thái của Tập đoàn BUSLINE với đa dạng hình thức quảng cáo như Quảng cáo xe bus đường dài, quảng cáo vận chuyển hàng, quảng cáo xe taxi, gian hàng bán hàng… Trong xu hướng 4.0 hiện nay, chúng tôi cũng đang ứng dụng và phát triển những công nghệ quảng cáo kỹ thuật số (Digital Marketing) với mục tiêu mang đến giải pháp tiếp thị toàn diện hiệu quả cho doanh nghiệp.


                            </dt>
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
        <script src="js/script.js"></script>
    </div>

</body>

</html>