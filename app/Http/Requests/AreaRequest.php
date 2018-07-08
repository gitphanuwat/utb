<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Session;

use App\Http\Requests\Request;

class AreaRequest extends Request
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
          'university_id'=>'required',
          'center_id'=>'required',
          'name'=>'required',
          'tambon'=>'required',
          'amphur'=>'required',
          'province'=>'required',
          'latitude'=>'required',
          'longitude'=>'required'
        ];
    }
    public function messages()
    {
    	return [
              'university_id.required'=>'ต้องเลือกมหาวิทยาลัย',
              'center_id.required'=>'ต้องเลือกศูนย์จัดการเครือข่าย',
              'name.required'=>'ต้องป้อนชื่อชุมชน',
              'tambon.required'=>'ต้องป้อนตำบล',
              'amphur.required'=>'ต้องป้อนอำเภอ',
              'province.required'=>'ต้องป้อนจังหวัด',
              'latitude.required'=>'ต้องป้อนพิกัดละติจูด',
              'longitude.required'=>'ต้องป้อนพิกัดลองจิจูด'
    	];
    }
}
