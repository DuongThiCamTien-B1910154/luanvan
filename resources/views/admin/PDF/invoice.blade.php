<style>
    body {
        font-family: DejaVu Sans;
    }

    table,
    td {
        border: 1px solid #000;
    }

    table {
        margin-left: 33%;
        justify-content: between;
    }
</style>

<div class="col-md-12">
    <div style="float: right;">Mã số: <b>{{$iddc}}</b><br>
        Ký hiệu: <b>A0/{{$chair->idghe}}</b><br>
        Số: </div>
    <div class="" style="float: left;">
        <b style="font-size:20px">CÔNG TY TNHH BUSLINE</b>
        <br>
        <div style="font-size:13px"> Mã số thuế: <b>025679887</b></div>
        <div style="font-size:13px">Địa chỉ: 250A, P.Niệm Nghĩa, Q.Lê Chân, TP.Hải Phòng</div>
        <div style="font-size:13px">SĐT: <b>0392544714</b></div>
    </div>
</div>
<br>
<br>
<br>
<h2 class="">
    <center>VÉ XE KHÁCH LƯỢT</center>
</h2>
<table class="table table-bordered ">
    <tr>
        <td>Họ tên: </td>
        <td>
            {{$ticket->tennd2 }}
        </td>
    </tr>

    <tr>
        <td>SĐT:</td>
        <td>
            {{$ticket->sdt2 }}
        </td>
    </tr>
    <tr>
        <td>Tuyến đường:</td>
        <td>
            {{$ticket->tentuyen}}
        </td>
    </tr>
    <tr>
        <td>Ngày chạy:</td>
        <td>
            {{$ticket->ngaychay }}
        </td>
    </tr>
    <tr>
        <td>Giờ chạy:</td>
        <td>
            {{$ticket->tg_xuatben }}
        </td>
    </tr>
    <tr>
        <td>Giá vé:</td>
        <td>
            {{$ticket->giave}}
        </td>
    </tr>

    <tr>
        <td>Xe:</td>
        <td> {{$ticket->bienso }}

        </td>
    </tr>
    <tr>
        <td>Chỗ ngồi: </td>
        <td>
            {{$chair->maghe}}
        </td>
    </tr>
    <tr>
        <td>Ghi chú:</td>
        <td>
            {{$ticket->note }}
        </td>
    </tr>
</table>
<br>
<div style="float: left;">Ngày ... tháng ... năm 2023</div>
<div style="float: right;"><b>Người xuất vé</b><br>

    <center>{{$name->tennd}}</center>
</div>
<br>
<br>
<br>
<div style="font-size:10px; margin-left:31%;"><i>(In tại công ty TNHH BUSLINE - Mã số thuế: 025679887 - SĐT: 0392544713)</i></div>
<br>
<br>
<br><br>
<br>
<br><br>
<br>
<br><br>
<br>
<br><br>
<br>
<br>