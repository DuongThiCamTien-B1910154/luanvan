<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BusLine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <link href="{{asset('css/sticky-footer.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link href="{{url('')}}/css/sticky-footer.css" rel="stylesheet"> -->
    <!-- <link href="css/font-awesome.min.css" rel=" stylesheet"> -->
    <!-- <link href="css/animate.css" rel=" stylesheet"> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://kit.fontawesome.com/fa204eeff7.js" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">

    <!-- @@04/06 -->

    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
    <!-- <script src="https://www.paypalobjects.com/api/checkout.js"></script> -->

    <!-- <script>
        paypal.Button.render({
            env: 'sandbox',
            client: {
                sandbox: 'Afc-CfzqRA-W3aPhQ_HKWE7dGWBeTafcmX2zP5z36_a049n7V69BWJ0wh99k_gnheFTqClUWbl5R3_Tt',
                production: 'demo'
            },
            
            locale: 'en_US',
            style: {
                size: 'small',
                color: 'gold',
                shape: 'pill',
            },
            commit: true,
            payment: function(data, actions) {
                return actions.payment.create({
                    transactions: [{
                        amount: {
                            total: '100',
                            currency: 'USD'
                        }
                    }]
                })

            },
            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function() {
                    window.alert("cam on ban da lua chon mua san pham cua chung toi")
                });
            }
        }, '#paypal-button');
    </script> -->
</head>