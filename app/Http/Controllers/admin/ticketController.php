<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\bookingRequest;
use App\Models\adminModel;
use App\Models\chairModel;
use App\Models\routeModel;
use App\Models\tripDayTimeBusModel;
use Illuminate\Http\Request;
use App\Models\busModel;
use App\Models\dayModel;
use App\Models\ticketModel;
use App\Models\timeModel;
use App\Models\tripModel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use PDF;
// use App\Models\adminModel;

class ticketController extends Controller
{
    public function showTicket(Request $request)
    {
        // $this->data['title'] = "Thành viên";
        // $this->data['error'] = "Vui lòng kiểm tra lại !";
        $search = $request['search'] ?? "";

        if ($search != "") {
            $tickets = chairModel::join('vexe', 'vexe.idghe', '=', 'ghe.idghe')
                ->join('xe', 'xe.idxe', '=', 'ghe.idxe')
                ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
                ->join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'vexe.id_c_ng_g_x')
                ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
                ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
                ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
                ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
                ->orderBy('TTV', 'asc')->where('TTV', '>=', '0')
                ->where('sdt2', 'LIKE', "%$search%")
                ->orWhere('tennd2', 'LIKE', "%$search%")
                ->orWhere('tentuyen', 'LIKE', "%$search%")
                ->orderBy('TTV', 'asc')->get();
        } else {
            $tickets = chairModel::join('vexe', 'vexe.idghe', '=', 'ghe.idghe')
                ->join('xe', 'xe.idxe', '=', 'ghe.idxe')
                ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
                ->join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'vexe.id_c_ng_g_x')
                ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
                ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
                ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
                ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
                ->orderBy('TTV', 'asc')->where('TTV', '>=', '0')->get();
        }
        // $test = ticketModel::all();
        // dd($tickets);
        return view('admin.ticket.listTicket', compact('tickets', 'search'));
    }
    public function detailTicket($id)
    {
        $ticket = chairModel::join('vexe', 'vexe.idghe', '=', 'ghe.idghe')
            ->join('xe', 'xe.idxe', '=', 'ghe.idxe')
            ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
            ->join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'vexe.id_c_ng_g_x')
            ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
            ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
            ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
            ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
            ->where('idvx', $id)->first();

        // dd($ticket);

        return view('admin.ticket.detailTicket', compact('ticket'));
    }
    public function browseTicket($id)
    {
        // dd(12);
        ticketModel::find($id)->update([
            'TTV' => 1
        ]);
        return redirect()->back();
    }

    public function deleteTicket($id)
    {
        // dd($id);
        chairModel::find($id)->update([
            'datcho' => 0,
        ]);
        $success = "Xóa vé thành công!";
        ticketModel::where('idghe', $id)->delete();
        return redirect()->back()->with('success', $success);
    }


    public function invoice($idvx)
    {
        $data = ticketModel::where('idvx', $idvx)->first();

        chairModel::find($data->idghe)->update([
            'datcho' => 0,
        ]);
        ticketModel::where('idvx', $idvx)->update([
            'TTV' => 2,
        ]);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_convert($idvx));
        return $pdf->stream();
    }
    public function print_convert($idvx)
    {
        $idcv = Auth::guard('admin')->user()->idcv;
        $name = adminModel::join('nguoidung', 'nguoidung.idnd', 'admin.idnd')
            ->where('idcv', $idcv)->first();
        $ticket = chairModel::join('vexe', 'vexe.idghe', '=', 'ghe.idghe')
            ->join('xe', 'xe.idxe', '=', 'ghe.idxe')
            ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
            ->join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'vexe.id_c_ng_g_x')
            ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
            ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
            ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
            ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
            // ->join('khachhang', 'khachhang.idkh', '=', 'vexe.idkh')
            // ->join('nguoidung', 'nguoidung.idnd', '=', 'khachhang.idnd')
            ->where('idvx', $idvx)->first();

        $output = '';
        $output .= '
        <style>
        body{
            font-family: DejaVu Sans;
        }
        table, td{
            border:1px solid #000;
        }
        table{
            margin-left:25%;
            // background-color:red;
            justify-content:between;
        }
        </style>
        <div class="col-md-12 ">
            <div style="float: right;">Mã số: <b>' . $idvx . '</b><br>
            Ký hiệu: <b>A0/945</b><br>
            Số: </div>
            <div class="" style="float: left;">
                <b style="font-size:20px">CÔNG TY TNHH BUSLINE</b>
                <br>
            <div style="font-size:13px"> Mã  số thuế: <b>025679887</b></div>
            <div style="font-size:13px">Địa chỉ: 250A, P.Niệm Nghĩa, Q.Lê Chân, TP.Hải Phòng</div>
            <div style="font-size:13px">SĐT: <b>0392544714</b></div>
            </div>
        </div>
        <br>
        <br>
         <br>
        <h2 class=""><center>VÉ XE KHÁCH LƯỢT</center></h2>
       
        <table class="table table-bordered ">
            <tr>
                <td>Họ tên: </td>
                <td>
                    ' . $ticket->tennd2 . '
                </td>
            </tr>
            
            <tr>
                <td>SĐT:</td>
                <td>
                    ' . $ticket->sdt2 . '
                </td>
            </tr>
            <tr>
                <td>Tuyến đường:</td>
                <td>
                    ' . $ticket->tentuyen . '
                </td>
            </tr>
            <tr>
                <td>Ngày chạy:</td>
                <td>
                    ' . $ticket->ngaychay . '
                </td>
            </tr>
            <tr>
                <td>Giờ chạy:</td>
                <td>
                    ' . $ticket->tg_xuatben . '
                </td>
            </tr>
            <tr>
                <td>Giá vé:</td>
                <td>
                    ' .  $ticket['giave'] . '
                </td>
            </tr>
            
            <tr>
                <td>Xe:</td>
                <td> ' . $ticket->bienso . '

                </td>
            </tr>
            <tr>
                <td>Chỗ ngồi: </td>
                <td>
                    ' . $ticket->maghe . '
                </td>
            </tr>
            <tr>
                <td>Ghi chú:</td>
                <td>
                    ' . $ticket->note . '
                </td>
            </tr>
        </table>
        <br>
        <div style="float: left;">Ngày ... tháng ... năm 2023</div>
        <div style="float: right; margin-right:10%;"><b>Người xuất vé</b><br>  
       
            <center>' . $name->tennd . '</center>
        </div>
        <br>
        <br>
        <br>
        <div style="font-size:10px; margin-left:20%;"><i>(In tại công ty TNHH BUSLINE - Mã số thuế: 025679887 - SĐT: 0392544713)</i></div>
        ';
        return $output;
    }
    public function addTicket()
    {
        $routes = routeModel::all();
        // $times = timeModel::all();
        // $days = dayModel::all();
        // dd($days);
        return view('admin.ticket.addTicket', compact('routes'));
    }
    public function findBus(Request $request)
    {
        // echo (123456);
        $data = $request->all();
        $check = tripModel::join('c_ng_g_x', 'c_ng_g_x.idchuyen', '=', 'chuyen.idchuyen')
            ->where('idtuyen', $data['idtuyen'])
            ->where('idgio', $data['idgio'])
            ->where('idngay', $data['idngay'])
            ->whereNotNull('idxe')
            ->exists();
        // $trip = tripModel::where('idtuyen', $data['idtuyen'])->get();
        // $check_day = tripModel::join('c_ng_g_x', 'c_ng_g_x.idchuyen', '=', 'chuyen.idchuyen')
        //     ->where('idtuyen', $data['idtuyen'])
        //     ->where('idngay', $data['idngay'])->exists();
        // $check_time = tripDayTimeBusModel::where('idchuyen', $trip['idchuyen'])->where('idgio', $data['idgio'])->exists();
        // $check_day = tripDayTimeBusModel::where('idchuyen', $trip['idchuyen'])->where('idngay', $data['idngay'])->exists();
        if (!$check) {
            $error = "Không tìm thấy xe phù hợp!";
            return redirect()->back()->with('error', $error);

            // return view('client.ticket.showTicket', compact('error'));
            // dd(123);
        }

        $buss = tripModel::join('c_ng_g_x', 'c_ng_g_x.idchuyen', '=', 'chuyen.idchuyen')
            ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
            ->where('idtuyen', $data['idtuyen'])->where('idgio', $data['idgio'])->where('idngay', $data['idngay'])->get();
        // dd($buss);
        // $user = clientModel::join('nguoidung', 'nguoidung.idnd', '=', 'khachhang.idnd')->get();
        // dd($user);
        $route = tripModel::join('tuyen', 'chuyen.idtuyen', '=', 'tuyen.idtuyen')->where('tuyen.idtuyen', $data['idtuyen'])->distinct()->first();
        // dd($route['giave']);

        // return redirect()->action([historyClientController::class, 'showBusTicket'])->with(array(
        //     'buss' => $buss,
        //     'route' => $route
        // ));
        // dd($data);

        return view('admin.ticket.showBus', compact('buss', 'route'));
    }

    public function findRoute(Request $request)
    {
        // echo('troi');
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "route") {
                $times = tripModel::join('c_ng_g_x', 'c_ng_g_x.idchuyen', '=', 'chuyen.idchuyen')
                    ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
                    ->where('idtuyen', $data['ma'])->get();
                $output .= '<option value ="">--- Chọn ---</option>';
                foreach ($times as $key => $time) {
                    $output .= '<option value ="' . $time->idgio . '">' . $time->tg_xuatben . '</option>';
                }
            } else if ($data['action'] == "time") {
                // echo (123); 
                $days = timeModel::join('c_ng_g_x', 'gio.idgio', '=', 'c_ng_g_x.idgio')
                    ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
                    ->where('gio.idgio', $data['ma'])->get();
                $output .= '<option value ="">--- Chọn ---</option>';
                foreach ($days as $key => $day) {
                    $output .= '<option value ="' . $day->idngay . '">' . $day->ngaychay . '</option>';
                }
            }
            echo ($output);
        }
    }
    public function seat(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action']) {
                $check = tripDayTimeBusModel::join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')->find($data['ma']);
                // $check = busModel::find();

                // echo ($check['idxe']);
                $buss = busModel::join('ghe', 'xe.idxe', '=', 'ghe.idxe')->where('ghe.idxe', $check['idxe'])->get();
                // foreach ($check as $key => $bus) {
                //     echo ($bus['idxe']);
                // }
                if ($check['idlx'] == 1) {
                    $output .= '<div class="col-6"><div class="row">';
                    foreach ($buss as $key => $bus) {
                        if ($key < 10) {

                            if ($bus['datcho'] == 1) {
                                $output .= '
                                <div class=" bg-danger" 
                                style="border-radius: 15px 15px 0px 0px;
                                    border: 2px solid black;
                                    text-align: center;
                                    padding-top:10px;
                                    margin-right:3px;
                                    margin-bottom:3px;
                                    width: 35%;
                                    height: 50px;
                                    flex: 0 0 auto;"><b style=" border-bottom: 2px solid #000; padding-bottom:3px;width: 100%">' . $bus['maghe'] . '</b></div>
                                        ';
                            } else {
                                $output .= '
                            <div class=" bg-light" 
                            style="border-radius: 15px 15px 0px 0px;
                                border: 2px solid black;
                                text-align: center;
                                padding-top:10px;
                                margin-right:3px;
                                margin-bottom:3px;
                                width: 35%;
                                height: 50px;
                                flex: 0 0 auto;"><b style=" border-bottom: 2px solid #000; padding-bottom:3px;width: 100%">' . $bus['maghe'] . '</b></div>
                                    ';
                            }
                        }



                        // $output .= '<option value ="' . $district->idqh . '">' . $district->name_district . '</option>';
                    }
                    $output .= ' </div> </div>';

                    $output .= '<div class="col-6"><div class="row">';
                    foreach ($buss as $key => $bus) {
                        // echo($key);
                        if ($key >= 10) {
                            if ($bus['datcho'] == 1) {
                                $output .= '
                                <div class=" bg-danger " 
                                style="border-radius: 15px 15px 0px 0px;
                                    border: 2px solid black;
                                    text-align: center;
                                    padding-top:10px;
                                    margin-right:2px;
                                    margin-bottom:3px;
                                    width: 35%;
                                    height: 50px;
                                    flex: 0 0 auto;"><b style=" border-bottom: 2px solid #000; padding-bottom:3px;width: 100%">' . $bus['maghe'] . '</b></div>
                                        ';
                            } else {
                                $output .= '
                            <div class=" bg-light " 
                            style="border-radius: 15px 15px 0px 0px;
                                border: 2px solid black;
                                text-align: center;
                                padding-top:10px;
                                margin-right:2px;
                                margin-bottom:3px;
                                width: 35%;
                                height: 50px;
                                flex: 0 0 auto;"><b style=" border-bottom: 2px solid #000; padding-bottom:3px;width: 100%">' . $bus['maghe'] . '</b></div>
                                    ';
                            }
                        }

                        // $output .= '<option value ="' . $district->idqh . '">' . $district->name_district . '</option>';
                    }
                    $output .= ' </div> </div>';
                }

                // ghe ngoi
                else {
                    foreach ($buss as $key => $bus) {
                        if ($bus['datcho'] == 1) {
                            if (($key % 2) == 1) {
                                $output .= '
                                    <div class=" bg-danger " 
                                    style="border-radius: 15px 15px 0px 0px;
                                        border: 2px solid black;
                                        text-align: center;
                                        padding-top:10px;
                                        margin-right:25px;
                                        width: 20%;
                                        height: 50px;
                                        flex: 0 0 auto;"><b style=" border-bottom: 2px solid #000; padding-bottom:3px;width: 100%">' . $bus['maghe'] . '</b></div>';
                            } else {
                                $output .= '
                                    <div class=" bg-danger " 
                                    style="border-radius: 15px 15px 0px 0px;
                                        border: 2px solid black;
                                        text-align: center;
                                        padding-top:10px;
                                        margin-bottom:2px;
                                        margin-right:2px;
                                        width: 20%;
                                        height: 50px;
                                        flex: 0 0 auto;"><b style=" border-bottom: 2px solid #000; padding-bottom:3px;width: 100%">' . $bus['maghe'] . '</b></div>';
                            }
                        } else if ($bus['datcho'] == 0) {
                            if (($key % 2) == 1) {
                                $output .= '
                                        <div class="bg-light " 
                                        style="border-radius: 15px 15px 0px 0px;
                                            border: 2px solid black;
                                            text-align: center;
                                            padding-top:10px;
                                            margin-right:25px;
                                            width: 20%;
                                            height: 50px;
                                            flex: 0 0 auto;"  ><b style=" border-bottom: 2px solid #000; padding-bottom:3px;width: 100%">' . $bus['maghe'] . '</b></div> 
                                    ';
                            } else {
                                $output .= '
                                        <div class=" bg-light " 
                                        style="border-radius: 15px 15px 0px 0px;
                                                border: 2px solid black;
                                                text-align: center;
                                                padding-top:10px;
                                                margin-bottom:2px;
                                                margin-right:2px;
                                                width: 20%;
                                                height: 50px;
                                                flex: 0 0 auto;
                                                "  ><b style=" border-bottom: 2px solid #000; padding-bottom:3px;width: 100%">' . $bus['maghe'] . '</b></div> 
                                        ';
                            }
                        }

                        // $output .= '<option value ="' . $district->idqh . '">' . $district->name_district . '</option>';
                    }
                }
            }
            echo ($output);
        }
    }
    public function booking(bookingRequest $request)
    {
        $data = $request->all();
        // dd($data);

        $check = chairModel::join('c_ng_g_x', 'ghe.idxe', '=', 'c_ng_g_x.idxe')->where('id_c_ng_g_x', $data['id_c_ng_g_x'])->where('maghe', $data['maghe'])->exists();
        // $chair =  chairModel::where('idghe', $buss['idghe'])->get();

        if (!$check) {
            $error = "Vui lòng chọn chỗ ngồi phù hợp với mã ghế theo sơ đồ ghế bên cạnh!";
            return redirect()->back()->with('error', $error);
        }
        // dd($check);
        $buss = chairModel::join('c_ng_g_x', 'ghe.idxe', '=', 'c_ng_g_x.idxe')->where('id_c_ng_g_x', $data['id_c_ng_g_x'])->where('maghe', $data['maghe'])->first();

        if ($buss['datcho'] == 1) {
            $error = "Vui lòng chọn chỗ ngồi tình trạng \"trống\"!";
            return redirect()->back()->with('error', $error);
        }
        $success = "Đặt thành công!";
        $data['idghe'] = $buss['idghe'];
        $data['TTV'] = 1;
        $data['PTTT'] = 0;
        // dd($data);

        ticketModel::create($data);
        chairModel::find($buss['idghe'])->update([
            'datcho' => 1,
        ]);
        return redirect()->back()->with('success', $success);
        // return redirect('admin/ticket');
    }
}
