<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class bookingRequest extends FormRequest
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
            'tennd2' => 'required',
            // 'sdt2' => 'required',
            'id_c_ng_g_x' => 'required',
            'idghes' => 'required',
            'sdt2' => 'numeric|required|digits:10',

        ];
    }
    public function messages()
    {
        return [
            'tennd2.required' => '* Tên không được để trống!',
            // 'sdt2.required' => '* Số điện thoại không được để trống!',
            'id_c_ng_g_x.required' => '* Xe không được để trống!',
            'idghes.required' => '* Ghế ngồi không được để trống!',
            'sdt2.required' => '* Số điện thoại không được để trống!',
            'sdt2.digits' => '* Số điện thoại phải có độ dài :digits',
            'sdt2.numeric' => '* Số điện thoại phải là số!',
        ];
    }
}
