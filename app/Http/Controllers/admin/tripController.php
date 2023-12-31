<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\tripRequest;
use App\Models\adminModel;
use App\Models\busModel;
use App\Models\dayModel;
use App\Models\routeModel;
use App\Models\tripDayTimeBusModel;
use App\Models\tripModel;
use App\Models\timeModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Termwind\Components\Dd;

class tripController extends Controller
{
    // hiện function showTrip đang không được sử dụng
    public function showTrip(Request $request)
    {
        $search = $request['search'] ?? "";
        if ($search != "") {

            $datas = tripModel::join('admin', 'admin.idadmin', '=', 'chuyen.idadmin')
                ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
                ->join('nguoidung', 'nguoidung.idnd', '=', 'admin.idnd')
                ->join('c_ng_g_x', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
                ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
                ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
                ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
                ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
                ->where('tennd', 'LIKE', "%$search%")->orwhere('tentuyen', 'LIKE', "%$search%")->orderBy('tuyen.idtuyen')->get();
        } else {
            $datas = tripModel::join('admin', 'admin.idadmin', '=', 'chuyen.idadmin')
                ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
                ->join('nguoidung', 'nguoidung.idnd', '=', 'admin.idnd')
                ->join('c_ng_g_x', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
                ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
                ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
                ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
                ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
                ->orderBy('tuyen.idtuyen')->orderBy('ngaychay.ngaychay')->get();
        }
        // $users = adminModel::join('chucvu', 'admin.idcv', '=', 'chucvu.idcv')
        //     ->get('admin.*');

        // $trips = tripModel::join('ngaychay', 'ngaychay.idngay', '=', 'chuyen.idngay')
        //     ->join('gio', 'gio.idgio', '=', 'ngaychay.idgio')
        //     ->get();
        // dd($datas);
        // $datas = tripModel::join('admin', 'admin.idnd', '=', 'chuyen.idnd');
        return view('admin.trip.listTrip', compact('datas', 'search'));
    }
    public function showFormAddTrip()
    {
        // $users = User::join('admin', 'nguoidung.idnd', '=', 'admin.idnd')
        //     ->get('nguoidung.*', 'admin.*');
        $routes = routeModel::all();

        $buss = busModel::join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')->get();
        // dd($buss);

        $isDrivers = tripModel::join('c_ng_g_x', 'c_ng_g_x.idchuyen', '=', 'chuyen.idchuyen')
            ->distinct('chuyen.idadmin', 'c_ng_g_x.idgio')->get(['chuyen.idadmin', 'c_ng_g_x.idgio']);
        $idadmin = [];
        foreach ($isDrivers as $isDriver) {
            $idadmin[] = $isDriver->idadmin;
        }
        $drivers = adminModel::where('idcv', 4)
            ->whereNotIn('idadmin', $idadmin)->get();
        // dd($driver);
        return view('admin.trip.addTrip', compact('routes', 'buss', 'drivers'));
    }
    public function showBusRunAdd(Request $request)
    {
        $data = $request->all();
        $date = dayModel::where('ngaychay', $data['dateRun'])->first();

        $isBusRuns = tripDayTimeBusModel::join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            ->where('c_ng_g_x.idngay', $date->idngay)
            ->distinct('xe.idxe')->get(['xe.idxe']);
        $idxe = [];
        foreach ($isBusRuns as $isBusRun) {
            $idxe[] = $isBusRun->idxe;
        }
        $buss = busModel::join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
            ->whereNotIn('idxe', $idxe)->get();
        $output = '';
        $output .= '<option value ="">--- Chọn ---</option>';
        foreach ($buss as $key => $bus) {
            $output .= '<option value ="' . $bus->idxe . '">' . $bus->bienso . ' - ' . $bus->tenloai . '</option>';
        }
        echo ($output);
    }
    public function showBusRunEdit(Request $request)
    {
        $data = $request->all();
        // khong hien thi cac xe dang chay vao ngay dang focus
        $date = dayModel::where('ngaychay', $data['dateRun'])->first();
        $isBusRuns = tripDayTimeBusModel::join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            ->where('c_ng_g_x.idngay', $date->idngay)
            ->distinct('xe.idxe')->get(['xe.idxe']);
        $idxe = [];
        foreach ($isBusRuns as $isBusRun) {
            $idxe[] = $isBusRun->idxe;
        }


        $buss = busModel::join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
            ->whereNotIn('idxe', $idxe)->get();
        // dd($buss);
        $output = '';
        $output .= '<option value ="">--- Chọn ---</option>';
        foreach ($buss as $key => $bus) {
            $output .= '<option value ="' . $bus->idxe . '">' . $bus->bienso . ' - ' . $bus->tenloai . '</option>';
        }
    }
    public function addTrip(tripRequest $request)
    {
        $success = "Thêm chuyến xe thành công!";
        $input = $request->all();
        // dd($input);

        $temp = timeModel::where('tg_xuatben', '=', $input['tg_xuatben'])->exists();
        if ($temp) {
            $time = timeModel::where('tg_xuatben', '=', $input['tg_xuatben'])->first();
        } else {
            timeModel::create($input);
            $time = timeModel::all()->last();
        }

        $input['idgio'] = $time->idgio;


        $temp = dayModel::where('ngaychay', '=', $input['ngaychay'])->exists();

        if ($temp) {
            $day = dayModel::where('ngaychay', '=', $input['ngaychay'])->first();
        } else {
            dayModel::create($input);
            $day = dayModel::all()->last();
        }
        $input['idngay'] = $day->idngay;

        tripModel::create($input);
        $trip = tripModel::get()->last();
        // dd($trip);
        $input['idchuyen'] = $trip->idchuyen;
        tripDayTimeBusModel::create($input);
        return redirect()->back()->with('success', $success);
    }
    public function addTripAuto(Request $request)
    {
        // tripDayTimeBusModel::getQuery()->delete();
        // tripModel::getQuery()->delete();
        $dateStart = now()->startOfWeek()->format('Y-m-d');
        $dateEnd = now()->endOfWeek()->format('Y-m-d');
        $success = "Cập nhật thành công.";
        $trips = tripModel::join('admin', 'admin.idadmin', '=', 'chuyen.idadmin')
            ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
            ->join('nguoidung', 'nguoidung.idnd', '=', 'admin.idnd')
            ->join('c_ng_g_x', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
            ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
            ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
            ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
            ->groupBy('chuyen.idadmin')
            ->get();
        dd($trips);
        foreach ($trips as $key => $trip) {
            while (($dateStart) <=  ($dateEnd)) {
                $data['_token'] = $request->session()->token();
                $data['idtuyen'] = $trip->idtuyen;
                $data['idxe'] = $trip->idxe;
                $data['tg_xuatben'] = $trip->tg_xuatben;
                $data['ngaychay'] = $dateStart;
                $data['idadmin'] =  $trip->idadmin;
                $data['idgio'] =  $trip->idgio;
                // $data['idngay'] =  $trip->idngay;
                // dd($trip);

                $temp = timeModel::where('tg_xuatben', '=', $data['tg_xuatben'])->exists();
                if ($temp) {
                    $time = timeModel::where('tg_xuatben', '=', $data['tg_xuatben'])->first();
                } else {
                    timeModel::create($data);
                    $time = timeModel::all()->last();
                }
                $data['idgio'] = $time->idgio;

                $temp = dayModel::where('ngaychay', '=', $data['ngaychay'])->exists();

                if ($temp) {
                    $day = dayModel::where('ngaychay', '=', $data['ngaychay'])->first();
                } else {
                    dayModel::create($data);
                    $day = dayModel::all()->last();
                }
                $data['idngay'] = $day->idngay;
                // dd($data['idngay']);
                tripModel::create($data);

                // tripModel::create($data);
                $chuyen = tripModel::get()->last();
                $data['idchuyen'] = $chuyen->idchuyen;
                tripDayTimeBusModel::create($data);
                $data = [];
                $dateStart = date('Y-m-d', strtotime($dateStart . ' +1 day'));
            }
        }
        // dd("hasdf");
        return redirect()->action([tripController::class, 'showTrip'])->with('success', $success);
    }
    public function showFormEdit($id)
    {
        // $users = adminModel::join('chucvu', 'admin.idcv', '=', 'chucvu.idcv')
        //     ->get('admin.*');
        $data = tripModel::join('admin', 'admin.idadmin', '=', 'chuyen.idadmin')
            ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
            ->join('nguoidung', 'nguoidung.idnd', '=', 'admin.idnd')
            ->join('c_ng_g_x', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
            ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
            ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
            ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            ->find($id);
        $routes = routeModel::all();
        // $buss = busModel::all();
        $buss = busModel::join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')->get();
        $isBusRuns = tripDayTimeBusModel::join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            ->distinct('xe.idxe')->get(['xe.idxe']);
        $idxe = [];
        foreach ($isBusRuns as $isBusRun) {
            $idxe[] = $isBusRun->idxe;
        }
        $busRunEdits = busModel::join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
            ->whereNotIn('idxe', $idxe)->get();
        $isDrivers = tripModel::join('c_ng_g_x', 'c_ng_g_x.idchuyen', '=', 'chuyen.idchuyen')
            ->distinct('chuyen.idadmin', 'c_ng_g_x.idgio')->get(['chuyen.idadmin', 'c_ng_g_x.idgio']);
        $idadmin = [];
        foreach ($isDrivers as $isDriver) {
            $idadmin[] = $isDriver->idadmin;
        }
        $drivers = adminModel::where('idcv', 4)
            ->whereNotIn('idadmin', $idadmin)->get();
        // $trip = tripModel::find($id);
        // dd($routes);
        return view('admin.trip.editTrip', compact('routes', 'buss', 'data', 'drivers', 'busRunEdits'));
    }

    public function editTrip(tripRequest $request, $id)
    {
        // dd($request->all());
        $success = "Cập nhật thành công.";
        $input = $request->all();

        $data = tripModel::join('admin', 'admin.idadmin', '=', 'chuyen.idadmin')
            ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
            ->join('nguoidung', 'nguoidung.idnd', '=', 'admin.idnd')
            ->join('c_ng_g_x', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
            ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
            ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
            ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            ->find($id);
        // dd($data->idgio);

        $temp = timeModel::where('tg_xuatben', '=', $input['tg_xuatben'])->exists();
        if ($temp) {
            $time = timeModel::where('tg_xuatben', '=', $input['tg_xuatben'])->first();
            $input['idgio'] = $time->idgio;
            tripDayTimeBusModel::find($data->id_c_ng_g_x)->update($input);
        } else {
            timeModel::create($input);
            $time = timeModel::get()->last();

            $input['idgio'] = $time->idgio;
            tripDayTimeBusModel::find($data->id_c_ng_g_x)->update($input);
        }



        $temp = dayModel::where('ngaychay', '=', $input['ngaychay'])->exists();
        if ($temp) {
            $day = dayModel::where('ngaychay', '=', $input['ngaychay'])->first();
            $input['idngay'] = $day->idngay;
            tripDayTimeBusModel::find($data->id_c_ng_g_x)->update($input);
        } else {
            dayModel::create($input);
            $day = dayModel::get()->last();

            $input['idngay'] = $day->idngay;
            tripDayTimeBusModel::find($data->id_c_ng_g_x)->update($input);
        }

        // dd($input);
        // $data = tripModel::find($id);

        // $data->updated($input);
        tripModel::find($id)->update($input);
        $trip = tripModel::find($id);
        // tripModel::update($id, $input);
        // dd($trip);
        // $data = tripModel::find($id);
        // $data->idtuyen = $request->idtuyen;
        // $data->idadmin = $request->idadmin;
        // $data->idxe = $request->idxe;
        // $data->tg_xuatben = $request->tg_xuatben;
        // $data->tg_den = $request->tg_den;
        // $data->ngaychay = $request->ngaychay;
        // $data->save();
        // return view('admin.users.listUser')->with('success', $success);
        return redirect()->action([tripController::class, 'showTrip'])->with('success', $success);
    }
    public function deleteTrip($id)
    {
        $success = "Xóa thành công.";
        tripDayTimeBusModel::where('idchuyen', $id)->delete();
        // dd(123);
        $data = tripModel::find($id)->delete();
        return redirect()->action([tripController::class, 'showTrip'])->with('success', $success);
    }
    public function viewRate($idchuyen = null, $idxe = null, $idngay = null)
    {
        $total_rating = 0;
        $count = tripDayTimeBusModel::join('datcho', 'datcho.id_c_ng_g_x', '=', 'c_ng_g_x.id_c_ng_g_x')
            ->join('nhanxet', 'nhanxet.iddc', '=', 'datcho.iddc')
            ->where('c_ng_g_x.idchuyen', $idchuyen)
            ->where('c_ng_g_x.idxe', $idxe)
            ->where('c_ng_g_x.idngay', $idngay)
            ->count();
        $rating = tripDayTimeBusModel::join('datcho', 'datcho.id_c_ng_g_x', '=', 'c_ng_g_x.id_c_ng_g_x')
            ->join('nhanxet', 'nhanxet.iddc', '=', 'datcho.iddc')
            ->where('c_ng_g_x.idchuyen', $idchuyen)
            ->where('c_ng_g_x.idxe', $idxe)
            ->where('c_ng_g_x.idngay', $idngay)
            ->sum('nhanxet.rating');
        $datas = tripDayTimeBusModel::join('datcho', 'datcho.id_c_ng_g_x', '=', 'c_ng_g_x.id_c_ng_g_x')
            ->join('nhanxet', 'nhanxet.iddc', '=', 'datcho.iddc')
            ->join('ngaychay','ngaychay.idngay', '=','c_ng_g_x.idngay')
            ->where('c_ng_g_x.idchuyen', $idchuyen)
            ->where('c_ng_g_x.idxe', $idxe)
            ->where('c_ng_g_x.idngay', $idngay)
            ->get();
        if ($count > 0) {
            $total_rating =  round($rating / $count, 2);
        }
        return view('admin.trip.viewRating', compact('total_rating','datas'));
    }
}
