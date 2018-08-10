<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Expert;
use App\Area;
use App\Problem;

use App\University;
use App\Taggroup;

class EisproblemController extends Controller
{
  public function getProblem()
  {
    $objproblem = Problem::orderby('title')->get();
    return view('eis.problem',compact('objproblem'));
  }
  public function showExpert(Request $request)
  {
    $id = $request['id'];
    $obj = Area::find($id);
    $data = Expert::where('area_id', $id)->orderby('firstname')->get();
    $display = "<h3>พื้นที่ชุมชน : ".$obj->name."</h3>";
    $display .= "<h4>รายการผู้เชี่ยวชาญ</h4>";
    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่อผู้เชี่ยวชาญ</th>
        <th>ความเชี่ยวชาญ</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($data as $key) {
      $display .= "
      <tr>
        <td width='50'>".$i++."</td>
        <td><a href='profileexp?id=".$key->id."' target='blank'>".$key->headname.$key->firstname." ".$key->lastname."</a></td>
        <td>";
        foreach ($key->expertlist as $expl) {
          $display .= $expl->title_th."<br>";
        }
        $display .= "</td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";
    return $display;
  }

  public function showProblem(Request $request){
    $id = $request['id'];
    $obj = Area::find($id);

    $data = Problem::leftjoin('areas','problems.area_id','=','areas.id')
    ->select('problems.*')
    ->where('areas.university_id','=',$id)
    ->get();


    $display = "<h3>พื้นที่ : ".$obj->name."</h3>";
    $display .= "<h4>รายการปัญหา</h4>";
    $display.="
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ปัญหา</th>
        <th>สถานะ</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($data as $key) {
      $status=' ';
      $display .= "
      <tr>
        <td width='60'>".$i++."</td>
        <td><h4>เรื่อง : $key->title</h4>
        กลุ่มปัญหา : ".$key->taggroup->groupname."<br>
        รายละเอียด : $key->detail<br>
        ประเด็นปัญหา : $key->instruct</td>
        <td>";
        if($key->status=='1'){ $status="<span class='label label-danger'>รอดำเนินการ</span>";}
        else if($key->status=='2'){ $status="<span class='label label-warning'>กำลังดำเนินการ</span>";}
        else if($key->status=='3'){ $status="<span class='label label-success'>ดำเนินการแล้วเสร็จ</span>";}
        $display .= $status."</td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";
    return $display;
  }


  public function showGroup(Request $request)
  {
    $id = $request['id'];
    $obj = Taggroup::find($id);
    $data = Problem::where('taggroup_id', $id)
    ->orderby('title')
    ->get();
    $display = "<h3>กลุ่มปัญหาในพื้นที่ : ".$obj->groupname."</h3>";
    $display .= "<h4>รายการปัญหา</h4>";


    $i=1;
    foreach ($data as $key) {
      $status=' ';
      $display .= "
        <div class='box collapsed-box'>
          <div class='box-header with-border'>
            <h4>".$key->title."</h4><div class='box-tools pull-right'>";
            if($key->status=='1'){ $status="<span class='label label-danger'>รอดำเนินการ <button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-plus'></i>";}
            else if($key->status=='2'){ $status="<span class='label label-warning'>กำลังดำเนินการ <button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-plus'></i>";}
            else if($key->status=='3'){ $status="<span class='label label-success'>ดำเนินการแล้วเสร็จ <button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-plus'></i>";}
            $display .= $status;
            $display .= "</div>
            พื้นที่ : ".$key->area->name."
            | ศูนย์จัดการ : ".$key->area->center->name."
            | มหาวิทยาลัย : ".$key->area->center->university->name."
          </div>
          <div class='box-body'>
            รายละเอียด : <br>".$key->detail."
            ประเด็นปัญหา : <br>".$key->instruct."<br>
          </div>
        </div>
      ";
    }
    return $display;
  }

}
