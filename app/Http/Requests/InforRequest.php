<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InforRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
          'title'=>'required',
          'detail'=>'required'
        ];
    }
    public function messages()
    {
    	return [
        'title.required'=>'กรุณาหัวเรื่อง',
        'detail.required'=>'กรุณาป้อนรายละเอียด'
    	];
    }
}
