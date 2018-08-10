<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Area;
use App\University;
use App\Taggroup;
use App\Expert;
use App\Expertlist;

use App\Http\Requests\ExpertRequest;

class ExpertController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth');
     }

    public function index()
    {
        $objuniver = University::lists('name','id');
        $objtag = Taggroup::lists('groupname','id');
        $idu = Auth::user()->university_id;
        $objarea = Area::where('university_id',$idu)
        ->lists('name','id');
        return view('user.expert',compact('objuniver','objtag','objarea'));
    }

    public function create()
    {
      if(Auth::user()->role->slug == 'Admin'){
        $data = Expert::orderby('firstname')->get();
      }
      if(Auth::user()->role->slug == 'University'){
        $id = Auth::user()->university_id;
        $data = Expert::where('university_id',$id)->orderby('firstname')->get();
      }
      if(Auth::user()->role->slug == 'Manager'){
        $id = Auth::user()->center_id;
        $data = Expert::where('center_id',$id)->orderby('firstname')->get();
      }
      if(Auth::user()->role->slug == 'Operator'){
        $id = Auth::user()->area_id;
        $data = Expert::where('area_id',$id)->orderby('firstname')->get();
      }
      //$data = Expert::get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th>ลำดับ</th>
          <th>ชื่อผู้เชี่ยวชาญ</th>
          <th>พื้นที่ชุมชน</th>
          <th>ความเชี่ยวชาญ</th>
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
          <td>$key->headname$key->firstname $key->lastname</td>
          <td>".$key->area->name."</td>
          <td><a data-id='$key->id' href='#' class='btn btn-warning btn-xs upexpert'>EXPERT <span class='badge'>".count($key->expertlist)."</span></a>
          </td>
          <td>
          <a data-id='$key->id' href='#j' class='btn btn-primary btn-xs edit'><i class='fa fa-fw fa-edit'></i> แก้ไข</a>
          <a data-id='$key->id' href='#' class='btn btn-danger btn-xs delete'><i class='fa fa-fw fa-trash-o'></i> ลบข้อมูล</a>
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


    public function store(ExpertRequest $request)
    {
      $obj = new Expert();
      if(Auth::user()->role->slug == 'Admin'){
        $obj->university_id = $request['university_id'];
        $obj->center_id = $request['center_id'];
        $obj->area_id = $request['area_id'];
      }
      if(Auth::user()->role->slug == 'University'){
        $obj->university_id = Auth::user()->university_id;
        $obj->center_id = $request['center_id'];
        $obj->area_id = $request['area_id'];
      }
      if(Auth::user()->role->slug == 'Manager'){
        $obj->university_id = Auth::user()->university_id;
        $obj->center_id = Auth::user()->center_id;
        $obj->area_id = $request['area_id'];
      }
      if(Auth::user()->role->slug == 'Operator'){
        $obj->university_id = Auth::user()->university_id;
        $obj->center_id = Auth::user()->center_id;
        $obj->area_id = Auth::user()->area_id;
      }
        $obj->headname = $request['headname'];
        $obj->firstname = $request['firstname'];
        $obj->lastname = $request['lastname'];
        $obj->address = $request['address'];
        $obj->tel = $request['tel'];
        $obj->email = $request['email'];
        $check = $obj->save();
      //if($check>0){return 0;}else{return 1;}
      if(Auth::user()->role->slug == 'Admin'){
        $objs = Expert::get();
      }
      if(Auth::user()->role->slug == 'University'){
        $id = Auth::user()->university_id;
        $objs = Expert::where('university_id',$id)->get();
      }
      if(Auth::user()->role->slug == 'Manager'){
        $id = Auth::user()->center_id;
        $objs = Expert::where('center_id',$id)->get();
      }
      if(Auth::user()->role->slug == 'Operator'){
        $id = Auth::user()->area_id;
        $objs = Expert::where('area_id',$id)->get();
      }
      //$objs = Expert::all();
      $data['objs'] = $objs->count();
      $data['check'] = $check;
      return $data;

    }

    public function show($id){}

    public function edit($id)
    {
      $data = Expert::find($id);
      return $data->toArray();
    }


    public function update(ExpertRequest $request, $id)
    {
      if(Auth::user()->role->slug == 'Admin'){
        $obj = Expert::findOrFail($id);
        $obj->university_id = $request['university_id'];
        $obj->center_id = $request['center_id'];
        $obj->area_id = $request['area_id'];
        $obj->headname = $request['headname'];
        $obj->firstname = $request['firstname'];
        $obj->lastname = $request['lastname'];
        $obj->address = $request['address'];
        $obj->tel = $request['tel'];
        $obj->email = $request['email'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}
      }
      if(Auth::user()->role->slug == 'University'){
        $obj = Expert::findOrFail($id);
        if(Auth::user()->university_id == $obj->university_id){
          //$obj->university_id = $request['university_id'];
          $obj->center_id = $request['center_id'];
          $obj->area_id = $request['area_id'];
          $obj->headname = $request['headname'];
          $obj->firstname = $request['firstname'];
          $obj->lastname = $request['lastname'];
          $obj->address = $request['address'];
          $obj->tel = $request['tel'];
          $obj->email = $request['email'];
          $check = $obj->save();
          if($check>0){return 0;}else{return 1;}
        }
        abort(0);
      }
      if(Auth::user()->role->slug == 'Manager'){
        $obj = Expert::findOrFail($id);
        if(Auth::user()->center_id == $obj->center_id){
          //$obj->university_id = $request['university_id'];
          //$obj->center_id = $request['center_id'];
          $obj->area_id = $request['area_id'];
          $obj->headname = $request['headname'];
          $obj->firstname = $request['firstname'];
          $obj->lastname = $request['lastname'];
          $obj->address = $request['address'];
          $obj->tel = $request['tel'];
          $obj->email = $request['email'];
          $check = $obj->save();
          if($check>0){return 0;}else{return 1;}
        }
        abort(0);
      }
      if(Auth::user()->role->slug == 'Operator'){
        $obj = Expert::findOrFail($id);
        if(Auth::user()->area_id == $obj->area_id){
          //$obj->university_id = $request['university_id'];
          //$obj->center_id = $request['center_id'];
          //$obj->area_id = $request['area_id'];
          $obj->headname = $request['headname'];
          $obj->firstname = $request['firstname'];
          $obj->lastname = $request['lastname'];
          $obj->address = $request['address'];
          $obj->tel = $request['tel'];
          $obj->email = $request['email'];
          $check = $obj->save();
          if($check>0){return 0;}else{return 1;}
        }
        abort(0);
      }
    }

    public function destroy($id)
    {
      if(Auth::user()->role->slug == 'Admin'){
        $data = Expert::find($id);
          $data2 = Expertlist::where('Expert_id', $id);
          $check = $data->delete();
          $check2 = $data2->delete();
          $objs = Expert::all();
          $data['objs'] = $objs->count();
          $data['check'] = $check;
          return $data;
      }
      if(Auth::user()->role->slug == 'University'){
        $data = Expert::find($id);
        if(Auth::user()->university_id == $data->university_id){
          $data2 = Expertlist::where('Expert_id', $id);
          $check = $data->delete();
          $check2 = $data2->delete();
          $objs = Expert::where('university_id',Auth::user()->university_id);
          $data['objs'] = $objs->count();
          $data['check'] = $check;
          return $data;
        }
        abort(0);
      }
      if(Auth::user()->role->slug == 'Manager'){
        $data = Expert::find($id);
        $data1 = Area::find($data->area_id);
        $center_id = $data1->center_id;
        if(Auth::user()->center_id == $center_id){
          $data2 = Expertlist::where('Expert_id', $id);
          $check = $data->delete();
          $check2 = $data2->delete();
          $objs = Expert::where('center_id',Auth::user()->center_id);
          $data['objs'] = $objs->count();
          $data['check'] = $check;
          return $data;
        }
        abort(0);
      }
      if(Auth::user()->role->slug == 'Operator'){
        $data = Expert::find($id);
        if(Auth::user()->area_id == $data->area_id){
          $data2 = Expertlist::where('Expert_id', $id);
          $check = $data->delete();
          $check2 = $data2->delete();
          $objs = Expert::where('area_id',Auth::user()->area_id);
          $data['objs'] = $objs->count();
          $data['check'] = $check;
          return $data;
        }
        abort(0);
      }
    }
}//class
