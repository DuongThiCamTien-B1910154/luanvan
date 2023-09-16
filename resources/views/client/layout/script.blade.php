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

        //  rating submit
        $(".rating_bus").click(function(e) {
            event.preventDefault()
            var content = $(".content").val();
            var number = $(".number_rating").val()
            var _token = $('input[name="_token"]').val();
            if (!number) {
                alert("Vui lòng chọn đánh giá !");
            } else(
                $.ajax({
                    method: "POST",
                    url: '{{url("/client/ticket/rating")}}',
                    data: {
                        number: number,
                        content: content,
                        _token: _token,
                    },
                    success: function(data) {
                        alert("Đánh giá thành công");
                        $('#ModalCreateRating').modal().hide()
                        $('.modal-backdrop').remove();
                    }
                })
            )

        })
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
                    }
                });
            }
        }
    }

    //  rating_start
    $(function() {
        let listStart = $(".list_start .fa");
        listRatingText = {
            1: 'Không thích',
            2: 'Tạm được',
            3: 'Bình thường',
            4: 'Tốt',
            5: 'Rất tốt',
        };

        listStart.mouseover(function() {
            let $this = $(this);
            let number = $this.attr('data-key')
            listStart.removeClass('rating_active')
            $(".number_rating").val(number)
            $.each(listStart, function(key, value) {
                if (key + 1 <= number) {
                    $(this).addClass('rating_active')
                }
            })
            $(".list_text").text('').text(listRatingText[number]).show()
        })

    })
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