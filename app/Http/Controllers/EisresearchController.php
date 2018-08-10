<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Researcher;
use App\Expert;
use App\Expertlist;
use App\Research;
use App\Creative;
use App\Area;
use App\Doc;

use App\University;
use App\Taggroup;

class EisresearchController extends Controller
{
  //for Research
  public function getResearch()
  {
    $objres = Research::orderby('title_th')->get();
    return view('eis.research',compact('objres'));
  }

  public function showResearch(Request $request)
  {
    $id = $request['id'];
    $obj = University::find($id);
    $data = Research::leftJoin('researchers','researchs.researcher_id','=','researchers.id')
    ->select('researchs.*','researchers.headname','researchers.firstname','researchers.lastname')
    ->where('researchers.university_id', $id)
    ->orderby('researchs.title_th')
    ->get();
    $display = "<h3>มหาวิทยาลัย : ".$obj->name."</h3>";
    $display .= "<h4>รายการงานวิจัย</h4>";

    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
          <th>ลำดับ</th>
          <th>ชื่องานวิจัย</th>
          <th>นักวิจัยและผู้ร่วม</th>
          <th>เอกสาร</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($data as $key) {
      $iddoc = $key->id;
      $objdoc = Doc::where('research_id',$iddoc)->orderby('title')->get();
      $display .= "
      <tr>
          <td width='50'>".$i++."</td>
          <td><a href='profileresearch?id=".$key->id."' target='blank'>".$key->title_th."</a></td>
          <td>".$key->researcher->headname.$key->researcher->firstname." ".$key->researcher->lastname."</td>
          <td>";
          foreach ($objdoc as $doc) {
            $display .= "<a href='".route('getfile',$doc->file)."' target='blank'>".$doc->title."</a><br>";
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


  public function showGroup(Request $request)
  {
    $id = $request['id'];
    $obj = Taggroup::find($id);
    $data = Research::where('taggroup_id', $id)
    ->orderby('title_th')
    ->get();

    $display = "<h3>กลุ่มงานวิจัย : ".$obj->groupname."</h3>";
    $display .= "<h4>รายการงานวิจัย</h4>";

    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่องานวิจัย</th>
        <th>นักวิจัยและผู้ร่วม</th>
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
        <td><a href='profileresearch?id=".$key->id."' target='blank'>".$key->title_th."</a></td>
        <td>".$key->researcher->headname.$key->researcher->firstname." ".$key->researcher->lastname."</td>

        <td>";
        foreach ($key->doc as $doc) {
          $display .= "<a href='".route('getfile', $doc->file)."'>".$doc->title."</a><br>";
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

  public function showDoc(Request $request)
  {
    $id = $request['id'];
    $data = Research::find($id);
    $display = "<h3>งานวิจัย : ".$data->title_th."</h3>";
    $display .= "<h4>นักวิจัย : ".$data->researcher->headname.$data->researcher->firstname." ".$data->researcher->lastname."</h4>";
    $display .= "<h4>รายการเอกสาร</h4>";

    $display .= "
    <table  class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่อเอกสาร</th>
        <th>ไฟล์เอกสาร</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($data->doc as $doc) {
      $display .= "
      <tr>
        <td width='50'>".$i++."</td>
        <td>$doc->title</td>
        <td><a href='".route('getfile', $doc->file)."' target='blank'>".$doc->title."</a></td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";
    return $display;
  }

//end
}
