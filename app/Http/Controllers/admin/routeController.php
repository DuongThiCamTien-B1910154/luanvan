<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\routeRequest;
use App\Models\routeModel;
use App\Models\tripModel;
use App\Models\provinceModel;

class routeController extends Controller
{
    //
    public function showRoute(Request $request)
    {
        // $this->data['title'] = "Thành viên";
        // $this->data['error'] = "Vui lòng kiểm tra lại !";
        $search = $request['search'] ?? "";
        if ($search != "") {
            // dd($search);
            $this->data['datas'] = routeModel::where('tentuyen', 'LIKE', "%$search%")->orwhere('giave', '=', $search)->get();
        } else {
            $this->data['datas'] = routeModel::get();
        }
        // dd($this->data);
        // $this->data['datas'] = User::join('chucvu', 'nguoidung.idcv', '=', 'chucvu.idcv')
        //     ->get(['nguoidung.*', 'chucvu.*']);

        return view('admin.route.listRoute', $this->data, compact('search'));
        // return view('admin.route.listRoute');
    }

    public function showFormAddRoute()
    {
        return view('admin.route.addRoute');
    }
    public function addRoute(routeRequest $request)
    {
        $success = "Thêm tuyến xe thành công!";
        $input = $request->all();
        $diemkh = provinceModel::where('idtp', $request->diemKH)->get()->first();
        $diemkt = provinceModel::where('idtp', $request->diemKT)->get()->first();
        // dd($diemkh['name_city']);
        $request['tentuyen'] .= $diemkh['name_city'];
        $request['tentuyen'] .= " => ";
        $request['tentuyen'] .= $diemkt['name_city'];
        $input['tentuyen'] = $request->tentuyen;
        routeModel::create($input);
        return redirect()->back()->with('success', $success);
    }

    public function showFormEdit($id)
    {
        $datas = routeModel::find($id);
        // dd($datas->diemKH);
        $diemkh = provinceModel::find($datas->diemKH);
        $diemkt = provinceModel::find($datas->diemKT);

        // dd($diemkh->idtp);
        // $datas = User::join('xaphuongthitran')
        // $datas['idtp'] =  
        return view('admin.route.editRoute', compact('datas', 'diemkh', 'diemkt'));
    }

    public function editRoute(Request $request, $id)
    {

        $success = "Cập nhật thành công.";
        // $idtuyen = $request->input('idtuyen');
        $data = routeModel::find($id);
        // dd($data);
        $diemkh = provinceModel::where('idtp', $request->diemKH)->get()->first();
        $diemkt = provinceModel::where('idtp', $request->diemKT)->get()->first();
        // dd($diemkh['name_city']);
        $request['tentuyen'] .= $diemkh['name_city'];
        $request['tentuyen'] .= " => ";
        $request['tentuyen'] .= $diemkt['name_city'];
        $data['tentuyen'] = $request->tentuyen;

        // $data->tennd = $request->tennd;
        $data->diemKH = $request->diemKH;
        $data->diemKT = $request->diemKT;
        $data->tg_dukien = $request->tg_dukien;
        $data->tansuat = $request->tansuat;
        $data->giave = $request->giave;

        // dd($request['diachi']);
        $data->tentuyen = $request->tentuyen;
        // dd($data['diachi']);
        $data->save();
        // return view('admin.users.listUser')->with('success', $success);
        return redirect()->action([routeController::class, 'showRoute'])->with('success', $success);
    }
    public function deleteRoute($id)

    {
        $success = "Xóa thành công.";
        $data = routeModel::find($id);
        // dd($data);
        tripModel::where('idtuyen', $id)->get()->each->delete();
        routeModel::find($data['idtuyen'])->delete();
        return redirect()->action([routeController::class, 'showRoute'])->with('success', $success);
    }
}
