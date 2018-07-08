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
        'groupname'=>'required',
        'detail'=>'required'
      ];
    }
    public function messages()
    {
    	return [
              'groupname.required'=>'ต้องป้อนข้อมูลกลุ่มงานวิจัย/กลุ่มปัญหา',
              'detail.required'=>'ต้องป้อนรายละเอียด',
    	];
    }
}
