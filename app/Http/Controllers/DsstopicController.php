<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;

use App\Researcher;
use App\Research;
use App\Expert;
use App\Expertlist;
use App\Creative;
use App\Area;
use App\Problem;

use App\University;
use App\Taggroup;

class DsstopicController extends Controller
{
  public function getTopic(Request $request)
  {
    $search = $request->input('search');
    $data = [
        'search' => $search,
    ];
    return view('dss/topic', $data);
  }


  public function postTopic(Request $request)
  {
      return $this->getTopic($request);
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

}
