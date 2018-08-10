<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Researcher;
use App\Research;
use App\Creative;
use App\Area;

use App\University;
use App\Taggroup;

class EiscreativeController extends Controller
{

  public function getCreative()
  {
    $objcreative = Creative::orderby('title')->get();
    return view('eis.creative',compact('objcreative'));
  }

  public function showCreative(Request $request)
  {
    $id = $request['id'];
    $obj = University::find($id);

    $exp = Creative::leftJoin('researchers', 'creatives.researcher_id', '=', 'researchers.id')
    //->select('experts.*', 'areas.university_id', 'areas.name')
    ->where('researchers.university_id', $id)
    ->orderby('creatives.title')
    ->get();

    $display = "<h3>มหาวิทยาลัย : ".$obj->name."</h3>";
    $display .= "<h4>รายการผลงานสร้างสรรค์</h4>";

    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่อผลงานสร้างสรรค์</th>
        <th>เจ้าของผลงาน</th>
        <th>เอกสาร</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($exp as $key) {
      $display .= "
      <tr>
      <td width='50'>".$i++."</td>
      <td><a href='profilecreative?id=".$key->id."' target='blank'>".$key->title."</a>
      </td>
      <td>".$key->researcher->headname.$key->researcher->firstname."".$key->researcher->lastname."</td>
        <td>";
        if($key->file){
          $display .= "<a href='".route('getfile', $key->file)."' target='blank' class='btn btn-warning btn-xs'>Download</a>";
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

  public function showGroup(Request $request)
  {
    $id = $request['id'];
    $obj = Taggroup::find($id);
    $data = Creative::where('taggroup_id', $id)
    ->orderby('title')
    ->get();

    $display = "<h3>กลุ่มผลงานสร้างสรรค์ : ".$obj->groupname."</h3>";
    $display .= "<h4>รายการงานสร้างสรรค์</h4>";

    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่อผลงานสร้างสรรค์</th>
        <th>เจ้าของผลงาน</th>
        <th>มหาวิทยาลัย</th>
        <th>เอกสาร</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($data as $key) {
      $display .= "
      <tr>
      <td width='50'>".$i++."</td>
      <td><a href='profilecreative?id=".$key->id."' target='blank'>".$key->title."</a>
      </td>
      <td>".$key->researcher->headname.$key->researcher->firstname."".$key->researcher->lastname."</td>
      <td>".$key->researcher_id."</td>
        <td>";
        if($key->file){
          $display .= "<a href='".route('getfile', $key->file)."' target='blank' class='btn btn-warning btn-xs'>Download</a>";
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

}
