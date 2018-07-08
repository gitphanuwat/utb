<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\ResearcherRequest;

use App\Http\Requests;

use App\Useful;

use App\Expert;
use App\Research;
use App\Creative;
use App\Area;
use App\Problem;


use App\Http\Requests\UsefulRequest;

class UsefulController extends Controller
{
     public function __construct()
     {
        // $this->middleware('auth');
     }

    public function index()
    {
        $objexp = Expert::get();
        $objres = Research::lists('title_th','id');
        $objcre = Creative::lists('title','id');
        $objare = Area::get();
        $objpro = Problem::lists('title','id');
        return view('user.useful',compact('objtag','objexp','objres','objcre','objare','objpro'));
    }

    public function create()
    {
      $uid = Auth::user()->university_id;

      if(Auth::user()->role->slug == 'Admin'){
        $data = Useful::get();
      }elseif(Auth::user()->role->slug == 'University'){
        $data = Useful::leftJoin('users','usefuls.user_id','=','users.id')
                ->select('usefuls.*')
                ->where('users.university_id','=',$uid)->get();
      }
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th>ลำดับ</th>
          <th>ชื่อเรื่อง</th>
          <th>พื้นที่ชุมชน</th>
          <th>ปัญหาในพื้นที่</th>
          <th data-sortable='false'>ดำเนินการ</th>
        </tr>
        </thead>
        <tbody>
      ";
      $i=1;
      foreach ($data as $key) {
        $display .= "
        <tr>
          <td>".$i++."</td>
          <td>$key->title</td>
          <td>".$key->area->name."</td>
          <td>".$key->problem->title."</td>
          <td>
          <a data-id='$key->id' href='#' class='btn btn-success btn-xs report'>แสดงข้อมูล</a>
          <a data-id='$key->id' href='#' class='btn btn-warning btn-xs btnedit'>แก้ไข</a>
          <a data-id='$key->id' href='#' class='btn btn-danger btn-xs delete'><i class='fa fa-fw fa-trash-o'></i> DELETE</a>
          </td>
        </tr>
        ";
      }
      //useful/".$key->id."/edit
      $display .= "
        </tbody>
      </table>
      ";
      return $display;
    }


    public function store(UsefulRequest $request)
    {
      $obj = new Useful();

      $obj->area_id = $request['area_id'];

      $obj->expert_id = $request['expert_id'];
      $obj->research_id = $request['research_id'];
      $obj->creative_id = $request['creative_id'];
      $obj->problem_id = $request['problem_id'];

      $obj->title = $request['title'];
      $obj->detail = $request['detail'];

      $obj->user_id = $request['user_id'];
      $check = $obj->save();

      $objpro = Problem::findOrFail($request['problem_id']);
      $objpro->status = '3';
      $objpro->save();

      $uid = Auth::user()->university_id;
      if(Auth::user()->role->slug == 'Admin'){
        $objs = Useful::get();
      }elseif(Auth::user()->role->slug == 'University'){
        $objs = Useful::leftJoin('users','usefuls.user_id','=','users.id')
                ->select('usefuls.*')
                ->where('users.university_id','=',$uid)->get();
      }

      $data['objs'] = $objs->count();
      $data['check'] = $check;
      return $data;
      //return 1;
    }

    public function show($id){
      $data = Useful::find($id);
      $display="
      <table id='example1' class='table table-bordered table-striped'>
      <tr>
      <td style='width:150px'>หัวเรื่อง</td>
        <td>$data->title</td>
      </tr>
      <tr>
        <td>ปัญหาที่ดำเนินการ</td>
        <td>".$data->problem->title."</td>
      </tr>
      <tr>
        <td>รายละเอียด</td>
        <td>$data->detail</td>
      </tr>
      <tr>
        <td>พื้นที่ชุมชน</td>
        <td>".$data->area->name."</td>
      </tr>
      <tr>
        <td>งานวิจัย</td>
        <td>".$data->research->title_th."</td>
      </tr>
      ";
      $display .= "
      </table>
      ";
      return $display;
    }

    public function edit($id)
    {
      $data = Useful::find($id);
      return $data->toArray();
    }


    public function update(UsefulRequest $request, $id)
    {
      $obj = Useful::findOrFail($id);

      $obj->title = $request['title'];
      $obj->detail = $request['detail'];

      $obj->research_id = $request['research_id'];
      $obj->expert_id = $request['expert_id'];
      $obj->creative_id = $request['creative_id'];
      $obj->area_id = $request['area_id'];
      $obj->problem_id = $request['problem_id'];
      //$obj->user_id = $request['user_id'];
      $check = $obj->save();
      if($check>0){return 0;}else{return 1;}
    }

    public function destroy($id)
    {
      $data = Useful::find($id);
  		$check = $data->delete();

      $uid = Auth::user()->university_id;

      if(Auth::user()->role->slug == 'Admin'){
        $objs = Useful::get();
      }elseif(Auth::user()->role->slug == 'University'){
        $objs = Useful::leftJoin('users','usefuls.user_id','=','users.id')
                ->select('usefuls.*')
                ->where('users.university_id','=',$uid)->get();
      }
      
      $data['objs'] = $objs->count();
      $data['check'] = $check;
      return $data;
    }
}
