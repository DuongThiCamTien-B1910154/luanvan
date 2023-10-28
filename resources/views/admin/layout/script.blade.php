<!-- admin -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.choose').on('change', function() {
            var action = $(this).attr('id');
            var matp = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';

            if (action == 'city') {
                result = 'district';
            } else if (action == 'district') {
                result = 'town';
            } else {
                action = ''
            }
            if (action != '') {
                $.ajax({
                    method: "POST",
                    url: '{{url("/admin/user/addUser")}}',
                    data: {
                        action: action,
                        matp: matp,
                        _token: _token,
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                        // console.log(matp);
                    }
                });
            }


        });
        $('.bus').on('change', function() {
                var action = $(this).attr('id');
                var id_c_ng_g_x = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';

                console.log(action);
                console.log(id_c_ng_g_x);

                if (action != '') {
                    $.ajax({
                        method: "POST",
                        url: '{{url("/admin/ticket/seat")}}',
                        data: {
                            action: action,
                            id_c_ng_g_x: id_c_ng_g_x,
                            _token: _token,
                        },
                        success: function(data) {
                            // console.log(data);
                            $('.seatBus').html(data);
                            // // console.log(ma1tp);
                            // console.log(('#' + result));
                        }
                    });
                    // check_seat 
                    $.ajax({
                        method: "POST",
                        url: '{{url("/admin/ticket/check_seat")}}',
                        data: {
                            action: action,
                            id_c_ng_g_x: id_c_ng_g_x,
                            _token: _token,
                        },
                        success: function(data) {
                            $('.check_seat').html(data);
                            // console.log(data);   
                        }
                    });
                }


            }

        );
        // load ajax after 5s
        setInterval(function() {
            var privateTeam = $('.bus').val();
            console.log('privateTeam')
            hide_show(privateTeam);
        }, 5000);
        // load seat when submit err
        function hide_show(privateTeam) {
            if (privateTeam != 0) {
                var action = $(this).attr('id');
                var id_c_ng_g_x = privateTeam;
                var _token = $('input[name="_token"]').val();
                var result = '';
                if (action != '') {
                    $.ajax({
                        method: "POST",
                        url: '{{url("/client/ticket/seat")}}',
                        data: {
                            action: action,
                            id_c_ng_g_x: id_c_ng_g_x,
                            _token: _token,
                        },
                        success: function(data) {
                            $('.seatBus').html(data);
                        }
                    });
                }
            }
        }
        //  route
        $('.findRoute').on('change', function() {
            var action = $(this).attr('id');
            var ma = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            // console.log(123);
            // console.log(action);
            // console.log(idtuyen);
            if (action == 'route') {
                result = 'time';
            } else if (action == 'time') {
                result = 'day';
            } else {
                action = ''
            }
            // console.log(action);
            // console.log(ma);

            if (action != '') {
                $.ajax({
                    method: "POST",
                    url: '{{url("/admin/ticket/findRoute")}}',
                    data: {
                        action: action,
                        ma: ma,
                        _token: _token,
                    },
                    success: function(data) {
                        // console.log(data);
                        $('#' + result).html(data);
                        // // console.log(ma1tp);
                        // console.log(('#' + result)); 
                    }
                });
            }
        });

        // date picker
        $('.filter').on('click', function() {
            var input_from = $(".input_from").val()
            var input_to = $(".input_to").val()
            var _token = $('input[name="_token"]').val();
            console.log(Cookies.set('input_from', input_from))
            console.log(Cookies.set('input_to', input_to))

            $.ajax({
                method: "GET",
                url: '{{url("/admin/filterTrip")}}',
                data: {
                    input_from: input_from,
                    input_to: input_to,
                    _token: _token,
                },
                success: function(data) {
                    // console.log(data);
                    $('.filterTrip').html(data);
                    // console.log(data); 
                }
            });
        });

        // date search trip
        $('.searchTrip').on('click', function() {
            var searchTrip = $(".searchTripValue").val()
            var _token = $('input[name="_token"]').val();
            console.log(Cookies.set('searchTrip', searchTrip))

            $.ajax({
                method: "GET",
                url: '{{url("/admin/searchTrip")}}',
                data: {
                    searchTrip: searchTrip,
                    _token: _token,
                },
                success: function(data) {
                    $('.filterTrip').html(data);
                }
            });
        });
        // date run addTripAdd
        $('.dateRun').on('change', function() {
            var dateRun = $(".dateRun").val()
            var _token = $('input[name="_token"]').val();
            // console.log(dateRun)
            $.ajax({
                method: "GET",
                url: '{{url("/admin/trip/showBusRunAdd")}}',
                data: {
                    dateRun: dateRun,
                    _token: _token,
                },
                success: function(data) {
                    $('#idxe').html(data);
                }
            });
        });
        // date run addTripEdit - chua xong
        $('.dateRunEdit').on('change', function() {
            var dateRun = $(".dateRunEdit").val()
            var idxeOld = $(".idxeOld").val()
            var dateOld = $(".dateOld").val()
            var _token = $('input[name="_token"]').val();

            // console.log(dateOld)
            // console.log(idxeOld)
            $.ajax({
                method: "GET",
                url: '{{url("/admin/trip/showBusRunEdit")}}',
                data: {
                    dateRun: dateRun,
                    idxeOld: idxeOld,
                    dateOld: dateOld,
                    _token: _token,
                },
                success: function(data) {
                    // console.log(data)

                    $('#idxe').html(data);
                }
            });
        });
        // data picker autoload
        $(function() {
            var input_from = $(".input_from").val()
            var input_to = $(".input_to").val()
            $(".idxeOld").val()
            $(".dateOld").val()
            var _token = $('input[name="_token"]').val();
            $.ajax({
                method: "GET",
                url: '{{url("/admin/filterTrip")}}',
                data: {
                    input_from: input_from,
                    input_to: input_to,
                    _token: _token,
                },
                success: function(data) {
                    // console.log(data);
                    $('.filterTrip').html(data);
                    // console.log(data); 
                }
            });

        })

        // statictis
        $('.sortSta').on('click', function() {
            var input_froms = $(".input_froms").val()
            var input_tos = $(".input_tos").val()

            var _token = $('input[name="_token"]').val();
            $.ajax({
                method: "GET",
                dataType: "JSON",
                url: '{{url("/admin/statistic/sortStatistic")}}',
                data: {
                    input_froms: input_froms,
                    input_tos:input_tos,
                    _token: _token,
                },
                success: function(data) {
                    // chart.setChart(data)
                    if(data == null){
                        alter("Không có dữ liệu trong thời gian này ")
                    }else{
                        chart.setData(data);
                    }
                    // chart.series[0].data.push(data);
                }
            });
            $.ajax({
                method: "GET",
                // dataType: "JSON",
                url: '{{url("/admin/statistic/profit")}}',
                data: {
                    input_froms: input_froms,
                    input_tos:input_tos,
                    _token: _token,
                },
                success: function(data) {
                    console.log(data)
                    $('.profit').html(data);
                    // chart.setChart(data)
                    // chart.setData(data);
                    // chart.series[0].data.push(data);
                }
            });
        });
        // thongke chua dc su dung
        $('.thongke').on('click', function() {
            console.log("tientien")
            var yearSta = $(".yearSta").val()
            // var idxeOld = $(".idxeOld").val()
            // var dateOld = $(".dateOld").val()
            var _token = $('input[name="_token"]').val();
            // alert(yearSta)
            $.ajax({
                method: "GET",
                dataType: "JSON",
                url: '{{url("/admin/statistic")}}',
                data: {
                    yearSta: yearSta,
                    _token: _token,
                },
                success: function(data) {
                    alert(data)
                    chart.setData(data);
                }
            });
        });
        var chart = new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'myfirstchart',
            xkey: 'ngayxechay',
            ykeys: ['tongtien', 'soluongve'],
            labels: ['Tổng tiền', 'Số lượng vé']
        });
    });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous">
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="{{asset('/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{asset('/vendors/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('/js/jquery.cookie.js')}}" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{asset('/js/off-canvas.js')}}"></script>
<script src="{{asset('/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('/js/misc.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{asset('/js/dashboard.js')}}"></script>
<script src="{{asset('/js/todolist.js')}}"></script>

<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/picker.js')}}"></script>
<script src="{{asset('js/picker.date.js')}}"></script>

<script src="{{asset('js/main.js')}}"></script>