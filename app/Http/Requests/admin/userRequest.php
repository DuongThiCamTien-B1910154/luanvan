<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class userRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'mand' => 'required|unique:admin',
            'tennd' => 'required',
            'sdt' => 'numeric|required|digits:10',
            'namsinh' => 'required',
            'idcv' => 'required',
            // 'diachi' => 'required',
            'email' => 'required|unique:admin',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|required_with:password|same:password',

            'idtp' => 'required',
            'idqh' => 'required',
            'idxa' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'mand.required' => '* Mã nhân viên không được để trống!',
            'mand.unique' => '* Mã nhân viên đã tồn tại!',
            'tennd.required' => '* Tên người dùng không được để trống!',
            'email.required' => '* Email không được để trống!',
            'email.unique' => '* Email đã tồn tại!',
            'namsinh.required' => '* Năm sinh không được để trống!',
            'sdt.required' => '* Số điện thoại không được để trống!',
            'sdt.digits' => '* Số điện thoại phải có độ dài :digits',
            'sdt.numeric' => '* Số điện thoại không được là chữ!',
            'diachi.required' => '* Địa chỉ không được để trống!',
            'password.required' => '* Mật khẩu không được để trống!',
            'password.min' => '* Mật khẩu không được nhỏ hơn :min!',
            'password_confirmation.required_with' => '* Vui lòng nhập lại mật khẩu để xác nhận.',
            'password_confirmation.same' => '* Mật khẩu không trùng !',
            'password_confirmation.required' => '* Vui lòng không để trống!',
            'idcv.required' => '* Chức vụ không được để trống!',
            'idtp.required' => '* Tỉnh thành không được để trống!',
            'idqh.required' => '* Quận/huyện không được để trống!',
            'idxa.required' => '* Xã/Phường không được để trống!',

        ];
    }
}
