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

class EisresearcherController extends Controller
{
  public function getResearcher()
  {
    $objresearcher = Researcher::orderby('firstname')->get();
    return view('eis.researcher',compact('objresearcher'));
  }
  public function showExpert(Request $request)
  {
    $id = $request['id'];
    $obj = Researcher::find($id);
    $data = Expertlist::where('researcher_id', $id)->orderby('title_th')->get();
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

  public function showResearch(Request $request){
    $id = $request['id'];
    $obj = Researcher::find($id);
    $data = Research::where('researcher_id', $id)->orderby('title_th')->get();
    $display = "<h3>นักวิจัย : ".$obj->headname.$obj->firstname." ".$obj->lastname."</h3>";
    $display .= "<h4>รายการงานวิจัย</h4>";
    $display.="
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่องานวิจัย</th>
        <th>ชื่อนักวิจัยและผู้ร่วมวิจัย</th>
        <th>เอกสาร</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($data as $key) {
      $display .= "
      <tr>
        <td>".$i++."</td>
        <td><a href='profileresearch?id=".$key->id."' target='blank'>$key->title_th<a/></td>
        <td>".$key->researcher->headname.$key->researcher->firstname." ".$key->researcher->lastname.", ".$key->contributor."</td>
        <td>";
        foreach ($key->doc as $doc) {
          $display .= "<a href='".route('getfile', $doc->file)."' target='blank'>".$doc->title."</a><br>";
        }
        $display .= "
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


  public function showCreative(Request $request){

    $id = $request['id'];
    $obj = Researcher::find($id);
    $data = Creative::where('researcher_id', $id)->orderby('title')->get();
    $display = "<h3>นักวิจัย : ".$obj->headname.$obj->firstname." ".$obj->lastname."</h3>";
    $display .= "<h4>รายการผลงานสร้างสรรค์</h4>";

    $display.="
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่องานสร้างสรรค์</th>
        <th>ชื่อเจ้าของผลงานและผู้ร่วม</th>
        <th>เอกสาร</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($data as $key) {
      $display .= "
      <tr>
        <td>".$i++."</td>
        <td><a href='profilecreative?id=".$key->id."' target='blank'>$key->title</a></td>
        <td>".$key->researcher->headname.$key->researcher->firstname." ".$key->researcher->lastname.", ".$key->contribute."</td>
        <td>";
          $display .= "<a href='".route('getfile', $key->file)."'>".$key->title."</a><br>";
        $display .= "
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

  public function showGroup(Request $request)
  {
    $id = $request['id'];
    $obj = Taggroup::find($id);
    $data = Expertlist::where('taggroup_id', $id)
    ->where('expert_id',0)
    ->orderby('title_th')
    ->get();
    $display = "<h3>กลุ่มความเชี่ยวชาญ : ".$obj->groupname."</h3>";
    $display .= "<h4>รายการความเชี่ยวชาญ</h4>";

    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่อนักวิจัย</th>
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
        <td><a href='profile?id=".$key->researcher_id."' target='blank'>".$key->researcher->headname.$key->researcher->firstname." ".$key->researcher->lastname."</a></td>
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

  public function showresearcher(Request $request)
  {
    $id = $request['id'];
    $obj = University::find($id);
    $data = Researcher::where('university_id', $id)
    ->orderby('firstname')
    ->get();
    $display = "<h3>มหาวิทยาลัย : ".$obj->name."</h3>";
    $display .= "<h4>รายการนักวิจัย</h4>";

    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่อนักวิจัย</th>";
        if(Auth::user()){
          $display .= "<th>เบอร์โทร</th>";
        }
        $display .= "<th>อีเมล์</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($data as $key) {
      $display .= "
      <tr>
        <td>".$i++."</td>
        <td><a href='profile?id=".$key->id."' target='blank'>".$key->headname.$key->firstname." ".$key->lastname."</a></td>";
        if(Auth::user()){
          $display .= "<td>$key->tel</td>";
        }
        $display .= "<td>$key->email</td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";
    return $display;
  }

  public function researchername($id)
  {
    $data = Researcher::find($id);
    $display = [
      'id' => $data->id,
      'name' =>  $data->firstname.' '.$data->lastname,
    ];
    return $display;
  }

}
