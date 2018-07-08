<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UniverRequest extends Request
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
              'name.required'=>'ต้องป้อนข้อมูลหน่วยงาน',
              'detail.required'=>'ต้องป้อนรายละเอียดหน่วยงาน'
    	];
    }
}
