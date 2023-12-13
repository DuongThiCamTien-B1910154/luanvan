<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\routeModel;
use Illuminate\Support\Facades\DB;

class homeClientController extends Controller
{
    public function index()
    {

        // $routes = routeModel::join('chuyen', 'chuyen.idtuyen', '=', 'tuyen.idtuyen')
        //     ->join('c_ng_g_x', 'c_ng_g_x.idchuyen', '=', 'chuyen.idchuyen')
        //     ->join('datcho', 'datcho.id_c_ng_g_x', '=', 'c_ng_g_x.id_c_ng_g_x')
        //     ->join('nhanxet', 'nhanxet.iddc', '=', 'datcho.iddc')
        //     ->groupBy('tuyen.idtuyen')
        //     ->select('tuyen.idtuyen', 'rating', 'c_ng_g_x.id_c_ng_g_x', DB::raw('max(rating) as rating'))
        //     ->get();
        $routes = DB::table('nhanxet')
            ->join('datcho', 'datcho.iddc', '=', 'nhanxet.iddc')
            ->join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
            ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
            ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
            ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            ->groupBy('tuyen.idtuyen')
            ->select('tuyen.idtuyen','tuyen.diemKH','diemKT', 'rating','c_ng_g_x.idngay','c_ng_g_x.idgio', 'xe.idxe','xe.file_upload', DB::raw('max(rating) as rating'))
            ->get();
        // $data = $routes->get(['tuyen.idtuyen', 'rating', 'c_ng_g_x.id_c_ng_g_x']);
        // $routes = routeModel::join('chuyen', 'chuyen.idtuyen', '=', 'tuyen.idtuyen')
        //     ->join('c_ng_g_x', 'c_ng_g_x.idchuyen', '=', 'chuyen.idchuyen')
        //     ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')->get();
        // dd($routes);
        return view('client.home', compact('routes'));
    }
}
