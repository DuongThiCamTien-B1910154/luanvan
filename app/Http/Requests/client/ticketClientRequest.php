<?php

namespace App\Http\Requests\client;

use Illuminate\Foundation\Http\FormRequest;

class ticketClientRequest extends FormRequest
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
            'tennd' => 'required',
            'sdt' => 'numeric|required|digits:10',
            'email' => 'required|unique:admin',
            'id_c_ng_x' => 'required',
            'idghes[]' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'tennd.required' => '* Tên người dùng không được để trống!',
            'email.required' => '* Email không được để trống!',
            'email.unique' => '* Email đã tồn tại!',
            'sdt.required' => '* Số điện thoại không được để trống!',
            'sdt.digits' => '* Số điện thoại phải có độ dài :digits',
            'sdt.numeric' => '* Số điện thoại phải là số!',
            'id_c_ng_x.required' => '* Xe không được để trống!',
            'idghes[].required' => '* Chỗ ngồi không được để trống!',
        ];
    }
}
