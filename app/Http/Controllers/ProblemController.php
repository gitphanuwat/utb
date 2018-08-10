<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Area;
use App\Problem;
use App\Taggroup;

use App\Http\Requests\ProblemRequest;

class ProblemController extends Controller
{
    public function index(Request $request)
    {
      if(Auth::user()->role->slug == 'Admin'){
        $id = $request['id'];
        $obj = Area::find($id);
        $data = Problem::where('area_id', $id)->get();
        $display = "<h3>ปัญหาชุมชน : ".$obj->name."</h3>";
        $display .= "<h4>รายการปัญหาที่พบ</h4>";
        $display .= "
        <table  class='table table-bordered table-striped'>
          <thead>
          <tr>
            <th>ลำดับ</th>
            <th>หัวข้อปัญหา</th>
            <th>กลุ่มปัญหา</th>
            <th>สถานะ</th>
            <th>ดำเนินการ</th>
          </tr>
          </thead>
          <tbody>
        ";
        $i=1;
        foreach ($data as $key) {
          $status=' ';
          $display .= "
          <tr>
            <td>".$i++."</td>
            <td>
            <a data-id='$key->id' href='#de' class='titledetail'><i class='fa fa-fw fa-comments-o'></i>$key->title</a>
            </td>
            <td>".$key->taggroup->groupname."</td>
            <td>";
            if($key->status=='1'){ $status="<span class='label label-danger'>รอดำเนินการ</span>";}
            else if($key->status=='2'){ $status="<span class='label label-warning'>กำลังดำเนินการ</span>";}
            else if($key->status=='3'){ $status="<span class='label label-success'>ดำเนินการแล้วเสร็จ</span>";}
            $display .= $status;
            $display .= "</td>
            <td>
            <a data-id='$key->id' href='#m' class='btn btn-warning btn-xs editprobm'><i class='fa fa-fw fa-edit'></i> แก้ไข</a>
            <a data-id='$key->id' href='#' class='btn btn-danger btn-xs deleteprobm'><i class='fa fa-fw fa-trash-o'></i> ลบข้อมูล</a>
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
      if(Auth::user()->role->slug == 'University'){
        $id = $request['id'];
        $obj = Area::find($id);
        if(Auth::user()->university_id == $obj->university_id){
          $data = Problem::where('area_id', $id)->get();
          $display = "<h3>ปัญหาชุมชน : ".$obj->name."</h3>";
          $display .= "<h4>รายการปัญหาที่พบ</h4>";
          $display .= "
          <table  class='table table-bordered table-striped'>
            <thead>
            <tr>
              <th>ลำดับ</th>
              <th>หัวข้อปัญหา</th>
              <th>กลุ่มปัญหา</th>
              <th>สถานะ</th>
              <th>ดำเนินการ</th>
            </tr>
            </thead>
            <tbody>
          ";
          $i=1;
          foreach ($data as $key) {
            $status=' ';
            $display .= "
            <tr>
              <td>".$i++."</td>
              <td>
              <a data-id='$key->id' href='#de' class='titledetail'><i class='fa fa-fw fa-comments-o'></i>$key->title</a>
              </td>
              <td>".$key->taggroup->groupname."</td>
              <td>";
              if($key->status=='1'){ $status="<span class='label label-danger'>รอดำเนินการ</span>";}
              else if($key->status=='2'){ $status="<span class='label label-warning'>กำลังดำเนินการ</span>";}
              else if($key->status=='3'){ $status="<span class='label label-success'>ดำเนินการแล้วเสร็จ</span>";}
              $display .= $status."</td>
              <td>
              <a data-id='$key->id' href='#m' class='btn btn-warning btn-xs editprobm'><i class='fa fa-fw fa-edit'></i> แก้ไข</a>
              <a data-id='$key->id' href='#' class='btn btn-danger btn-xs deleteprobm'><i class='fa fa-fw fa-trash-o'></i> ลบข้อมูล</a>
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
      }
    }

    public function create()
    {
      //
    }

    public function store(ProblemRequest $request)
    {
      if(Auth::user()->role->slug == 'Admin'){
        $obj = new Problem();
        $obj->taggroup_id = $request->input('taggroup_id');
        $obj->area_id = $request->input('area_id');
        $obj->title = $request->input('title');
        $obj->detail = $request->input('detail');
        $obj->instruct = $request->input('instruct');
        $obj->status = $request->input('status');
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}
      }
      if(Auth::user()->role->slug == 'University'){
        $ida = $request->input('area_id');
        $obja = Area::find($ida);
        if(Auth::user()->university_id == $obja->university_id){
          $obj = new Problem();
          $obj->taggroup_id = $request->input('taggroup_id');
          $obj->area_id = $request->input('area_id');
          $obj->title = $request->input('title');
          $obj->detail = $request->input('detail');
          $obj->instruct = $request->input('instruct');
          $obj->status = $request->input('status');
          $check = $obj->save();
          if($check>0){return 0;}else{return 1;}
        }
        abort(0);
      }

    }
    public function show($id)
    {
      if(Auth::user()->role->slug == 'Admin'){
        $obj = Problem::find($id);
        $display = "<h3>ปัญหาชุมชน : ".$obj->area->name."</h3>";
        $display .= "<h4>กลุ่มปัญหา : ".$obj->taggroup->groupname."</h4>";
        $display .= "
        <table  class='table table-bordered'>
          <tr>
            <td style='width:150px'><h4><i class='fa fa-fw fa-comments-o'></i> หัวข้อปัญหา</h4></td>
            <td>".$obj->title."</td>
          </tr>
          <tr>
            <td><h4><i class='fa fa-fw fa-file-text-o'></i> รายละเอียด</h4></td>
            <td>".$obj->detail."</td>
          </tr>
          <tr>
            <td><h4><i class='fa fa-fw fa-file-o'></i> ประเด็นปัญหา</h4></td>
            <td>".$obj->instruct."</td>
          </tr>
        </table>
        ";
        return $display;
      }
      if(Auth::user()->role->slug == 'University'){
        $objpro = Problem::find($id);
        if(Auth::user()->university_id == $objpro->area->university_id){
          $obj = Problem::find($id);
          $display = "<h3>ปัญหาชุมชน : ".$obj->area->name."</h3>";
          $display .= "<h4>กลุ่มปัญหา : ".$obj->taggroup->groupname."</h4>";
          $display .= "
          <table  class='table table-bordered'>
            <tr>
              <td style='width:150px'><h4><i class='fa fa-fw fa-comments-o'></i> หัวข้อปัญหา</h4></td>
              <td>".$obj->title."</td>
            </tr>
            <tr>
              <td><h4><i class='fa fa-fw fa-file-text-o'></i> รายละเอียด</h4></td>
              <td>".$obj->detail."</td>
            </tr>
            <tr>
              <td><h4><i class='fa fa-fw fa-file-o'></i> ประเด็นปัญหา</h4></td>
              <td>".$obj->instruct."</td>
            </tr>
          </table>
          ";
          return $display;
        }
        abort(0);
      }

    }

    public function edit($id)
    {
      if(Auth::user()->role->slug == 'Admin'){
        $data = Problem::find($id);
        return $data->toArray();
      }
      if(Auth::user()->role->slug == 'University'){
        $objpro = Problem::find($id);
        if(Auth::user()->university_id == $objpro->area->university_id){
          $data = Problem::find($id);
          return $data->toArray();
        }
        abort(0);
      }
    }

    public function update(ProblemRequest $request, $id)
    {
      if(Auth::user()->role->slug == 'Admin'){
        $obj = problem::findOrFail($id);
        $obj->taggroup_id = $request['taggroup_id'];
        $obj->title = $request['title'];
        $obj->detail = $request['detail'];
        $obj->instruct = $request['instruct'];
        $obj->status = $request['status'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}
      }
      if(Auth::user()->role->slug == 'University'){
        $objpro = Problem::find($id);
        if(Auth::user()->university_id == $objpro->area->university_id){
          $obj = problem::findOrFail($id);
          $obj->taggroup_id = $request['taggroup_id'];
          $obj->title = $request['title'];
          $obj->detail = $request['detail'];
          $obj->instruct = $request['instruct'];
          $obj->status = $request['status'];
          $check = $obj->save();
          if($check>0){return 0;}else{return 1;}
        }
        abort(0);
      }
    }

    public function destroy($id)
    {
      if(Auth::user()->role->slug == 'Admin'){
        $data = Problem::find($id);
    		$check = $data->delete();
        if($check>0){return 0;}else{return 1;}
      }
      if(Auth::user()->role->slug == 'University'){
        $objpro = Problem::find($id);
        if(Auth::user()->university_id == $objpro->area->university_id){
          $data = Problem::find($id);
      		$check = $data->delete();
          if($check>0){return 0;}else{return 1;}
        }
        abort(0);
      }
    }
}
