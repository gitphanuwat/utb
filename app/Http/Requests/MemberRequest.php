<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MemberRequest extends Request
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
          'role_id'=>'required',
          'university_id'=>'required',
          'center_id'=>'required',
          'area_id'=>'required',
          'headname'=>'required',
          'firstname'=>'required',
          'lastname'=>'required',
          'email'=>'required|email',
          'password'=>'required',
        ];
    }
    public function messages()
    {
    	return [
        'role_id.required'=>'กรุณาเลือกสิทธ์',
        'university_id.required'=>'กรุณาเลือกมหาวิทยาลัย',
        'center_id.required'=>'กรุณาเลือกศูนย์จัดการเครือข่าย',
        'area_id.required'=>'กรุณาเลือกพื้นที่ชุมชน',
              'headname.required'=>'กรุณาป้อนคำนำหน้าชื่อ',
              'firstname.required'=>'กรุณาป้อนชื่อสมาชิก',
              'lastname.required'=>'กรุณาป้อนสกุลสมาชิก',
              'email.required'=>'กรุณาป้อนอีเมล์',
              'email.email'=>'กรุณาป้อนอีเมล์ในรูปแบบที่ถูกต้อง',
              'password.required'=>'กรุณาป้อนรหัสผ่าน',
    	];
    }
}
