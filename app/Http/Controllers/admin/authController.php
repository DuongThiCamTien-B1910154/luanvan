<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    //
    public function show()
    {
        return view('admin.users.login');
    }
    public function store(Request $request)
    {
        // $this->data['title'] = "Đăng nhập";
        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $check = $request->only('email', 'password');
        // dd($credentials);
        // if (Auth::attempt($credentials)) {
        //     if (Auth::user()->level == 0) {
        //         // dd(Auth::user()->idcv);
        //         if (Auth::user()->idcv == null) {
        //             return redirect('admin/');
        //         } else if (Auth::user()->idcv == 1) {
        //             return redirect('admin/bus');
        //         } else if (Auth::user()->idcv == 2) {
        //             return redirect('admin/ticket');
        //         } else if (Auth::user()->idcv == 3) {
        //             return redirect('admin/user');
        //         } else {
        //             return redirect()->back()->with('error', 'Email hoặc mật khẩu chưa đúng !');
        //         }
        //     }
        // } else {
        //     return redirect()->back()->with('error', 'Email hoặc mật khẩu chưa đúng !');
        // }
        // dd(Auth::guard('admin'));
        if (Auth::guard('admin')->attempt($check)) {
            // dd(auth('admin')->user()->idcv);

            // if (auth('admin')->user()->level != 0) {
            // dd(Auth::user()->idcv);
            if (auth('admin')->user()->idcv == 1 || auth('admin')->user()->idcv == 4) {
                return redirect('admin/bus');
            } else if (auth('admin')->user()->idcv == 2) {
                return redirect('admin/ticket');
            } else if (auth('admin')->user()->idcv == 3 || auth('admin')->user()->idcv == null) {
                return redirect('admin/user');
            } else {
                return redirect()->back()->with('error', 'Email hoặc mật khẩu chưa đúng !');
            }
            // } else {
            //     return redirect('admin/user');
            // }
            // dd(auth('admin')->user()->idcv);

        } else {
            return redirect()->back()->with('error', 'Email hoặc mật khẩu chưa đúng !');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
