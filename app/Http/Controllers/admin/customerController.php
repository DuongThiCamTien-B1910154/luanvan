<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class customerController extends Controller
{
    public function showCustomer(Request $request)
    {
        
        // $search = $request['search'] ?? "";
        // if ($search != "") {

        //     $this->data['datas'] = adminModel::join('chucvu', 'admin.idcv', '=', 'chucvu.idcv')
        //         ->join('nguoidung', 'admin.idnd', '=', 'nguoidung.idnd')
        //         ->where('mand', 'LIKE', "%$search%")->orwhere('tennd', 'LIKE', "%$search%")->get(['admin.*', 'chucvu.*', 'nguoidung.*']);
        // } else {
            $this->data['datas'] = User::join('khachhang', 'nguoidung.idnd', '=', 'khachhang.idnd')
                ->get();
        // }

        // $this->data['datas'] = User::join('chucvu', 'admin.idcv', '=', 'chucvu.idcv')
        //     ->get(['admin.*', 'chucvu.*']);

        return view('admin.customer.listCustomer', $this->data);
    }
}
