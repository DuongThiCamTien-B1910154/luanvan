<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\userRequest;
use App\Models\adminModel;
use App\Models\districtModel;
use App\Models\provinceModel;
use App\Models\townModel;
use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function showUser(Request $request)
    {

        $this->data['title'] = "Thành viên";
        $this->data['error'] = "Vui lòng kiểm tra lại !";
        $search = $request['search'] ?? "";
        if ($search != "") {

            $this->data['datas'] = adminModel::join('chucvu', 'admin.idcv', '=', 'chucvu.idcv')
                ->join('nguoidung', 'admin.idnd', '=', 'nguoidung.idnd')
                ->where('mand', 'LIKE', "%$search%")->orwhere('tennd', 'LIKE', "%$search%")->get(['admin.*', 'chucvu.*', 'nguoidung.*']);
        } else {
            $this->data['datas'] = adminModel::join('chucvu', 'admin.idcv', '=', 'chucvu.idcv')
                ->join('nguoidung', 'admin.idnd', '=', 'nguoidung.idnd')
                ->get(['admin.*', 'chucvu.*', 'nguoidung.*']);
        }

        // $this->data['datas'] = User::join('chucvu', 'admin.idcv', '=', 'chucvu.idcv')
        //     ->get(['admin.*', 'chucvu.*']);

        return view('admin.users.listUser', $this->data, compact('search'));
    }
    public function showFormAddUser(Request $request)
    {

        return view('admin.users.addUser');
    }
    public function addUser(Request $request)
    {

        $data = $request->all();
        // echo ($data);

        if ($data['action']) {
            $output = '';
            if ($data['action'] == "city") {
                $select_district = districtModel::where('idtp', $data['matp'])->get();
                $output .= '<option value ="">--- Chọn quận/huyện---</option>';
                foreach ($select_district as $key => $district) {
                    $output .= '<option value ="' . $district->idqh . '">' . $district->name_district . '</option>';
                }
            } else {
                $select_town = townModel::where('idqh', $data['matp'])->get();
                $output .= '<option value ="">---Chọn xã/phường---</option>';
                foreach ($select_town as $key => $town) {
                    $output .= '<option value ="' . $town->idxa . '">' . $town->name_town . '</option>';
                }
            }
            echo ($output);
        }
    }

    public function add(userRequest $request)
    {
        // return 123;
        $success = "Thêm thành viên thành công!";
        $input = $request->all();
        // dd($input);

        $city = provinceModel::where('idtp', $input['idtp'])->get()->first();
        $district = districtModel::where('idqh', $input['idqh'])->get()->first();
        // $town = townModel::where('idxa', $input['idxa'])->get()->first();
        $town = townModel::find($input['idxa']);

        // dd($town->name_town);

        $input['diachi'] .= $city['name_city'];
        $input['diachi'] .= ", ";
        $input['diachi'] .= $district['name_district'];
        $input['diachi'] .= ", ";
        $input['diachi'] .= $town['name_town'];

        User::create($input);
        $user = User::all()->last();
        $input['idnd'] = $user['idnd'];
        $input['password'] = bcrypt($request->get('password'));
        $input['level'] = 1;
        adminModel::create($input);
        // // dd($input);
        return redirect()->back()->with('success', $success);
    }
    public function showFormEdit($id)
    {
        // $datas =  User::find($id);
        // dd($datas->idxa);
        // $datas = User::join('xaphuongthitran')
        $datas = adminModel::join('xaphuongthitran', 'admin.idxa', '=', 'xaphuongthitran.idxa')
            ->join('quanhuyen', 'quanhuyen.idqh', '=', 'xaphuongthitran.idqh')
            ->join('tinhthanhpho', 'tinhthanhpho.idtp', '=', 'quanhuyen.idtp')
            ->join('nguoidung', 'nguoidung.idnd', '=', 'admin.idnd')
            ->where('admin.idadmin', $id)->first();
        // dd($datas);
        return view('admin.users.editUser', compact('datas'));
    }
    public function editUser(Request $request, $id)
    {
        $success = "Cập nhật thành công.";
        // $idnd = $request->input('idnd');
        $admin = adminModel::find($id);
        // $user['idnd'];
        $data = User::find($admin['idnd']);
        $data->tennd = $request->tennd;
        $data->gtinh = $request->gtinh;
        $data->sdt = $request->sdt;
        $city = provinceModel::where('idtp', $request->idtp)->get()->first();
        $district = districtModel::where('idqh', $request->idqh)->get()->first();
        $town = townModel::where('idxa', $request->idxa)->get()->first();

        $request['diachi'] .= $city['name_city'];
        $request['diachi'] .= ", ";
        $request['diachi'] .= $district['name_district'];
        $request['diachi'] .= ", ";
        $request['diachi'] .= $town['name_town'];
        $data->diachi = $request->diachi;
        $data->save();

        // $user->idcv = $request->idcv;
        $admin->email = $request->email;
        $admin->mand = $request->mand;
        $admin->namsinh = $request->namsinh;
        $admin->save();

        // // return view('admin.users.listUser')->with('success', $success);
        return redirect()->action([userController::class, 'showUser'])->with('success', $success);
    }

    public function deleteUser($id)
    {
        $success = "Xóa thành công.";
        $admin = adminModel::find($id);
        adminModel::find($id)->delete();
        // $user['idnd'];
        User::find($admin['idnd'])->delete();
        // $data = User::find($idnd);
        return redirect()->action([userController::class, 'showUser'])->with('success', $success);
    }
}
