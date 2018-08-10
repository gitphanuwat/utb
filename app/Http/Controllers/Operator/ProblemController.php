<?php
namespace App\Http\Controllers\Operator;
use App\Http\Controllers\Controller;
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
        $id = $request['id'];
        $obj = Area::find($id);
        if(Auth::user()->area_id == $obj->id){
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
              <th>ประเด็นปัญหา</th>
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
              <td>
              <a data-id='$key->id' href='#de' class='titledetail'><i class='fa fa-fw fa-comments-o'></i>$key->title</a>
              </td>
              <td>".$key->taggroup->groupname."</td>
              <td>".$key->instruct."</td>
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
        abort(0);
    }

    public function create()
    {
      //
    }

    public function store(ProblemRequest $request)
    {
        $ida = $request->input('area_id');
        $obja = Area::find($ida);
        if(Auth::user()->area_id == $obja->id){
          $obj = new Problem();
          $obj->taggroup_id = $request->input('taggroup_id');
          $obj->area_id = $request->input('area_id');
          $obj->title = $request->input('title');
          $obj->detail = $request->input('detail');
          $obj->instruct = $request->input('instruct');
          $check = $obj->save();
          if($check>0){return 0;}else{return 1;}
        }
        abort(0);

    }
    public function show($id)
    {
        $objpro = Problem::find($id);
        if(Auth::user()->area_id == $objpro->area->id){
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

    public function edit($id)
    {
        $objpro = Problem::find($id);
        if(Auth::user()->area_id == $objpro->area->id){
          $data = Problem::find($id);
          return $data->toArray();
        }
        abort(0);
    }

    public function update(ProblemRequest $request, $id)
    {
        $objpro = Problem::find($id);
        if(Auth::user()->area_id == $objpro->area->id){
          $obj = problem::findOrFail($id);
          $obj->taggroup_id = $request['taggroup_id'];
          $obj->title = $request['title'];
          $obj->detail = $request['detail'];
          $obj->instruct = $request['instruct'];
          $check = $obj->save();
          if($check>0){return 0;}else{return 1;}
        }
        abort(0);
    }

    public function destroy($id)
    {
        $objpro = Problem::find($id);
        if(Auth::user()->area_id == $objpro->area->id){
          $data = Problem::find($id);
      		$check = $data->delete();
          if($check>0){return 0;}else{return 1;}
        }
        abort(0);
    }
}
