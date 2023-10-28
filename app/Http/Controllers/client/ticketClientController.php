<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\bookingRequest;
use App\Http\Requests\client\ticketClientRequest;
use App\Models\bankingModel;
use App\Models\routeModel;
use Exception;
use Illuminate\Http\Request;
use App\Models\busModel;
use App\Models\chairModel;
use App\Models\clientModel;
use App\Models\dayModel;
use App\Models\orderModel;
use App\Models\ratingModel;
use App\Models\ticketModel;
use App\Models\timeModel;
use App\Models\tripDayTimeBusModel;
use App\Models\tripModel;
use Mail;
// use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ticketClientController extends Controller
{

    public function showTicket()
    {
        $routes = routeModel::all();
        // $times = timeModel::all();
        // $days = dayModel::all();
        // dd($days);
        return view('client.ticket.showTicket', compact('routes'));
    }



    public function findBus(Request $request, $idtuyen = null, $idgio = null, $idngay = null)
    {

        $data = $request->all();
        $idtuyen = $data['idtuyen'] ?? $idtuyen;
        $idgio = $data['idgio'] ?? $idgio;
        $idngay  = $data['idngay'] ?? $idngay;
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
        $times = timeModel::where('idgio',$idgio)->first();
        $days = dayModel::where('idngay',$idngay)->first();
        // dd($route);
        return view('client.ticket.showBus', compact('buss', 'route', 'pttts','days','times'));
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
        // foreach ($check as $key => $bus) {
        //     echo ($bus['idxe']);
        // }
        // $isExist = orderModel::where('idghe',19)->exists();
        // echo ($isExist);
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
        // }
        echo ($output);
        // }
    }

    public function check_seat(Request $request)
    {
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
                        $output .= '
                            <input type="checkbox" name="idghes[]"  style="width: 15px;height: 15px;" value="' . $bus['idghe'] . '" disabled/> ' . $bus['maghe'] . '&nbsp; &nbsp;&nbsp;';
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
                        $output .= '
                            <input type="checkbox" name="idghes[]"  style="width: 15px;height: 15px;" value="' . $bus['idghe'] . '" disabled/> ' . $bus['maghe'] . '&nbsp;&nbsp;&nbsp; ';
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
                    $output .= '
                        <input type="checkbox" name="idghes[]"  style="width: 15px;height: 15px;" value="' . $bus['idghe'] . '" disabled/> ' . $bus['maghe'] . '&nbsp; &nbsp;&nbsp;';
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
        // dd($data);
        foreach ($data['idghes'] as $checkbox) {
            $data['idghe'] = $checkbox;
            $isExist = ticketModel::join('datcho', 'datcho.iddc', '=', 'chitietdatcho.iddc')
                ->where('idghe', $checkbox)
                ->where('id_c_ng_g_x', $data['id_c_ng_g_x'])
                ->where('idttv', '!=', 0)
                ->where('idttv', '!=', 3)
                // ->where('idttv', '!=', 4)
                ->exists();
            if ($isExist) {
                $error = "Vui lòng chọn mã ghế tình trạng \"trống\"!";
                return redirect()->back()->with('error', $error);
            }
        }
        // $isExist = ticketModel::join('datcho', 'datcho.iddc', '=', 'chitietdatcho.iddc')
        //     ->where('idghe', $bus['idghe'])
        //     ->where('id_c_ng_g_x', $data['id_c_ng_g_x'])
        //     ->where('idttv', '!=', 0)
        //     ->where('idttv', '!=', 3)
        //     ->where('idttv', '!=', 4)
        //     ->exists();
        // $check = chairModel::join('c_ng_g_x', 'ghe.idxe', '=', 'c_ng_g_x.idxe')->where('id_c_ng_g_x', $data['id_c_ng_g_x'])->where('maghe', $data['maghe'])->exists();
        // if (!$check) {
        //     $error = "Vui lòng điền chỗ ngồi phù hợp với mã ghế theo sơ đồ ghế bên cạnh!";
        //     return redirect()->back()->with('error', $error);
        // }
        // $buss = chairModel::join('c_ng_g_x', 'ghe.idxe', '=', 'c_ng_g_x.idxe')->where('id_c_ng_g_x', $data['id_c_ng_g_x'])->where('maghe', $data['maghe'])->first();
        // dd($buss);
        // $isExist = orderModel::where('idghe', $buss['idghe'])->where('id_c_ng_g_x', $data['id_c_ng_g_x'])->exists();


        if ($data['idtt'] == 0) {
            if (!auth('client')->user()) {
                $success = "Chúng tôi sẽ gọi đến số điện thoại của quý khách để xác nhận!";

                // $data['idghe'] = $buss['idghe'];
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
            } else {
                $user = clientModel::join('nguoidung', 'nguoidung.idnd', '=', 'khachhang.idnd')
                    ->where('idkh', auth('client')->user()->idkh)->first();
                $name = $user->tennd;
                // dd(auth('client')->user()->email);
                \Illuminate\Support\Facades\Mail::send('client.email.sendMail', compact('name'), function ($email) use ($name) {
                    $email->subject('BUSLINE');
                    $email->to(auth('client')->user()->email, $name);
                });

                $data['idkh'] = auth('client')->user()->idkh;
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
                // dd("asd");
                return redirect('client/history/1');
            }
        } elseif ($data['idtt'] == 2) {

            Session::put('data', $data);
            // gia quy doi khong dung vi so nhieu lan test het tien
            $giave = round($data['giave'] / 220000000, 2);
            // dd($giave);
            return redirect()->route('momoPay', ['giave' => $giave]);
        } else {
            Session::put('data', $data);
            // gia quy doi khong dung vi so nhieu lan test het tien
            $giave = round($data['giave'] / 220000000, 2);
            // dd($giave);
            return redirect()->route('processTransaction', ['giave' => $giave]);
        }
    }


    public function findRoute(Request $request)
    {
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
                $days = timeModel::join('c_ng_g_x', 'gio.idgio', '=', 'c_ng_g_x.idgio')
                    ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
                    ->where('gio.idgio', $data['ma'])->distinct('ngaychay.idngay', 'ngaychay.ngaychay')->get(['ngaychay.idngay', 'ngaychay.ngaychay']);
                $output .= '<option value ="">--- Chọn ---</option>';
                foreach ($days as $key => $day) {
                    $output .= '<option value ="' . $day->idngay . '">' . $day->ngaychay . '</option>';
                }
            }
            echo ($output);
        }
    }
}
