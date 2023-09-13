<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class tripRequest extends FormRequest
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
            'idtuyen' => 'required',
            'idadmin' => 'required',
            'idxe' => 'required',
            'tg_xuatben' => 'required',
            'ngaychay' => 'required'
            
        ];
    }
    public function messages()
    {
        return [
            'idtuyen.required' => '* Tuyến đường không được để trống!',
            'idadmin.required' => '* Tài xế không được để trống!',
            'idxe.required' => '* Xe không được để trống!',
            'tg_xuatben.required' => '* Thời gian xuất bến không được để trống!',
            'ngaychay.required' => '* Ngày chạy không được để trống!',

        ];
    }
}
