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
                var ma = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                // console.log(123);
                // console.log(action);
                // console.log(idtuyen);
                // if (action == 'route') {
                //     result = 'time';
                // } else if (action == 'time') {
                //     result = 'day';
                // } else if (action == 'day') {
                //     result = 'bus';
                // } else if (action == 'bus') {
                //     result = 'seat';
                // } else {
                //     action = ''
                // }
                console.log(action);
                console.log(ma);

                if (action != '') {
                    $.ajax({
                        method: "POST",
                        url: '{{url("/admin/ticket/seat")}}',
                        data: {
                            action: action,
                            ma: ma,
                            _token: _token,
                        },
                        success: function(data) {
                            console.log(data);
                            $('.seatBus').html(data);
                            // // console.log(ma1tp);
                            // console.log(('#' + result));
                        }
                    });
                }


            }

        );
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
                console.log(action);
                console.log(ma);

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


            }

        );
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