<!-- client -->
<script type="text/javascript">
    $(document).ready(function() {
        // adress
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
                    // console.log(action);
                    $.ajax({
                        method: "POST",
                        url: '{{url("/client/user/address")}}',
                        data: {
                            action: action,
                            matp: matp,
                            _token: _token,
                        },
                        success: function(data) {
                            // console.log(123);
                            $('#' + result).html(data);
                            // console.log(ma1tp);
                            // console.log(('#' + result));
                        }
                    });
                }


            }

        );
        // load ajax after 5s
        setInterval(function() {
            var privateTeam = $('.bus').val();
            hide_show(privateTeam);
        }, 5000);
        
        // show seat
        $('.bus').on('change', function() {
            var action = $(this).attr('id');
            var ma = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            console.log(action)
            if (action != '') {
                $.ajax({
                    method: "POST",
                    url: '{{url("/client/ticket/seat")}}',
                    data: {
                        action: action,
                        ma: ma,
                        _token: _token,
                    },
                    success: function(data) {
                        $('.seatBus').html(data);
                        // console.log(('#' + result));
                    }
                });
            }
        });
        // show seatOld
        var privateTeam = $('.bus').val();
        hide_show(privateTeam);

        //  route
        $('.findRoute').on('change', function() {
                var action = $(this).attr('id');
                var ma = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
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
                        url: '{{url("/client/ticket/findRoute")}}',
                        data: {
                            action: action,
                            ma: ma,
                            _token: _token,
                        },
                        success: function(data) {
                            $('#' + result).html(data);
                            // console.log((result)); 
                        }
                    });
                }


            }

        );

    });

    function hide_show(privateTeam) {
        if (privateTeam != 0) {
            var action = $(this).attr('id');
            var ma = privateTeam;
            var _token = $('input[name="_token"]').val();
            var result = '';
            if (action != '') {
                $.ajax({
                    method: "POST",
                    url: '{{url("/client/ticket/seat")}}',
                    data: {
                        action: action,
                        ma: ma,
                        _token: _token,
                    },
                    success: function(data) {
                        $('.seatBus').html(data);
                        // console.log(('#' + result));
                    }
                });
            }
        }
    }
    // $(function() {
    //     $('.bus').on('change', function() {
    //         $.cookie('id_c_ng_g_x', this.value);
    //         console.log('before')
    //         // previous = this.value;
    //         console.log($.cookie('id_c_ng_g_x', this.value))
    //     });
    //     $('.id_c_ng_g_x').val($.cookie('id_c_ng_g_x') || 1);
    //     console.log($('.id_c_ng_g_x').val($.cookie('id_c_ng_g_x') || 1))

    // });
    // (function() {
    //     var previous;
    //     $("select[name=id_c_ng_g_x]").focus(function() {
    //         // Store the current value on focus, before it changes
    //         console.log('before')
    //         previous = this.value;
    //         console.log(previous)

    //     }).change(function() {
    //         // Do something with the previous value after the change
    //         // document.$(this).attr('id')
    //         console.log('after')
    //         previous = this.value;
    //         console.log(previous)
    //     });
    // })();
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