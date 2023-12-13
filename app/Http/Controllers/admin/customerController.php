<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\permissionModel;
use App\Models\User;
use Illuminate\Http\Request;

class customerController extends Controller
{
    public function showCustomer(Request $request)
    {

        $search = $request['search'] ?? "";
        if ($search != "") {

            $datas = User::join('khachhang', 'nguoidung.idnd', '=', 'khachhang.idnd')
                ->where(function ($query) use ($search) {
                    $query->where('nguoidung.tennd', 'LIKE', "%$search%")
                        ->orWhere('nguoidung.sdt', 'LIKE', "%$search%")
                        ->orWhere('khachhang.email', 'LIKE', "%$search%");
                })
                ->get();
        } else {
            $datas = User::join('khachhang', 'nguoidung.idnd', '=', 'khachhang.idnd')
                ->get();
        }
        $IsExits = permissionModel::join('khachhang', 'khachhang.idkh', '=', 'quyenhan.idkh')->get();
        // dd($datas);
        // $this->data['datas'] = User::join('chucvu', 'admin.idcv', '=', 'chucvu.idcv')
        //     ->get(['admin.*', 'chucvu.*']);

        return view('admin.customer.listCustomer', compact('datas', 'IsExits','search'));
    }

    public function delete(Request $request, $idkh)
    {
        $success = "Vô hiệu hóa tài khoản thành công.";
        $data['idkh'] = $idkh;
        permissionModel::create($data);
        return redirect()->back()->with('success', $success);
    }
    public function active(Request $request, $idkh)
    {
        $success = "Tài khoản đã được kích hoạt thành công.";
        permissionModel::where('idkh', $idkh)->delete();
        return redirect()->back()->with('success', $success);
    }
}
