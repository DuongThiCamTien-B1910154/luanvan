<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\orderModel;
use App\Models\statisticModel;
use App\Models\ticketModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;

class statisticController extends Controller
{
    public function statistic()
    {
        $start_day = now()->subYear()->format('Y-m-d');
        $end_day = now()->format('Y-m-d');
        $wait = orderModel::where('idttv', 1)->count();
        $approve = orderModel::where('idttv', 2)->count();
        $success = orderModel::where('idttv', 3)->count();
        // $datas['month'] = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];
        // $data = orderModel::where('idttv', 3)
        //     ->get()
        //     ->whereBetween('created_at', [$start_day, $end_day])
        //     ->groupBy(function ($data) {
        //         return Carbon::parse($data->created_at)->format('Y-m');
        //     })
        //     ->sum('tongtien');
        $start_day = now()->subYear()->format('Y-m-d');
        $end_day = now()->format('Y-m-d');

        // $datas['month'] = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];
        // $data = statisticModel::whereBetween('ngayxechay', [$start_day, $end_day])->get();

        // foreach ($data as $key => $value) {
        //     $chart[] = array(
        //         'ngayxechay' => $value->ngayxechay,
        //         'tongtien' => $value->tongtien,
        //         'soluongve' => $value->soluongve
        //     );
        // }

        // echo $datas = json_encode($chart);
        return view('admin.statistic.chart', compact('wait', 'approve', 'success'));
    }
    public function thongke()
    {

        $start_day = now()->subYear()->format('Y-m-d');
        $end_day = now()->format('Y-m-d');
        $data = statisticModel::whereBetween('ngayxechay', [$start_day, $end_day])->get();

        foreach ($data as $key => $value) {
            $chart[] = array(
                'ngayxechay' => $value->ngayxechay,
                'tongtien' => $value->tongtien,
                'soluongve' => $value->soluongve
            );
        }
        echo $datas = json_encode($chart);
        // return view('admin.statistic.chart', compact('wait', 'approve', 'success'));
    }
    public function sortStatistic(Request $request)
    {
        // $data = orderModel::where('idttv', 2)->get();
        // // dd($data);
        // foreach ($data as $key => $value) {
        //     $chart[] = array(
        //         'data_create' => $value->created_at->format('Y-m-d'),
        //         'tongtien' => $value->tongtien,
        //         'tennd' => $value->tennd2

        //     );
        // }
        // echo $data = json_encode($chart);
        $data = $request->all();
        $start_day = $data['input_froms'];
        $end_day = $data['input_tos'];
        // $end_day = now()->format('Y-m-d');

        $data = statisticModel::whereBetween('ngayxechay', [$start_day, $end_day])->get();
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $chart[] = array(
                    'ngayxechay' => $value->ngayxechay,
                    'tongtien' => $value->tongtien,
                    'soluongve' => $value->soluongve
                );
            }
            echo $data = json_encode($chart);
        } else {
            echo ("");
        }

        // echo $data;
    }
    public function profit(Request $request)
    {
        $data = $request->all();
        $start_day = $data['input_froms'];
        $end_day = $data['input_tos'];
        // $end_day = now()->format('Y-m-d');

        $profitBusMax = orderModel::join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
            ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
            ->where('idttv', '=', 3)
            ->whereBetween('ngaychay.ngaychay', [$start_day, $end_day])
            ->groupBy('bienso')
            ->get(['tongtien', 'bienso'])
            ->max();
        // $profitBusMin = orderModel::join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
        //     ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
        //     ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
        //     ->where('idttv', '=', 3)
        //     ->whereBetween('ngaychay.ngaychay', [$start_day, $end_day])
        //     ->groupBy('bienso')
        //     ->get(['tongtien', 'bienso'])
        //     ->min();

        $profitBus1 = orderModel::join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
            ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
            ->where('idttv', '=', 3)
            ->whereBetween('ngaychay.ngaychay', [$start_day, $end_day])
            ->groupBy('bienso')
            ->get('bienso');


        $profitBus2 = orderModel::join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
            ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
            ->where('idttv', '=', 3)
            ->whereBetween('ngaychay.ngaychay', [$start_day, $end_day])
            ->groupBy('xe.idxe')
            ->get('tongtien')
            ->sum('tongtien');

        $profitBus = DB::table('datcho')
            ->join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
            ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
            ->where('idttv', '=', 3)
            ->whereBetween('ngaychay.ngaychay', [$start_day, $end_day])
            ->groupBy('xe.idxe')
            ->select('bienso', DB::raw('SUM(tongtien) as tongtien'))
            ->get();
        $maxTongtien = $profitBus->max('tongtien');
        $minTongtien = $profitBus->min('tongtien');

        // $profitBus2 =  DB::table('datcho')
        //     ->join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
        //     ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
        //     ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
        //     ->where('idttv', '=', 3)
        //     ->whereBetween('ngaychay.ngaychay', [$start_day, $end_day])
        //     ->where('tongtien', '=', $maxTongtien)
        //     ->groupBy('xe.idxe')
        //     // ->select('bienso')
        //     ->get('bienso');
        $profitMax = $profitBus->where('tongtien', '=', $maxTongtien);
        $profitMin = $profitBus->where('tongtien', '=', $minTongtien);
        // ->max();
        // $profit = $profitBus->addSelect('xe.idlx')->get();
        //     ->sum(['tongtien']); 

        // $max = $profitBus->select(['bienso'])->where();
        // $maxBienso = $profitBus->get('bienso')->sum('tongtien');
        // echo ($abc);

        $output = '';
        foreach ($profitMax as $value) {
            $output .= ' <div>Doanh thu xe cao nhất: ' . $value->bienso . ' - ' . $value->tongtien . ' vnđ </div>';
            // $output .= $value->bienso . '-' . $value->tongtien .'<br>';
        }
        foreach ($profitMin as $value) {
            $output .= ' <div>Doanh thu xe thấp nhất: ' . $value->bienso . ' - ' . $value->tongtien . ' vnđ </div>';
            // $output .= $value->bienso . '-' . $value->tongtien .'<br>';
        }
        echo ($output);
        // $output = '';
        // $output .= ' <div>Doanh thu xe cao nhất: ' . $profitBusMax['bienso'] . ' - ' . $profitBusMax['tongtien'] . ' vnđ </div>';
        // $output .= ' <div>Doanh thu xe thấp nhất: ' . $profitBusMin['bienso'] . ' - ' . $profitBusMin['tongtien'] . ' vnđ </div>';
        // echo ($output);
    }
}
