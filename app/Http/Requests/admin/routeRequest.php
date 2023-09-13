<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class routeRequest extends FormRequest
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
            'diemKH' => 'required',
            'diemKT' => 'different:diemKH|required',
            'tg_dukien' => 'required',
            'tansuat' => 'required',
            'giave' => 'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'diemKH.required' => '* Điếm khởi hành không được để trống!',
            'diemKT.different' => '* Điểm kết thúc không được trùng với điểm bắt đầu!',
            'diemKT.required' => '* Điểm kết thúc không được để trống!',
            'tg_dukien.required' => '* Thời gian dự kiến không được để trống!',
            'tansuat.required' => '* Tần suất không được để trống!',
            'giave.required' => '* Giá vé không được để trống!',

        ];
    }
}
