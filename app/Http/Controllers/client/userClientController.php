<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\client\userClientRequest;
use App\Models\districtModel;
use App\Models\provinceModel;
use App\Models\townModel;
use App\Models\clientModel;
use App\Models\permissionModel;
// use Illuminate\Foundation\Auth\User;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;


class userClientController extends Controller
{
    //
    public function showFormRegister()
    {
        return view('client.user.register');
    }
    public function register(userClientRequest $request)
    {
        // $success = "Thêm thành viên thành công!";
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
        clientModel::create($input);
        // // dd($input);
        return redirect('client/user/login');
        // return 123; 
    }

    public function showFormLogin()
    {
        return view('client.user.login');
    }

    public function login(Request $request)
    {
        // return 123;
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6',
        ], [
            'email.required' => '* Email không được để trống!',
            'password.required' => '* Mật khẩu không được để trống!',
            'password.min' => '* Mật khẩu không được nhỏ hơn 6!',

        ]);
        $check = $request->only('email', 'password');
        if (Auth::guard('client')->attempt($check)) {
            $idkh = auth('client')->user()->idkh;
            $isExists = permissionModel::where('idkh', $idkh)->exists();
            if ($isExists) {
                Auth::guard('client')->logout();
                return redirect()->back()->with('error', 'Tài khoản đã bị vô hiệu hóa do hoạt đông bất thường !');
            } else {
                return redirect('client/index');
            }
        } else {
            return redirect()->back()->with('error', 'Email hoặc mật khẩu chưa đúng !');
        }
    }
    public function address(Request $request)
    {
        $data = $request->all();
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


    // login gg
    public function loginGoogleRedirect()
    {
        // return redirect()->back();

        return Socialite::driver('google')->redirect();
    }
    public function loginGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        // $check = auth('client')->user();
        $check = clientModel::where([
            'email' => $user->email,
        ])->first();
        // dd($check);
        if ($check) {
            Auth::guard('client')->login($check);
            $idkh = auth('client')->user()->idkh;
            $isExists = permissionModel::where('idkh', $idkh)->exists();
            if ($isExists) {
                Auth::guard('client')->logout();
                return redirect('client/user/login')->with('error', 'Tài khoản đã bị vô hiệu hóa do hoạt đông bất thường !');
            } else {
                // Auth::guard('client')->login($check);
                return redirect()->route('client.index');
            }
        } else {
            return redirect()->route('client.user.login')->with('error', 'Tài khoản Google không đúng!');
        }
    }
    public function logout()
    {
        Auth::guard('client')->logout();
        return redirect()->route('client.index');
    }
}
