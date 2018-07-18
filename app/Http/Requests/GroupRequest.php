<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GroupRequest extends Request
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
     * @return array
     */
    public function rules()
    {
      return [
        'name'=>'required',
        'detail'=>'required'
      ];
    }
    public function messages()
    {
    	return [
        'name.required'=>'ต้องป้อนชื่อกลุ่ม',
        'detail.required'=>'ต้องป้อนรายละเอียด'
    	];
    }
}
