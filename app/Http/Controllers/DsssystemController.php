<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Researcher;
use App\Research;
use App\Expert;
use App\Expertlist;
use App\Creative;
use App\Area;
use App\Problem;

use App\University;
use App\Taggroup;

class DsssystemController extends Controller
{

  public function getSystem()
  {
    $objtag = Taggroup::get();
    return view('dss.system',compact('objtag'));
  }

  public function showResch(Request $request)
  {

    $resch = Researcher::orderby('firstname')->get();

    $display = "<h3>ข้อมูลนักวิจัยทั้งหมด</h3>";
    $display .= "<h4>รายการนักวิจัย</h4>";

    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่อนักวิจัย</th>
        <th>สังกัด</th>
        <th>ข้อมูลติดต่อ</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($resch as $key) {
      $display .= "
      <tr>
        <td>".$i++."</td>
        <td><a href='../eis/profile?id=".$key->id."' target='blank'>".$key->headname.$key->firstname." ".$key->lastname."</a></td>
        <td>".$key->university->name."</td>
        <td>$key->tel, $key->email</td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";
    return $display;
  }

  public function showExp(Request $request)
  {
    $exp = Expert::orderby('firstname')->get();

    $display = "<h3>ข้อมูลผู้เชี่ยวชาญทั้งหมด</h3>";
    $display .= "<h4>รายการผู้เชี่ยวชาญ</h4>";

    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่อผู้เชี่ยวชาญ</th>
        <th>สังกัด</th>
        <th>ข้อมูลติดต่อ</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($exp as $key) {
      $display .= "
      <tr>
        <td>".$i++."</td>
        <td><a href='../eis/profileexp?id=".$key->id."' target='blank'>".$key->headname.$key->firstname." ".$key->lastname."</a></td>
        <td>".$key->area->name." : ".$key->area->university->name."</td>
        <td>$key->tel, $key->email</td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";
    return $display;
  }

  public function showRes(Request $request)
  {
    $res = Research::orderby('title_th')->get();

    $display = "<h3>ข้อมูลงานวิจัยทั้งหมด</h3>";
    $display .= "<h4>รายการงานวิจัย</h4>";

    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่องานวิจัย</th>
        <th>ผู้วิจัย</th>
        <th>สังกัด</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($res as $key) {
      $display .= "
      <tr>
        <td width='50'>".$i++."</td>
        <td><a href='../eis/profileresearch?id=".$key->id."' target='blank'>".$key->title_th."</a></td>
        <td>".$key->researcher->headname.$key->researcher->firstname." ".$key->researcher->lastname."</td>
        <td>".$key->researcher->university->name."</td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";
    return $display;
  }

  public function showCre(Request $request)
  {
    $res = Creative::orderby('title')->get();

    $display = "<h3>ข้อมูลผลงานสร้างสรรค์ทั้งหมด</h3>";
    $display .= "<h4>รายการงานสร้างสรรค์</h4>";

    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่องานสร้างสรรค์</th>
        <th>เจ้าของผลงาน</th>
        <th>สังกัด</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($res as $key) {
      $display .= "
      <tr>
        <td width='50'>".$i++."</td>
        <td><a href='../eis/profilecreative?id=".$key->id."' target='blank'>".$key->title."</a></td>
        <td>".$key->researcher->headname.$key->researcher->firstname." ".$key->researcher->lastname."</td>
        <td>".$key->researcher->university->name."</td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";
    return $display;
  }

  public function showAre(Request $request)
  {
    $res = Area::orderby('name')->get();

    $display = "<h3>ข้อมูลพื้นที่ชุมชนทั้งหมด</h3>";
    $display .= "<h4>รายการพื้นที่ชุมชน</h4>";

    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>พื้นที่ชุมชน</th>
        <th>สังกัด</th>
        <th>มหาวิทยาลัย</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($res as $key) {
      $display .= "
      <tr>
        <td width='50'>".$i++."</td>
        <td><a href='../eis/profilearea?id=".$key->id."' target='blank'>".$key->name."</a></td>
        <td>".$key->name." : ".$key->center->name."</td>
        <td>".$key->university->name."</td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";
    return $display;
  }

  public function showPro(Request $request)
  {
    $res = Problem::orderby('title')->get();

    $display = "<h3>ข้อมูลปัญหาชุมชนทั้งหมด</h3>";
    $display .= "<h4>รายการปัญหาชุมชน</h4>";

    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ปัญหาชุมชน</th>
        <th>สังกัด</th>
        <th>มหาวิทยาลัย</th>
        <th>สถานะ</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($res as $key) {
      $status=' ';
      $display .= "
      <tr>
        <td width='50'>".$i++."</td>
        <td><a href='../eis/profilepro?id=".$key->id."' target='blank'>".$key->title."</a></td>
        <td>".$key->area->name." ".$key->area->center->name."</td>
        <td>".$key->area->university->name."</td>
        <td>";
        if($key->status=='1'){ $status="<span class='label label-danger'>รอดำเนินการ</span>";}
        else if($key->status=='2'){ $status="<span class='label label-warning'>กำลังดำเนินการ</span>";}
        else if($key->status=='3'){ $status="<span class='label label-success'>ดำเนินการแล้วเสร็จ</span>";}
        $display .= $status;
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
    $tagresch = Expertlist::where('taggroup_id', $id)->where('expert_id',0)->get();
    $tagexp = Expertlist::where('taggroup_id', $id)->where('researcher_id',0)->get();
    $tagres = Research::where('taggroup_id', $id)->get();
    $tagcre = Creative::where('taggroup_id', $id)->get();
    $tagpro = Problem::where('taggroup_id', $id)->get();

    $display = "<h3>สรุปข้อมูลตามกลุ่ม : ".$obj->groupname."</h3>";

    $display .= "<h4>ข้อมูลนักวิจัย</h4>";
    $display .= "
    <table class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่อนักวิจัย</th>
        <th>ความเชี่ยวชาญ</th>
        <th>สังกัด</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($tagresch as $key) {
      $display .= "
      <tr>
        <td width='50'>".$i++."</td>
        <td><a href='../eis/profile?id=".$key->researcher_id."' target='blank'>".$key->researcher->headname.$key->researcher->firstname." ".$key->researcher->lastname."</a></td>
        <td>$key->title_th<br>$key->title_eng</td>
        <td>".$key->researcher->university->name."</td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";

    $display .= "<h4>ข้อมูลผู้เชี่ยวชาญ</h4>";
    $display .= "
    <table class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่อผู้เชี่ยวชาญ</th>
        <th>ความเชี่ยวชาญ</th>
        <th>สังกัด</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($tagexp as $key) {
      $display .= "
      <tr>
        <td width='50'>".$i++."</td>
        <td><a href='../eis/profileexp?id=".$key->expert_id."' target='blank'>".$key->expert->headname.$key->expert->firstname." ".$key->expert->lastname."</a></td>
        <td>$key->title_th<br>$key->title_eng</td>
        <td>".$key->expert->area->name." : ".$key->expert->area->center->university->name."</td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";

    $display .= "<h4>ข้อมูลงานวิจัย</h4>";
    $display .= "
    <table class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่องานวิจัย</th>
        <th>นักวิจัย</th>
        <th>สังกัด</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($tagres as $key) {
      $display .= "
      <tr>
        <td width='50'>".$i++."</td>
        <td><a href='../eis/profileresearch?id=".$key->id."' target='blank'>".$key->title_th."</a></td>
        <td>".$key->researcher->headname.$key->researcher->firstname." ".$key->researcher->lastname."</td>
        <td>".$key->researcher->university->name."</td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";

    $display .= "<h4>ข้อมูลงานสร้างสรรค์</h4>";
    $display .= "
    <table class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่อผลงานสร้างสรรค์</th>
        <th>เจ้าของผลงาน</th>
        <th>สังกัด</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($tagcre as $key) {
      $display .= "
      <tr>
        <td width='50'>".$i++."</td>
        <td><a href='../eis/profilecreative?id=".$key->id."' target='blank'>".$key->title."</a></td>
        <td>".$key->researcher->headname.$key->researcher->firstname." ".$key->researcher->lastname."</td>
        <td>".$key->researcher->university->name."</td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";

    $display .= "<h4>ข้อมูลพื้นที่และปัญหาชุมชน</h4>";
    $display .= "
    <table class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ปัญหาในพื้นที่</th>
        <th>พื้นที่ชุมชน</th>
        <th>สังกัด</th>
        <th>สถานะ</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($tagpro as $key) {
      $status=' ';
      $display .= "
      <tr>
        <td width='50'>".$i++."</td>
        <td><a href='../eis/profilepro?id=".$key->id."' target='blank'>".$key->title."</td>
        <td>".$key->area->name."</a></td>
        <td>".$key->area->center->university->name."</td>
        <td>";
        if($key->status=='1'){ $status="<span class='label label-danger'>รอดำเนินการ</span>";}
        else if($key->status=='2'){ $status="<span class='label label-warning'>กำลังดำเนินการ</span>";}
        else if($key->status=='3'){ $status="<span class='label label-success'>ดำเนินการแล้วเสร็จ</span>";}
        $display .= $status;
        $display .="</td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";
    return $display;
  }

  public function listResch(Request $request)
  {
    $idtag = $request['id'];
    $objtag = Taggroup::find($idtag);
    $objresch = Researcher::leftJoin('expertlists','researchers.id','=','expertlists.researcher_id')
    ->select('researchers.*','expertlists.title_th')
    ->where('expertlists.taggroup_id',$idtag)
    ->orderby('researchers.firstname')
    ->get();

    $display = "<h3>ข้อมูลนักวิจัย</h3>";
    $display .= "<h4>รายการนักวิจัย กลุ่ม".$objtag->groupname."</h4>";

    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่อนักวิจัย</th>
        <th>ความเชี่ยวชาญ</th>
        <th>สังกัด</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($objresch as $key) {
      $display .= "
      <tr>
        <td width='50'>".$i++."</td>
        <td><a href='../eis/profile?id=".$key->id."' target='blank'>".$key->headname.$key->firstname." ".$key->lastname."</a></td>
        <td>".$key->title_th."</td>
        <td>".$key->university->name."</td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";
    return $display;
  }

  public function listExp(Request $request)
  {
    $idtag = $request['id'];
    $objtag = Taggroup::find($idtag);
    $objexp = Expert::leftJoin('expertlists','experts.id','=','expertlists.expert_id')
    ->select('experts.*','expertlists.title_th')
    ->where('expertlists.taggroup_id',$idtag)
    ->orderby('experts.firstname')
    ->get();

    $display = "<h3>ข้อมูลผู้เชี่ยวชาญ</h3>";
    $display .= "<h4>รายการผู้เชี่ยวชาญ กลุ่ม".$objtag->groupname."</h4>";

    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่อผู้เชี่ยวชาญ</th>
        <th>ความเชี่ยวชาญ</th>
        <th>สังกัด</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($objexp as $key) {
      $display .= "
      <tr>
        <td width='50'>".$i++."</td>
        <td><a href='../eis/profileexp?id=".$key->id."' target='blank'>".$key->headname.$key->firstname." ".$key->lastname."</a></td>
        <td>".$key->title_th."</td>
        <td>".$key->area->university->name."</td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";
    return $display;
  }

  public function listRes(Request $request)
  {
    $idtag = $request['id'];
    $objtag = Taggroup::find($idtag);
    $objres = Research::where('taggroup_id',$idtag)
    ->orderby('title_th')
    ->get();

    $display = "<h3>ข้อมูลงานวิจัย</h3>";
    $display .= "<h4>รายการงานวิจัย กลุ่ม".$objtag->groupname."</h4>";

    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>งานวิจัย</th>
        <th>ผู้วิจัย</th>
        <th>สังกัด</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($objres as $key) {
      $display .= "
      <tr>
        <td width='50'>".$i++."</td>
        <td><a href='../eis/profileresearch?id=".$key->id."' target='blank'>".$key->title_th."</td>
        <td>".$key->researcher->headname.$key->researcher->firstname." ".$key->researcher->lastname."</a></td>
        <td>".$key->researcher->university->name."</td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";
    return $display;
  }

  public function listCre(Request $request)
  {
    $idtag = $request['id'];
    $objtag = Taggroup::find($idtag);
    $objcre = Creative::where('taggroup_id',$idtag)
    ->orderby('title')
    ->get();

    $display = "<h3>ข้อมูลงานสร้างสรรค์</h3>";
    $display .= "<h4>รายการงานสร้างสรรค์ กลุ่ม".$objtag->groupname."</h4>";

    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>งานสร้างสรรค์</th>
        <th>เจ้าของผลงาน</th>
        <th>สังกัด</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($objcre as $key) {
      $display .= "
      <tr>
        <td width='50'>".$i++."</td>
        <td><a href='../eis/profilecreative?id=".$key->id."' target='blank'>".$key->title."</td>
        <td>".$key->researcher->headname.$key->researcher->firstname." ".$key->researcher->lastname."</a></td>
        <td>".$key->researcher->university->name."</td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";
    return $display;
  }

  public function listAre(Request $request)
  {
    $idtag = $request['id'];
    $objtag = Taggroup::find($idtag);
    $objare = Area::leftJoin('problems','areas.id','=','problems.area_id')
    ->select('areas.*')
    ->where('problems.taggroup_id',$idtag)
    ->orderby('areas.name')
    ->groupBy('area_id')->get();

    $display = "<h3>ข้อมูลพื้นที่ชุมชน</h3>";
    $display .= "<h4>รายการพื้นที่ชุมชน กลุ่ม".$objtag->groupname."</h4>";

    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ชื่อพื้นที่ชุมชน</th>
        <th>สังกัด</th>
        <th>มหาวิทยาลัย</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($objare as $key) {
      $display .= "
      <tr>
        <td width='50'>".$i++."</td>
        <td><a href='../eis/profilearea?id=".$key->id."' target='blank'>".$key->name."</a></td>
        <td>".$key->center->name."</td>
        <td>".$key->university->name."</td>
      </tr>
      ";
    }
    $display .= "
      </tbody>
    </table>
    ";
    return $display;
  }

  public function listPro(Request $request)
  {
    $idtag = $request['id'];
    $objtag = Taggroup::find($idtag);
    $objpro = Problem::where('taggroup_id',$idtag)
    ->orderby('title')
    ->get();

    $display = "<h3>ข้อมูลปัญหาชุมชน</h3>";
    $display .= "<h4>รายการปัญหาชุมชน กลุ่ม".$objtag->groupname."</h4>";

    $display .= "
    <table id='example1' class='table table-bordered table-striped'>
      <thead>
      <tr>
        <th>ลำดับ</th>
        <th>ปัญหาพื้นที่ชุมชน</th>
        <th>พื้นที่ชุมชน</th>
        <th>สังกัด</th>
        <th>สถานะ</th>
      </tr>
      </thead>
      <tbody>
    ";
    $i=1;
    foreach ($objpro as $key) {
      $status=' ';
      $display .= "
      <tr>
        <td width='50'>".$i++."</td>
        <td><a href='../eis/profilepro?id=".$key->id."' target='blank'>".$key->title."</td>
        <td>".$key->area->name."</a></td>
        <td>".$key->area->university->name."</td>
        <td>";
        if($key->status=='1'){ $status="<span class='label label-danger'>รอดำเนินการ</span>";}
        else if($key->status=='2'){ $status="<span class='label label-warning'>กำลังดำเนินการ</span>";}
        else if($key->status=='3'){ $status="<span class='label label-success'>ดำเนินการแล้วเสร็จ</span>";}
        $display .= $status;
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
