<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\bookingRequest;
use App\Models\adminModel;
use App\Models\bankingModel;
use App\Models\chairModel;
use App\Models\clientModel;
use App\Models\routeModel;
use App\Models\statisticModel;
use App\Models\tripDayTimeBusModel;
use Illuminate\Http\Request;
use App\Models\busModel;
use App\Models\dayModel;
use App\Models\historyApproveModel;
use App\Models\orderModel;
use App\Models\statusTicketModel;
use App\Models\ticketModel;
use App\Models\timeModel;
use App\Models\tripModel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Facades\DB;
// use App\Models\adminModel;

class ticketController extends Controller
{
    public function showTicket(Request $request, $idttv)
    {
        // $this->data['title'] = "Thành viên";
        // $this->data['error'] = "Vui lòng kiểm tra lại !";
        $search = $request['search'] ?? "";

        if ($search != "") {
            // dd($search);
            // $ttv = statusTicketModel::where('idttv', $idttv)->first();
            // dd($ttv->idttv);
            // $g = $ttv->join('datcho', 'datcho.idttv', '=', $ttv->idttv);
            // $tickets = orderModel::join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
            //     ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            //     ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
            //     ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
            //     ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
            //     ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
            //     ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
            //     ->join('trangthaive', 'trangthaive.idttv', '=', 'datcho.idttv')
            //     // ->where('trangthaive', 'trangthaive.idttv','=',$idvx)
            //     ->where('sdt2', 'LIKE', "%$search%")
            //     ->orWhere('tennd2', 'LIKE', "%$search%")
            //     ->orWhere('2tentuyen', 'LIKE', "%$search%")
            //     // ->where('datcho.idttv', '!=', '4')
            //     ->where('datcho.idttv', '!=', '0')
            //     ->where('datcho.del', '!=', '1')
            //     ->where('trangthaive.idttv', $idttv)
            //     ->orderBy('datcho.created_at', 'asc')
            //     ->get();

            $tickets = DB::table('datcho')
                ->join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
                ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
                ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
                ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
                ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
                ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
                ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
                ->join('trangthaive', 'trangthaive.idttv', '=', 'datcho.idttv')
                ->join('pttt', 'pttt.idtt', '=', 'datcho.idtt')
                ->select('*')
                ->where(function ($query) use ($search) {
                    $query->where('sdt2', 'LIKE', "%$search%")
                        ->orWhere('tennd2', 'LIKE', "%$search%")
                        ->orWhere('tentuyen', 'LIKE', "%$search%");
                })
                ->where('datcho.idttv', '!=', '0')
                ->where('datcho.del', '!=', '1')
                ->where('trangthaive.idttv', $idttv)
                ->orderBy('datcho.created_at', 'desc')
                ->get();
            // dd($tickets);
        } else {
            // $tickets = ticketModel::join('datcho', 'datcho.iddc', '=', 'chitietdatcho.iddc')
            //     ->join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
            //     ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            //     ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
            //     ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
            //     ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
            //     ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
            //     ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
            //     ->orderBy('TTV', 'asc')->where('TTV', '>=', '0')->get();

            $tickets = orderModel::join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
                ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
                ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
                ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
                ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
                ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
                ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
                ->join('pttt', 'pttt.idtt', '=', 'datcho.idtt')
                ->join('trangthaive', 'trangthaive.idttv', '=', 'datcho.idttv')
                ->orderBy('datcho.created_at', 'desc')
                // ->where('datcho.idttv', '!=', '4')
                ->where('datcho.idttv', '!=', '0')
                ->where('datcho.del', '!=', '1')
                ->where('trangthaive.idttv', $idttv)
                ->get();
        }
        // $test = ticketModel::all();
        // dd($tickets);
        return view('admin.ticket.listTicket', compact('tickets', 'search'));
    }
    public function detailTicket($iddc)
    {
        // dd($iddc);
        // $ticket = chairModel::join('vexe', 'vexe.idghe', '=', 'ghe.idghe')
        //     ->join('xe', 'xe.idxe', '=', 'ghe.idxe')
        //     ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
        //     ->join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'vexe.id_c_ng_g_x')
        //     ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
        //     ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
        //     ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
        //     ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
        //     ->where('idvx', $id)->first();

        //     $seats = orderModel::join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
        //     ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
        //     ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
        //     ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
        //     ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
        //     ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
        //     ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
        //     ->where('datcho.idkh', $idkh)
        //     ->where('TTV', $ttv)->orderBy('ngaychay', 'desc')->paginate(2);
        $chairs = orderModel::join('chitietdatcho', 'chitietdatcho.iddc', '=', 'datcho.iddc')
            ->join('ghe', 'ghe.idghe', '=', 'chitietdatcho.idghe')
            ->where('datcho.iddc', $iddc)->get();
        // dd($chairs);

        // $ticket = ticketModel::join('datcho', 'datcho.iddc', '=', 'chitietdatcho.iddc')
        //     ->join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
        //     ->join('ghe', 'ghe.idxe', '=', 'c_ng_g_x.idxe')
        //     ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
        //     ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
        //     ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
        //     ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
        //     ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
        //     ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
        //     ->where('idvx', $id)->first();
        $ticket = orderModel::join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
            ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
            ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
            ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
            ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
            ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
            ->where('datcho.iddc', $iddc)->first();

        $pttts = bankingModel::get();
        return view('admin.ticket.detailTicket', compact('ticket', 'pttts', 'chairs'));
    }
    public function browseTicket($id)
    {
        // dd(12);
        orderModel::find($id)->update([
            'idttv' => 2
        ]);
        return redirect()->back();
    }

    public function deleteTicket($id)
    {
        // dd($id);
        // chairModel::find($id)->update([
        //     'datcho' => 0,
        // ]);
        // ticketModel::where('idghe', $id)->delete();
        $success = "Xóa vé thành công!";
        $data = orderModel::where('iddc', $id)->first();
        if ($data->idttv <= 2) {
            ticketModel::where('iddc', $id)->delete();
            orderModel::where('iddc', $id)->delete();
        } else {
            orderModel::where('iddc', $id)->update([
                'del' => 1
            ]);
        }

        return redirect()->back()->with('success', $success);
    }


    public function invoice($iddc)
    {
        // statistic
        $money = orderModel::where('iddc', $iddc)->first('tongtien');
        $day = orderModel::where('iddc', $iddc)
            ->join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
            ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
            ->first('ngaychay');
        $countTicket = ticketModel::where('iddc', $iddc)->count();
        $isExist = statisticModel::where('ngayxechay', $day->ngaychay)->exists();
        // dd($isExist);
        if ($isExist) {
            $sta = statisticModel::where('ngayxechay', $day->ngaychay)->first();
            statisticModel::where('ngayxechay', $day->ngaychay)->update([
                'tongtien' => $sta['tongtien']  + $money->tongtien,
                'ngayxechay' => $day->ngaychay,
                'soluongve' => $sta['soluongve'] + $countTicket,
            ]);
        } else {
            $statis['tongtien'] = $money->tongtien;
            $statis['ngayxechay'] = $day->ngaychay;
            $statis['soluongve'] = $countTicket;
            statisticModel::create($statis);
        }
        // ----------------invoice
        $idcv = Auth::guard('admin')->user()->idcv;
        $name = adminModel::join('nguoidung', 'nguoidung.idnd', 'admin.idnd')
            ->where('idcv', $idcv)->first();

        $chairs = orderModel::join('chitietdatcho', 'chitietdatcho.iddc', '=', 'datcho.iddc')
            ->join('ghe', 'ghe.idghe', '=', 'chitietdatcho.idghe')
            ->where('datcho.iddc', $iddc)
            ->get();
        $ticket =  orderModel::join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
            ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
            ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
            ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
            ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
            ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
            ->where('datcho.iddc', $iddc)->first();
        orderModel::where('iddc', $iddc)->update([
            'idttv' => 3,
        ]);
        $data['idadmin'] = $name->idadmin;
        $data['iddc'] = $iddc;
        historyApproveModel::create($data);
        // mail
        if ($ticket->idkh != null) {
            $user = clientModel::join('nguoidung', 'nguoidung.idnd', '=', 'khachhang.idnd')
                ->where('idkh', $ticket->idkh)->first();
            // $tennd = $user->tennd;
            // dd($user->tennd);
            // dd(auth('client')->user()->email);
            \Illuminate\Support\Facades\Mail::send('admin.email.sendMail', compact('name'), function ($email) use ($user) {
                $email->subject('BUSLINE');
                $email->to($user->email, $user);
            });
        }

        //  end  mail
        $html = '';
        foreach ($chairs as $chair) {
            $view = view('admin.PDF.Invoice', ['ticket' => $ticket, 'iddc' => $iddc, 'name' => $name, 'chair' => $chair]);
            $html .= $view->render();
        }
        $pdf = \PDF::loadHTML($html);
        $sheet = $pdf->setPaper('a4', 'landscape');
        return $sheet->download($iddc . '-Invoice.pdf');
        // $ticket = orderModel::join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
        //     ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
        //     ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
        //     ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
        //     ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
        //     ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
        //     ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
        //     ->where('datcho.iddc', $iddc)->first();
        // $idcv = Auth::guard('admin')->user()->idcv;
        // $name = adminModel::join('nguoidung', 'nguoidung.idnd', 'admin.idnd')
        //     ->where('idcv', $idcv)->first();
        // $chairs = orderModel::join('chitietdatcho', 'chitietdatcho.iddc', '=', 'datcho.iddc')
        //     ->join('ghe', 'ghe.idghe', '=', 'chitietdatcho.idghe')
        //     ->where('datcho.iddc', $iddc)->get();
        // $html = [];
        // foreach ($chairs as $i => $result) {
        //     $view = view('admin.PDF.Invoice', ['ticket' => $ticket, 'iddc' => $iddc, 'name' => $name]);
        //     $html[$i] = $view->render();
        // }
        // foreach ($html as $htm) {
        //     $pdf = \PDF::loadHtml($htm);
        //     $sheet = $pdf->setPaper('a4', 'landscape');
        //     $pdf->save('D:/' . $ticket['iddc'] . '.pdf');
        //     return $sheet->stream();
        // }
    }
    // khong con su dung
    public function print_convert($iddc)
    {
        $idcv = Auth::guard('admin')->user()->idcv;
        $name = adminModel::join('nguoidung', 'nguoidung.idnd', 'admin.idnd')
            ->where('idcv', $idcv)->first();
        // orderModel::where('iddc', $iddc)->update([
        //     'idadmin' => $name->idadmin,
        // ]);
        // $ticket = chairModel::join('vexe', 'vexe.idghe', '=', 'ghe.idghe')
        //     ->join('xe', 'xe.idxe', '=', 'ghe.idxe')
        //     ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
        //     ->join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'vexe.id_c_ng_g_x')
        //     ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
        //     ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
        //     ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
        //     ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
        //     ->where('idvx', $idvx)->first();
        // $ticket = ticketModel::join('datcho', 'datcho.iddc', '=', 'chitietdatcho.iddc')
        //     ->join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
        //     ->join('ghe', 'ghe.idxe', '=', 'c_ng_g_x.idxe')
        //     ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
        //     ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
        //     ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
        //     ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
        //     ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
        //     ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
        //     ->where('idvx', $iddc)->first();


        $ticket = orderModel::join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
            ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
            ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
            ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
            ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
            ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
            ->where('datcho.iddc', $iddc)->first();

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
            <div style="float: right;">Mã số: <b>' . $iddc . '</b><br>
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

        // $data = $request->all();
        // $check = tripModel::join('c_ng_g_x', 'c_ng_g_x.idchuyen', '=', 'chuyen.idchuyen')
        //     ->where('idtuyen', $data['idtuyen'])
        //     ->where('idgio', $data['idgio'])
        //     ->where('idngay', $data['idngay'])
        //     ->whereNotNull('idxe')
        //     ->exists();

        // if (!$check) {
        //     $error = "Không tìm thấy xe phù hợp!";
        //     return redirect()->back()->with('error', $error);
        // }

        // $buss = tripModel::join('c_ng_g_x', 'c_ng_g_x.idchuyen', '=', 'chuyen.idchuyen')
        //     ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
        //     ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
        //     ->where('idtuyen', $data['idtuyen'])->where('idgio', $data['idgio'])->where('idngay', $data['idngay'])->get();

        // $route = tripModel::join('tuyen', 'chuyen.idtuyen', '=', 'tuyen.idtuyen')->where('tuyen.idtuyen', $data['idtuyen'])->distinct()->first();
        $data = $request->all();
        $idtuyen = $data['idtuyen'];
        $idgio = $data['idgio'];
        $idngay  = $data['idngay'];
        $check = tripModel::join('c_ng_g_x', 'c_ng_g_x.idchuyen', '=', 'chuyen.idchuyen')
            ->where('idtuyen', $idtuyen)
            ->where('idgio', $idgio)
            ->where('idngay', $idngay)
            ->whereNotNull('idxe')
            ->exists();
        if (!$check) {
            $error = "Không tìm thấy xe phù hợp!";
            return redirect()->back()->with('error', $error);

            // return view('client.ticket.showTicket', compact('error'));
            // dd(123);
        }
        $pttts = bankingModel::get();
        $buss = tripModel::join('c_ng_g_x', 'c_ng_g_x.idchuyen', '=', 'chuyen.idchuyen')
            ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
            ->where('idtuyen', $idtuyen)->where('idgio', $idgio)->where('idngay', $idngay)->get();
        // dd($buss);
        // $user = clientModel::join('nguoidung', 'nguoidung.idnd', '=', 'khachhang.idnd')->get();
        // dd($user);
        $route = tripModel::join('tuyen', 'chuyen.idtuyen', '=', 'tuyen.idtuyen')->where('tuyen.idtuyen', $idtuyen)->distinct()->first();
        $times = timeModel::where('idgio', $idgio)->first();
        $days = dayModel::where('idngay', $idngay)->first();
        // dd($route);
        // return view('client.ticket.showBus', compact('buss', 'route', 'pttts','days','times'));
        return view('admin.ticket.showBus', compact('buss', 'route', 'pttts', 'days', 'times'));
    }

    public function findRoute(Request $request)
    {
        // echo('troi');
        // $data = $request->all();
        // if ($data['action']) {
        //     $output = '';
        //     if ($data['action'] == "route") {
        //         $times = tripModel::join('c_ng_g_x', 'c_ng_g_x.idchuyen', '=', 'chuyen.idchuyen')
        //             ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
        //             ->where('idtuyen', $data['ma'])->get();
        //         $output .= '<option value ="">--- Chọn ---</option>';
        //         foreach ($times as $key => $time) {
        //             $output .= '<option value ="' . $time->idgio . '">' . $time->tg_xuatben . '</option>';
        //         }
        //     } else if ($data['action'] == "time") {
        //         // echo (123); 
        //         $days = timeModel::join('c_ng_g_x', 'gio.idgio', '=', 'c_ng_g_x.idgio')
        //             ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
        //             ->where('gio.idgio', $data['ma'])->get();
        //         $output .= '<option value ="">--- Chọn ---</option>';
        //         foreach ($days as $key => $day) {
        //             $output .= '<option value ="' . $day->idngay . '">' . $day->ngaychay . '</option>';
        //         }
        //     }
        //     echo ($output);
        // }
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "route") {
                $times = tripModel::join('c_ng_g_x', 'c_ng_g_x.idchuyen', '=', 'chuyen.idchuyen')
                    ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
                    ->where('idtuyen', $data['ma'])->distinct(['gio.idgio', 'tg_xuatben'])->get(['gio.idgio', 'tg_xuatben']);
                $output .= '<option value ="">--- Chọn ---</option>';
                foreach ($times as $key => $time) {
                    $output .= '<option value ="' . $time->idgio . '">' . $time->tg_xuatben . '</option>';
                }
            } else if ($data['action'] == "time") {
                $today = strtotime(now()->format('Y-m-d'));

                $days = timeModel::join('c_ng_g_x', 'gio.idgio', '=', 'c_ng_g_x.idgio')
                    ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')

                    ->where('gio.idgio', $data['ma'])
                    ->distinct('ngaychay.idngay', 'ngaychay.ngaychay')
                    ->get(['ngaychay.idngay', 'ngaychay.ngaychay']);
                $output .= '<option value ="">--- Chọn ---</option>';
                foreach ($days as $key => $day) {
                    $today_get = strtotime($day->ngaychay);
                    if ($today >= $today_get)
                        $output .= '<option value ="' . $day->idngay . '">' . $day->ngaychay . '</option>';
                }
            }
            echo ($output);
        }
    }
    public function seat(Request $request)
    {

        $data = $request->all();
        // if ($data['action']) {
        $output = '';
        // if ($data['action']) {
        $c_ng_g_x = tripDayTimeBusModel::join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')->find($data['id_c_ng_g_x']);
        // $check = busModel::find();

        $buss = busModel::join('ghe', 'xe.idxe', '=', 'ghe.idxe')->where('ghe.idxe', $c_ng_g_x['idxe'])->get();
        if ($c_ng_g_x['idlx'] == 1) {
            $output .= '<div class="col-6"><div class="row">';
            foreach ($buss as $key => $bus) {
                if ($key < 10) {
                    // $isExist = ticketModel::join('datcho', 'datcho.iddc', '=', 'chitietdatcho.iddc')->where('idghe', $bus['idghe'])->where('id_c_ng_g_x', $data['id_c_ng_g_x'])->exists();
                    $isExist = ticketModel::join('datcho', 'datcho.iddc', '=', 'chitietdatcho.iddc')
                        ->where('idghe', $bus['idghe'])
                        ->where('id_c_ng_g_x', $data['id_c_ng_g_x'])
                        ->where('idttv', '!=', 0)
                        ->where('idttv', '!=', 3)
                        // ->where('idttv', '!=', 4)
                        ->exists();
                    if ($isExist) {
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
                    // $isExist = ticketModel::join('datcho', 'datcho.iddc', '=', 'chitietdatcho.iddc')->where('idghe', $bus['idghe'])->where('id_c_ng_g_x', $data['id_c_ng_g_x'])->exists();
                    $isExist = ticketModel::join('datcho', 'datcho.iddc', '=', 'chitietdatcho.iddc')
                        ->where('idghe', $bus['idghe'])
                        ->where('id_c_ng_g_x', $data['id_c_ng_g_x'])
                        ->where('idttv', '!=', 0)
                        ->where('idttv', '!=', 3)
                        // ->where('idttv', '!=', 4)
                        ->exists();
                    if ($isExist) {
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

        // giuong ngoi
        else {
            foreach ($buss as $key => $bus) {
                // $isExist = ticketModel::join('datcho', 'datcho.iddc', '=', 'chitietdatcho.iddc')->where('idghe', $bus['idghe'])->where('id_c_ng_g_x', $data['id_c_ng_g_x'])->exists();
                $isExist = ticketModel::join('datcho', 'datcho.iddc', '=', 'chitietdatcho.iddc')
                    ->where('idghe', $bus['idghe'])
                    ->where('id_c_ng_g_x', $data['id_c_ng_g_x'])
                    ->where('idttv', '!=', 0)
                    ->where('idttv', '!=', 3)
                    // ->where('idttv', '!=', 4)
                    ->exists();
                if ($isExist) {
                    if (($key % 2) == 1) {
                        $output .= '
                                    <div class=" bg-danger " 
                                    style="border-radius: 15px 15px 0px 0px;
                                        border: 2px solid black;
                                        text-align: center;
                                        padding-top:10px;
                                        margin-right:25px;
                                        width: 18%;
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
                                        width: 18%;
                                        height: 50px;
                                        flex: 0 0 auto;"><b style=" border-bottom: 2px solid #000; padding-bottom:3px;width: 100%">' . $bus['maghe'] . '</b></div>';
                    }
                } else {
                    if (($key % 2) == 1) {
                        $output .= '
                                        <div class="bg-light " 
                                        style="border-radius: 15px 15px 0px 0px;
                                            border: 2px solid black;
                                            text-align: center;
                                            padding-top:10px;
                                            margin-right:25px;
                                            width: 18%;
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
                                                width: 18%;
                                                height: 50px;
                                                flex: 0 0 auto;
                                                "  ><b style=" border-bottom: 2px solid #000; padding-bottom:3px;width: 100%">' . $bus['maghe'] . '</b></div> 
                                        ';
                    }
                }

                // $output .= '<option value ="' . $district->idqh . '">' . $district->name_district . '</option>';
            }
        }
        echo ($output);
        // }
    }
    public function check_seat(Request $request)
    {
        // $data = $request->all();

        // $output = '';

        // $c_ng_g_x = tripDayTimeBusModel::join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')->find($data['id_c_ng_g_x']);

        // $buss = busModel::join('ghe', 'xe.idxe', '=', 'ghe.idxe')->where('ghe.idxe', $c_ng_g_x['idxe'])->get();

        // if ($c_ng_g_x['idlx'] == 1) {
        //     foreach ($buss as $key => $bus) {
        //         if ($key < 10) {
        //             // $isDel = orderModel::where('idttv',)
        //             $isExist = ticketModel::join('datcho', 'datcho.iddc', '=', 'chitietdatcho.iddc')
        //                 ->where('idghe', $bus['idghe'])
        //                 ->where('id_c_ng_g_x', $data['id_c_ng_g_x'])
        //                 ->where('idttv', '!=', 0)
        //                 ->where('idttv', '!=', 3)
        //                 // ->where('idttv', '!=', 4)
        //                 ->exists();

        //             if ($isExist) {
        //                 $output .= '
        //                     <input type="checkbox" name="idghes[]"  style="width: 15px;height: 15px;" value="' . $bus['idghe'] . '" disabled/> ' . $bus['maghe'] . '&nbsp; &nbsp;&nbsp;';
        //                 if ($key + 1 < 10) {
        //                     $output .= '&nbsp;&nbsp;';
        //                 }
        //                 if (($key + 1) % 4 == 0) {
        //                     $output .= '</br>';
        //                 }
        //             } else {
        //                 $output .= '
        //                     <input type="checkbox" name="idghes[]" style="width: 15px;height: 15px;" value="' . $bus['idghe'] . '"/> ' . $bus['maghe'] . '&nbsp; &nbsp;&nbsp;';
        //                 if ($key + 1 < 10) {
        //                     $output .= '&nbsp;&nbsp;';
        //                 }
        //                 if (($key + 1) % 4 == 0) {
        //                     $output .= '</br>';
        //                 }
        //             }
        //         }
        //     }
        //     $output .= '</br>';

        //     foreach ($buss as $key => $bus) {
        //         // echo($key);
        //         if ($key >= 10) {
        //             $isExist = ticketModel::join('datcho', 'datcho.iddc', '=', 'chitietdatcho.iddc')
        //                 ->where('idghe', $bus['idghe'])
        //                 ->where('id_c_ng_g_x', $data['id_c_ng_g_x'])
        //                 ->where('idttv', '!=', 0)
        //                 ->where('idttv', '!=', 3)
        //                 // ->where('idttv', '!=', 4)
        //                 ->exists();
        //             if ($isExist) {
        //                 $output .= '
        //                     <input type="checkbox" name="idghes[]"  style="width: 15px;height: 15px;" value="' . $bus['idghe'] . '" disabled/> ' . $bus['maghe'] . '&nbsp;&nbsp;&nbsp; ';
        //                 if ($key - 10 + 1 < 10) {
        //                     $output .= '&nbsp;&nbsp;&nbsp;';
        //                 }
        //                 if (($key + 1) % 4 == 0) {
        //                     $output .= '</br>';
        //                 }
        //             } else {
        //                 $output .= '
        //                     <input type="checkbox" name="idghes[]" style="width: 15px;height: 15px;" value="' . $bus['idghe'] . '"/> ' . $bus['maghe'] . '&nbsp;&nbsp;&nbsp;';
        //                 if ($key - 10 + 1 < 10) {
        //                     $output .= '&nbsp;&nbsp;&nbsp;';
        //                 }
        //                 if (($key + 1) % 4 == 0) {
        //                     $output .= '</br>';
        //                 }
        //             }
        //         }

        //         // $output .= '<option value ="' . $district->idqh . '">' . $district->name_district . '</option>';
        //     }
        // }

        // // giuong ngoi
        // else {
        //     foreach ($buss as $key => $bus) {
        //         $isExist = ticketModel::join('datcho', 'datcho.iddc', '=', 'chitietdatcho.iddc')
        //             ->where('idghe', $bus['idghe'])
        //             ->where('id_c_ng_g_x', $data['id_c_ng_g_x'])
        //             ->where('idttv', '!=', 0)
        //             ->where('idttv', '!=', 3)
        //             // ->where('del', '!=', 1)
        //             ->exists();

        //         if ($isExist) {
        //             $output .= '
        //                 <input type="checkbox" name="idghes[]"  style="width: 15px;height: 15px;" value="' . $bus['idghe'] . '" disabled/> ' . $bus['maghe'] . '&nbsp; &nbsp;&nbsp;';
        //             if ($key + 1 < 10) {
        //                 $output .= '&nbsp;&nbsp;';
        //             }
        //             if (($key + 1) % 4 == 0) {
        //                 $output .= '</br>';
        //             }
        //         } else {
        //             $output .= '
        //                 <input type="checkbox" name="idghes[]" style="width: 15px;height: 15px;" value="' . $bus['idghe'] . '"/> ' . $bus['maghe'] . '&nbsp; &nbsp;&nbsp;';
        //             if ($key + 1 < 10) {
        //                 $output .= '&nbsp;&nbsp;';
        //             }
        //             if (($key + 1) % 4 == 0) {
        //                 $output .= '</br>';
        //             }
        //         }

        //         // $output .= '<option value ="' . $district->idqh . '">' . $district->name_district . '</option>';
        //     }
        // }
        // // }
        // echo ($output);
        // echo ("tientien0");
        // }
        $data = $request->all();

        $output = '';

        $c_ng_g_x = tripDayTimeBusModel::join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')->find($data['id_c_ng_g_x']);

        $buss = busModel::join('ghe', 'xe.idxe', '=', 'ghe.idxe')->where('ghe.idxe', $c_ng_g_x['idxe'])->get();

        if ($c_ng_g_x['idlx'] == 1) {
            foreach ($buss as $key => $bus) {
                if ($key < 10) {
                    // $isDel = orderModel::where('idttv',)
                    $isExist = ticketModel::join('datcho', 'datcho.iddc', '=', 'chitietdatcho.iddc')
                        ->where('idghe', $bus['idghe'])
                        ->where('id_c_ng_g_x', $data['id_c_ng_g_x'])
                        ->where('idttv', '!=', 0)
                        ->where('idttv', '!=', 3)
                        // ->where('idttv', '!=', 4)
                        ->exists();

                    if ($isExist) {
                        // del disabled
                        $output .= '
                        <i style="width: 20px;height: 15px;" class="fa-solid fa-rectangle-xmark"></i>' . $bus['maghe'] . '&nbsp; &nbsp;';
                        if ($key + 1 < 10) {
                            $output .= '&nbsp;&nbsp;';
                        }
                        if (($key + 1) % 4 == 0) {
                            $output .= '</br>';
                        }
                    } else {
                        $output .= '
                            <input type="checkbox" name="idghes[]" style="width: 15px;height: 15px;" value="' . $bus['idghe'] . '"/> ' . $bus['maghe'] . '&nbsp; &nbsp;&nbsp;';
                        if ($key + 1 < 10) {
                            $output .= '&nbsp;&nbsp;';
                        }
                        if (($key + 1) % 4 == 0) {
                            $output .= '</br>';
                        }
                    }
                }
            }
            $output .= '</br>';

            foreach ($buss as $key => $bus) {
                // echo($key);
                if ($key >= 10) {
                    $isExist = ticketModel::join('datcho', 'datcho.iddc', '=', 'chitietdatcho.iddc')
                        ->where('idghe', $bus['idghe'])
                        ->where('id_c_ng_g_x', $data['id_c_ng_g_x'])
                        ->where('idttv', '!=', 0)
                        ->where('idttv', '!=', 3)
                        // ->where('idttv', '!=', 4)
                        ->exists();
                    if ($isExist) {
                        // del disabled
                        $output .= '
                        <i style="width: 20px;height: 15px;" class="fa-solid fa-rectangle-xmark"></i>' . $bus['maghe'] . '&nbsp; &nbsp;';
                        if ($key - 10 + 1 < 10) {
                            $output .= '&nbsp;&nbsp;&nbsp;';
                        }
                        if (($key + 1) % 4 == 0) {
                            $output .= '</br>';
                        }
                    } else {
                        $output .= '
                            <input type="checkbox" name="idghes[]" style="width: 15px;height: 15px;" value="' . $bus['idghe'] . '"/> ' . $bus['maghe'] . '&nbsp;&nbsp;&nbsp;';
                        if ($key - 10 + 1 < 10) {
                            $output .= '&nbsp;&nbsp;&nbsp;';
                        }
                        if (($key + 1) % 4 == 0) {
                            $output .= '</br>';
                        }
                    }
                }

                // $output .= '<option value ="' . $district->idqh . '">' . $district->name_district . '</option>';
            }
        }

        // giuong ngoi
        else {
            foreach ($buss as $key => $bus) {
                $isExist = ticketModel::join('datcho', 'datcho.iddc', '=', 'chitietdatcho.iddc')
                    ->where('idghe', $bus['idghe'])
                    ->where('id_c_ng_g_x', $data['id_c_ng_g_x'])
                    ->where('idttv', '!=', 0)
                    ->where('idttv', '!=', 3)
                    // ->where('del', '!=', 1)
                    ->exists();

                if ($isExist) {
                    // del disabled
                    $output .= '
                    <i style="width: 20px;height: 15px;" class="fa-solid fa-rectangle-xmark"></i>' . $bus['maghe'] . '&nbsp; &nbsp;
                        ';
                    if ($key + 1 < 10) {
                        $output .= '&nbsp;&nbsp;';
                    } else {
                        $output .= '';
                    }
                    if (($key + 1) % 4 == 0) {
                        $output .= '</br>';
                    }
                } else {
                    $output .= '
                        <input type="checkbox" name="idghes[]" style="width: 15px;height: 15px;" value="' . $bus['idghe'] . '"/> ' . $bus['maghe'] . '&nbsp; &nbsp;&nbsp;';
                    if ($key + 1 < 10) {
                        $output .= '&nbsp;&nbsp;';
                    }
                    if (($key + 1) % 4 == 0) {
                        $output .= '</br>';
                    }
                }

                // $output .= '<option value ="' . $district->idqh . '">' . $district->name_district . '</option>';
            }
        }
        // }
        echo ($output);
        // echo ("tientien0");
        // }
    }
    public function booking(bookingRequest $request)
    {
        $data = $request->all();
        // // dd($data);

        // $check = chairModel::join('c_ng_g_x', 'ghe.idxe', '=', 'c_ng_g_x.idxe')->where('id_c_ng_g_x', $data['id_c_ng_g_x'])->where('maghe', $data['maghe'])->exists();
        // // $chair =  chairModel::where('idghe', $buss['idghe'])->get();

        // if (!$check) {
        //     $error = "Vui lòng chọn chỗ ngồi phù hợp với mã ghế theo sơ đồ ghế bên cạnh!";
        //     return redirect()->back()->with('error', $error);
        // }
        // // dd($check);
        // $buss = chairModel::join('c_ng_g_x', 'ghe.idxe', '=', 'c_ng_g_x.idxe')->where('id_c_ng_g_x', $data['id_c_ng_g_x'])->where('maghe', $data['maghe'])->first();

        // if ($buss['datcho'] == 1) {
        //     $error = "Vui lòng chọn chỗ ngồi tình trạng \"trống\"!";
        //     return redirect()->back()->with('error', $error);
        // }
        $success = "Đặt vé thành công!";
        // $data['idghe'] = $buss['idghe'];
        // $data['TTV'] = 1;
        // $data['PTTT'] = 0;

        // // dd($data);

        // ticketModel::create($data);
        // chairModel::find($buss['idghe'])->update([
        //     'datcho' => 1,
        // ]);
        // $data['idghe'] = $buss['idghe'];
        // $data['idttv'] = 1;
        // orderModel::create($data);
        // $iddc = orderModel::get()->last();
        // $data['iddc'] = $iddc->iddc;
        // // dd($data);
        // ticketModel::create($data);
        $data['idttv'] = 1;
        $money = 0;
        foreach ($data['idghes'] as $checkbox) {
            $money++;
        }
        $data['tongtien'] = $money * $data['giave'];
        $data['del'] = 0;
        orderModel::create($data);
        $iddc = orderModel::get()->last();
        $data['iddc'] = $iddc->iddc;
        // dd($data);
        foreach ($data['idghes'] as $checkbox) {
            $data['idghe'] = $checkbox;
            ticketModel::create($data);
        }

        return redirect()->back()->with('success', $success);
    }
}
