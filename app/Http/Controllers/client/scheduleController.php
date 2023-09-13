<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\adminModel;
use Illuminate\Http\Request;
use App\Models\routeModel;
use App\Models\tripModel;
use App\Models\busModel;

class scheduleController extends Controller
{
    public function schedule()
    {
        $diemKHs = routeModel::distinct()->get('diemKH');
        // dd($diemKHs);

        $routes = routeModel::all();
        return view('client.schedule.showSchedule', compact('routes', 'diemKHs'));
    }
    public function timeSchedule($id)
    {
        // return 123;
        $buss = busModel::all();
        $routes = routeModel::find($id);
        // dd($diemKH['diemKH']);
        // $trips = tripModel::where('idtuyen', $id)->get();
        $trips = tripModel::join('admin', 'admin.idadmin', '=', 'chuyen.idadmin')
            ->join('c_ng_g_x', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
            ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
            ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
            ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            ->where('idtuyen', $id)->get();
        $admins = adminModel::join('nguoidung', 'admin.idnd', '=', 'nguoidung.idnd')->get();
        // dd($admins);
        return view('client/schedule/timeSchedule', compact('trips', 'routes', 'buss','admins'));
    }
}
