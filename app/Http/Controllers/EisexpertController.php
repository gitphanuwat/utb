<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Researcher;
use App\Expert;
use App\Expertlist;
use App\Research;
use App\Creative;
use App\Area;

use App\University;
use App\Taggroup;

class EisexpertController extends Controller
{

  public function getExpert()
  {
    $objexpert = Expert::orderby('firstname')->get();
    return view('eis.expert',compact('objexpert'));
  }

  public function showExpertlist(Request $request)
  {
    $id = $request['id'];
    $obj = Expert::find($id);
    $data = Expertlist::where('expert_id', $id)->orderby('title_th')->get();
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
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";
    return $display;
  }

  public function showExpertor(Request $request)
  {
    $id = $request['id'];
    $obj = University::find($id);

    $exp = Expert::leftJoin('areas', 'experts.area_id', '=', 'areas.id')
    ->select('experts.*', 'areas.university_id', 'areas.name')
    ->where('areas.university_id', $id)
    ->orderby('experts.firstname')
    ->get();

    $display = "<h3>มหาวิทยาลัย : ".$obj->name."</h3>";
    $display .= "<h4>รายการผู้เชี่ยวชาญ</h4>";

    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่อผู้เชี่ยวชาญ</th>";
        if(Auth::user()){
          $display .= "<th>เบอร์โทร</th>";
        }
        $display .= "<th>อีเมล์</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($exp as $key) {
      $display .= "
      <tr>
        <td>".$i++."</td>
        <td><a href='profileexp?id=".$key->id."' target='blank'>".$key->headname.$key->firstname." ".$key->lastname."</a></td>";
        if(Auth::user()){
          $display .= "<td>$key->tel</td>";
        }
        $display .="<td>$key->email</td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";
    return $display;
  }

  public function showGroupexp(Request $request)
  {
    $id = $request['id'];
    $obj = Taggroup::find($id);
    $data = Expertlist::where('taggroup_id', $id)
    ->where('researcher_id',0)
    ->orderby('title_th')
    ->get();

    $display = "<h3>กลุ่มความเชี่ยวชาญ : ".$obj->groupname."</h3>";
    $display .= "<h4>รายการความเชี่ยวชาญ</h4>";

    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่อผู้เชี่ยวชาญ</th>
        <th>ความเชี่ยวชาญ (ไทย)</th>
        <th>ความเชี่ยวชาญ (eng)</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($data as $key) {
      $display .= "
      <tr>
        <td>".$i++."</td>
        <td><a href='profileexp?id=".$key->expert_id."' target='blank'>".$key->expert->headname.$key->expert->firstname." ".$key->expert->lastname."</a></td>
        <td>$key->title_th</td>
        <td>$key->title_eng</td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";
    return $display;
  }

  public function expertname($id)
  {
    $data = Expert::find($id);
    $display = [
      'id' => $data->id,
      'name' =>  $data->firstname.' '.$data->lastname,
    ];
    return $display;
  }


}
