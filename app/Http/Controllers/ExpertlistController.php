<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\University;
use App\Taggroup;
use App\Researcher;
use App\Research;
use App\Doc;
use App\Expert;
use App\Expertlist;

use App\Http\Requests\ExpertlistRequest;

class ExpertlistController extends Controller
{
     public function __construct()
     {
        // $this->middleware('auth');
     }

    public function index(){
        //
    }

    public function create(Request $request){
      $id = $request['id'];
      session(['researcher_id'=>$id]);
      $obj = Researcher::find($id);
      $data = Expertlist::where('researcher_id', $id)->get();
      $display = "<h3>นักวิจัย : ".$obj->headname.$obj->firstname." ".$obj->lastname."</h3>";
      $display .= "<h4>รายการความเชี่ยวชาญ</h4>";

      $display .= "
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th>ลำดับ</th>
          <th>ความเชี่ยวชาญ (ไทย)</th>
          <th>ความเชี่ยวชาญ (eng)</th>
          <th>กลุ่มความเชี่ยวชาญ</th>
          <th>ดำเนินการ</th>
        </tr>
        </thead>
        <tbody>
      ";
      $i=1;
      foreach ($data as $key) {
        $display .= "
        <tr>
          <td>".$i++."</td>
          <td>$key->title_th</td>
          <td>$key->title_eng</td>
          <td>".$key->taggroup->groupname."</td>
          <td>
          <a data-id='$key->id' href='#' class='btn btn-primary btn-xs editexp'><i class='fa fa-fw fa-edit'></i> แก้ไข</a>
          <a data-id='$key->id' href='#' class='btn btn-danger btn-xs deleteexp'><i class='fa fa-fw fa-trash-o'></i> ลบข้อมูล</a>
          </td>
        </tr>
        ";
      }
      $display .= "
        </tbody>
      </table>
      ";
      return $display;
    }


    public function store(ExpertlistRequest $request)
    {
      $obj = new expertlist();
      if ($request['expert_id']!=''){$obj->expert_id = session()->get('expert_id');}
      if ($request['researcher_id']!=''){$obj->researcher_id = session()->get('researcher_id');}
      $obj->taggroup_id = $request['taggroup_id'];
      $obj->isced_id = $request['isced_id'];
      $obj->title_th = $request['title_th'];
      $obj->title_eng = $request['title_eng'];
      $obj->detail = $request['detail'];
      $check = $obj->save();
      if($check>0){return 0;}else{return 1;}
    }

    public function show($id)
    {
      //$data = Expertlist::get();
      session(['expert_id'=>$id]);
      $obj = Expert::find($id);
      $data = Expertlist::where('expert_id', $id)->get();
      $display = "<h3>ผู้เชี่ยวชาญ : ".$obj->headname.$obj->firstname." ".$obj->lastname."</h3>";
      $display .= "<h4>รายการความเชี่ยวชาญ</h4>";

      $display .= "
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th>ลำดับ</th>
          <th>ความเชี่ยวชาญ (ไทย)</th>
          <th>ความเชี่ยวชาญ (eng)</th>
          <th>กลุ่มความเชี่ยวชาญ</th>
          <th>ดำเนินการ</th>
        </tr>
        </thead>
        <tbody>
      ";
      $i=1;
      foreach ($data as $key) {
        $display .= "
        <tr>
          <td>".$i++."</td>
          <td>$key->title_th</td>
          <td>$key->title_eng</td>
          <td>".$key->taggroup->groupname."</td>
          <td>
          <a data-id='$key->id' href='#' class='btn btn-primary btn-xs editexp'><i class='fa fa-fw fa-edit'></i> แก้ไข</a>
          <a data-id='$key->id' href='#' class='btn btn-danger btn-xs deleteexp'><i class='fa fa-fw fa-trash-o'></i> ลบข้อมูล</a>
          </td>
        </tr>
        ";
      }
      $display .= "
        </tbody>
      </table>
      ";
      return $display;
    }

    public function edit($id)
    {
      //Console::info('mymessage');
      //dump($id);
      //session(['expertlist_id'=>$id]);
      session(['expertlist_id'=>$id]);
      $data = Expertlist::find($id);
      header("Content-type: text/x-json");
      echo json_encode($data);
      exit();
    }


    public function update(ExpertlistRequest $request, $id)
    {
        $obj1 = Expertlist::find($id);
            $obj2 = Researcher::find($obj1->researcher_id);
            $obj3 = Expert::find($obj1->expert_id);

        if(Auth::user()->role->slug == 'Admin'){
          $obj = Expertlist::findOrFail($id);
          $obj->taggroup_id = $request['taggroup_id'];
          $obj->isced_id = $request['isced_id'];
          $obj->title_th = $request['title_th'];
          $obj->title_eng = $request['title_eng'];
          $obj->detail = $request['detail'];
          $check = $obj->save();
          if($check>0){return 0;}else{return 1;}
        }
        if(Auth::user()->role->slug == 'University'){
          if($obj1->researcher_id!='' and Auth::user()->university_id == $obj2->university_id){
            $obj = Expertlist::findOrFail($id);
            $obj->taggroup_id = $request['taggroup_id'];
            $obj->isced_id = $request['isced_id'];
            $obj->title_th = $request['title_th'];
            $obj->title_eng = $request['title_eng'];
            $obj->detail = $request['detail'];
            $check = $obj->save();
            if($check>0){return 0;}else{return 1;}
          }elseif($obj1->expert_id!='' and Auth::user()->university_id == $obj3->university_id){
            $obj = Expertlist::findOrFail($id);
            $obj->taggroup_id = $request['taggroup_id'];
            $obj->isced_id = $request['isced_id'];
            $obj->title_th = $request['title_th'];
            $obj->title_eng = $request['title_eng'];
            $obj->detail = $request['detail'];
            $check = $obj->save();
            if($check>0){return 0;}else{return 1;}
          }
          abort(0);
        }
        if(Auth::user()->role->slug == 'Manager'){
          if($obj1->expert_id!='' and Auth::user()->center_id == $obj3->center_id){
            $obj = Expertlist::findOrFail($id);
            $obj->taggroup_id = $request['taggroup_id'];
            $obj->isced_id = $request['isced_id'];
            $obj->title_th = $request['title_th'];
            $obj->title_eng = $request['title_eng'];
            $obj->detail = $request['detail'];
            $check = $obj->save();
            if($check>0){return 0;}else{return 1;}
          }
          abort(0);
        }
        if(Auth::user()->role->slug == 'Operator'){
          if($obj1->expert_id!='' and Auth::user()->area_id == $obj3->area_id){
            $obj = Expertlist::findOrFail($id);
            $obj->taggroup_id = $request['taggroup_id'];
            $obj->isced_id = $request['isced_id'];
            $obj->title_th = $request['title_th'];
            $obj->title_eng = $request['title_eng'];
            $obj->detail = $request['detail'];
            $check = $obj->save();
            if($check>0){return 0;}else{return 1;}
          }
          abort(0);
        }
    }

    public function destroy($id)
    {
      $obj1 = Expertlist::find($id);
          $obj2 = Researcher::find($obj1->researcher_id);
          $obj3 = Expert::find($obj1->expert_id);

      if(Auth::user()->role->slug == 'Admin'){
          $data = Expertlist::find($id);
      		$check = $data->delete();
          if($check>0){return 0;}else{return 1;}
      }
      if(Auth::user()->role->slug == 'University'){
        if($obj1->researcher_id!='' and Auth::user()->university_id == $obj2->university_id){
          $data = Expertlist::find($id);
          $check = $data->delete();
          if($check>0){return 0;}else{return 1;}
        }elseif($obj1->expert_id!='' and Auth::user()->university_id == $obj3->university_id){
          $data = Expertlist::find($id);
      		$check = $data->delete();
          if($check>0){return 0;}else{return 1;}
        }
        abort(0);
      }
      if(Auth::user()->role->slug == 'Manager'){
        if($obj1->expert_id!='' and Auth::user()->center_id == $obj3->center_id){
          $data = Expertlist::find($id);
      		$check = $data->delete();
          if($check>0){return 0;}else{return 1;}
        }
        abort(0);
      }
      if(Auth::user()->role->slug == 'Operator'){
        if($obj1->expert_id!='' and Auth::user()->area_id == $obj3->area_id){
          $data = Expertlist::find($id);
      		$check = $data->delete();
          if($check>0){return 0;}else{return 1;}
        }
        abort(0);
      }
      //return Auth::user()->university_id;
    }

    public function tagdetail(Request $request){
      $id = $request['id'];
      $obj = Taggroup::find($id);
  		$data = $obj->detail;
      //if($check>0){return 0;}else{return 1;}
      return $data;
    }

}
