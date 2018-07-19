<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PollanswerRequest extends Request
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
        'title.required'=>'กรุณาป้อนหัวข้อ2',
        'detail.required'=>'กรุณาป้อนรายละเอียด2'
    	];
    }
}
