<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProblemRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
          'taggroup_id'=>'required',
          'title'=>'required',
          'detail'=>'required',
        ];
    }
    public function messages()
    {
    	return [
        'taggroup_id.required'=>'กรุณาเลือกกลุ่มปัญหา',
        'title.required'=>'กรุณาป้อนหัวข้อปัญหา',
        'detail.required'=>'กรุณาป้อนรายละเอียดปัญหา',
    	];
    }
}
