<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class busRequest extends FormRequest
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
            'bienso' => 'required',
            'namsx' => 'required',
            'idlx' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'bienso.required' => '* Biển số xe không được để trống!',
            'namsx.required' => '* Nắm sản xuất không được để trống!',
            'idlx.required' => '* Loại xe không được để trống!',

        ];
    }
}
