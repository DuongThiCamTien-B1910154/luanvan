<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\tripModel;
use App\Models\User;
use Illuminate\Http\Request;

class filterAdminController  extends Controller
{
    public function filterTrip(Request $request)
    {
        $filter = $request->all();
        $datas = tripModel::join('admin', 'admin.idadmin', '=', 'chuyen.idadmin')
            ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
            ->join('nguoidung', 'nguoidung.idnd', '=', 'admin.idnd')
            ->join('c_ng_g_x', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
            ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
            ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
            ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
            ->whereBetween('ngaychay.ngaychay', [$filter['input_from'],  $filter['input_to']])
            ->orderBy('tuyen.idtuyen')->orderBy('ngaychay.ngaychay')->get();
        $users = User::all();
        $output = '';
        foreach ($datas as $key => $data) {
            $output .= '<tr>';
            $output .= '<td>' . $key + 1 . '</td>';
            $output .= '<td>' . $data->tentuyen . '</td>';
            $output .= '<td>' . $data->bienso . '</td>';
            $output .= '<td>' . $data->tenloai . '</td>';
            $output .= '<td>' . $data->tg_xuatben . '</td>';
            $output .= '<td>' . $data->ngaychay . '</td>';
            foreach ($users as $user) {
                if ($user->idnd == $data->idnd) {
                    $output .= '<td>' . $user->tennd . '</td>';
                }
            }
            $output .= '<form action="" method="post">';
            $output .= '<td class="text-primary btn">';
            $output .= '<a href="' . asset('admin/trip/editTrip\/') . $data->idchuyen . '"><i class="fa-solid fa-pen-to-square"></i></a>';
            $output .= '</td>';
            $output .= '<td class="text-danger btn"> ';
            $output .= '<a href="' . asset('admin/trip/deleteTrip\/') . $data->idchuyen . '"  class="text-danger" onclick="return confirm(\'Bạn có chắc muốn xóa không?\')">';
            $output .= '<i class="fa-solid fa-trash"></i></a>';
            $output .= '</td>';
            $output .= '</form>';

            $output .= '</tr>';
        }

        echo $output;
    }
    public function searchTrip(Request $request)
    {
        $filter = $request->all();
        $searchTrip = $filter["searchTrip"];
        $datas = tripModel::join('admin', 'admin.idadmin', '=', 'chuyen.idadmin')
            ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
            ->join('nguoidung', 'nguoidung.idnd', '=', 'admin.idnd')
            ->join('c_ng_g_x', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
            ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
            ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
            ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
            ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
            ->orWhere('tennd', 'LIKE', "%$searchTrip%")
            ->orderBy('tuyen.idtuyen')->orderBy('ngaychay.ngaychay')->get();
        $users = User::all();
        $output = '';
        foreach ($datas as $key => $data) {
            $output .= '<tr>';
            $output .= '<td>' . $key + 1 . '</td>';
            $output .= '<td>' . $data->tentuyen . '</td>';
            $output .= '<td>' . $data->bienso . '</td>';
            $output .= '<td>' . $data->tenloai . '</td>';
            $output .= '<td>' . $data->tg_xuatben . '</td>';
            $output .= '<td>' . $data->ngaychay . '</td>';
            foreach ($users as $user) {
                if ($user->idnd == $data->idnd) {
                    $output .= '<td>' . $user->tennd . '</td>';
                }
            }
            $output .= '<form action="" method="post">';
            $output .= '<td class="text-primary btn">';
            $output .= '<a href="' . asset('admin/trip/editTrip\/') . $data->idchuyen . '"><i class="fa-solid fa-pen-to-square"></i></a>';
            $output .= '</td>';
            $output .= '<td class="text-danger btn"> ';
            $output .= '<a href="' . asset('admin/trip/deleteTrip\/') . $data->idchuyen . '"  class="text-danger" onclick="return confirm(\'Bạn có chắc muốn xóa không?\')">';
            $output .= '<i class="fa-solid fa-trash"></i></a>';
            $output .= '</td>';
            $output .= '</form>';

            $output .= '</tr>';
        }

        echo $output;
    }
}
