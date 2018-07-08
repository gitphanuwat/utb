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
use App\Center;
use App\Problem;

use App\University;
use App\Taggroup;

class ReportController extends Controller
{

  public function getResearcher()
  {
    $objuniver = University::lists('name','id');
    $objtag = Taggroup::lists('groupname','id');
    return view('report.researcher',compact('objuniver','objtag'));
  }

    public function loadResearcher(Request $request)
    {
      $id = $request['id'];
      $idtag = $request['idtag'];
      if($idtag==0){
          if($id==0){
            $objresearcher = Researcher::orderby('firstname')->get();
          }else{
            $objresearcher = Researcher::where('university_id','=',$id)->orderby('firstname')->get();
          }
      }else{
          $objresearcher = Researcher::leftJoin('expertlists','researchers.id','=','expertlists.researcher_id')
          ->where('expertlists.taggroup_id','=',$idtag)->orderby('researchers.firstname')->get();
      }

                $display="
                <table id='example1' class='table table-bordered table-striped'>
                  <thead>
                  <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อนักวิจัย</th>
                    <th>สังกัด</th>
                    <th>อีเมล์</th>";
                    if(Auth::user()){
                      $display .="<th>เบอร์โทร</th>";
                    }

                  $display .="</tr>
                  </thead>
                  <tbody>
                ";
                $i=1;
                foreach ($objresearcher as $key) {
                  $display .= "
                  <tr>
                    <td>".$i++."</td>
                    <td><a href='../eis/profile?id=".$key->id."' target='blank'>".$key->headname.$key->firstname." ".$key->lastname."</a>
                    </td>
                    <td>".$key->university->name."</td>
                    <td>".$key->email."</td>";
                    if(Auth::user()){
                      $display .= "<td>".$key->tel."</td>";
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

  public function getExpert()
  {
    $objuniver = University::lists('name','id');
    $objtag = Taggroup::lists('groupname','id');
    return view('report.expert',compact('objuniver','objtag'));
  }

  public function loadExpert(Request $request)
  {
    $id = $request['id'];
    $idcen = $request['idcen'];
    $idtag = $request['idtag'];

    if($id!=0 and $idcen!=0 and $idtag!=0){
        $d='id+cen+tag';
        $exp = Expert::leftJoin('areas', 'experts.area_id', '=', 'areas.id')
        ->leftJoin('expertlists','experts.id','=','expertlists.expert_id')
        ->select('experts.*', 'areas.university_id', 'areas.name')
        ->where('areas.university_id', $id)
        ->where('areas.center_id', $idcen)
        ->where('expertlists.taggroup_id','=',$idtag)
        ->orderby('experts.firstname')
        ->get();
        $obj1 = University::find($id);
        $obj2 = Center::find($idcen);
        $obj3 = Taggroup::find($idtag);
        $d = "<h4>ผู้เชี่ยวชาญ : ".$obj1->name."<br>ศูนย์ : ".$obj2->name."<br>กลุ่ม : ".$obj3->groupname."</h4>";
    }elseif($id!=0 and $idcen!=0){
        $d='id+cen';
        $exp = Expert::leftJoin('areas', 'experts.area_id', '=', 'areas.id')
        ->select('experts.*', 'areas.university_id', 'areas.name')
        ->where('areas.center_id', $idcen)
        ->orderby('experts.firstname')
        ->get();
        $obj1 = University::find($id);
        $obj2 = Center::find($idcen);
        $d = "<h4>ผู้เชี่ยวชาญ : ".$obj1->name."<br>ศูนย์ : ".$obj2->name."</h4>";
    }elseif($id!=0 and $idtag!=0){
        $exp = Expert::leftJoin('areas', 'experts.area_id', '=', 'areas.id')
        ->leftJoin('expertlists','experts.id','=','expertlists.expert_id')
        ->select('experts.*', 'areas.university_id', 'areas.name')
        ->where('areas.university_id', $id)
        ->where('expertlists.taggroup_id','=',$idtag)
        ->orderby('experts.firstname')
        ->get();
        $obj1 = University::find($id);
        $obj2 = Taggroup::find($idtag);
        $d = "<h4>ผู้เชี่ยวชาญ : ".$obj1->name."<br>กลุ่ม : ".$obj2->groupname."</h4>";
    }elseif($id!=0){
        $exp = Expert::leftJoin('areas', 'experts.area_id', '=', 'areas.id')
        ->select('experts.*', 'areas.university_id', 'areas.name')
        ->where('areas.university_id', $id)
        ->orderby('experts.firstname')
        ->get();
        $obj = University::find($id);
        $d = "<h4>ผู้เชี่ยวชาญ : ".$obj->name."</h4>";
    }elseif($idtag!=0){
        $exp = Expert::leftJoin('expertlists','experts.id','=','expertlists.expert_id')
        ->select('experts.*')
        ->where('expertlists.taggroup_id','=',$idtag)
        ->orderby('experts.firstname')
        ->get();
        $obj = Taggroup::find($idtag);
        $d = "<h4>ผู้เชี่ยวชาญ : กลุ่ม".$obj->groupname."</h4>";
    }else{
        $exp = Expert::orderby('firstname')->get();
        $d = "<h4>ผู้เชี่ยวชาญทั้งหมด</h4>";
    }

        $display = $d;
        $display.="
        <table id='example1' class='table table-bordered table-striped'>
          <thead>
          <tr>
            <th>ลำดับ</th>
            <th>ชื่อผู้เชี่ยวชาญ</th>
            <th>สังกัด</th>
            <th>อีเมล์</th>";
            if(Auth::user()){
              $display.="<th>เบอร์โทร</th>";
            }
          $display.="</tr>
          </thead>
          <tbody>
        ";
        $i=1;
        foreach ($exp as $key) {
          $display .= "
          <tr>
            <td>".$i++."</td>
            <td><a href='../eis/profileexp?id=".$key->id."' target='blank'>".$key->headname.$key->firstname." ".$key->lastname."</a>
            </td>
            <td>".$key->area->name.', '.$key->area->center->name.', '.$key->area->center->university->name."</td>
            <td>".$key->email."</td>";
            if(Auth::user()){
              $display .= "<td>".$key->tel."</td>";
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

  public function getResearch()
  {
    $objuniver = University::lists('name','id');
    $objtag = Taggroup::lists('groupname','id');
    return view('report.research',compact('objuniver','objtag'));
  }
  public function loadResearch(Request $request){
    $id = $request['id'];
    $idtag = $request['idtag'];
    if($idtag==0){
        if($id==0){
          $objresearch = Research::orderby('title_th')->get();
        }else{
          $objresearch = Research::leftJoin('researchers','researchs.researcher_id','=','researchers.id')
          ->where('researchers.university_id','=',$id)
          ->orderby('researchs.title_th')
          ->get();
        }
    }else{
          $objresearch = Research::where('taggroup_id','=',$idtag)
          ->orderby('title_th')
          ->get();
    }

              $display ="
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
              foreach ($objresearch as $key) {
                $display .= "
                <tr>
                  <td>".$i++."</td>
                  <td><a href='../eis/profileresearch?id=".$key->id."' target='blank'>".$key->title_th."</a></td>
                  <td><a href='../eis/profile?id=".$key->researcher_id."' target='blank'>".$key->researcher->headname.$key->researcher->firstname." ".$key->researcher->lastname."</a>
                  </td>
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


    public function getCreative()
    {
      $objuniver = University::lists('name','id');
      $objtag = Taggroup::lists('groupname','id');
      return view('report.creative',compact('objuniver','objtag'));
    }
    public function loadCreative(Request $request){
      $id = $request['id'];
      $idtag = $request['idtag'];
      //$objcreative = Creative::get();

      if($id!=0 and $idtag!=0){
            $objcreative = Creative::leftJoin('researchers','creatives.researcher_id','=','researchers.id')
            ->where('researchers.university_id','=',$id)
            ->where('creatives.taggroup_id','=',$idtag)
            ->orderby('creatives.title')
            ->get();

      }elseif($id!=0){
            $objcreative = Creative::leftJoin('researchers','creatives.researcher_id','=','researchers.id')
            ->where('researchers.university_id','=',$id)
            ->orderby('creatives.title')
            ->get();
      }elseif($idtag!=0){
            $objcreative = Creative::where('taggroup_id','=',$idtag)
            ->orderby('title')
            ->get();
      }else{
            $objcreative = Creative::orderby('title')->get();
      }


                $display ="
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
                foreach ($objcreative as $key) {
                  $display .= "
                  <tr>
                    <td>".$i++."</td>
                    <td><a href='../eis/profilecreative?id=".$key->id."' target='blank'>".$key->title."</a></td>
                    <td><a href='../eis/profile?id=".$key->researcher_id."' target='blank'>".$key->researcher->headname.$key->researcher->firstname." ".$key->researcher->lastname."</a></td>
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

      public function getArea()
      {
        $objuniver = University::lists('name','id');
        $objtag = Taggroup::lists('groupname','id');
        return view('report.area',compact('objuniver','objtag'));
      }
      public function loadArea(Request $request)
      {
        $id = $request['id'];
        $idcen = $request['idcen'];
        $idtag = $request['idtag'];

        if($id!=0 and $idcen!=0 and $idtag!=0){
            //$d='id+cen+tag';
            $exp = Area::leftJoin('problems','areas.id','=','problems.area_id')
            ->select('areas.*')
            ->where('university_id', $id)
            ->where('center_id', $idcen)
            ->where('problems.taggroup_id','=',$idtag)
            ->orderby('areas.name')
            ->get();
        }elseif($id!=0 and $idcen!=0){
            $d='id+cen';
            $exp = Area::where('university_id', $id)
            ->where('center_id', $idcen)
            ->orderby('areas.name')
            ->get();
        }elseif($id!=0 and $idtag!=0){
            $d='id+tag';
            $exp = Area::leftJoin('problems','areas.id','=','problems.area_id')
            ->select('areas.*')
            ->where('university_id', $id)
            ->where('problems.taggroup_id','=',$idtag)
            ->orderby('areas.name')
            ->get();
        }elseif($id!=0){
            $d='id';
            $exp = Area::where('university_id', $id)
            ->orderby('areas.name')
            ->get();
        }elseif($idtag!=0){
            $exp = Area::leftJoin('problems','areas.id','=','problems.area_id')
            ->select('areas.*')
            ->where('problems.taggroup_id','=',$idtag)
            ->orderby('areas.name')
            ->get();
            $obj = Taggroup::find($idtag);
            $d = "<h4>พื้นที่ชุมชนทั้งหมด : กลุ่ม".$obj->groupname."</h4>";
        }else{
            $exp = Area::orderby('name')->get();
            $d = "<h4>พื้นที่ชุมชนทั้งหมด</h4>";
        }

            $display = $d;
            $display.="
            <table id='example1' class='table table-bordered table-striped'>
              <thead>
              <tr>
                <th>ลำดับ</th>
                <th>ชื่อพื้นที่ชุมชน</th>
                <th>สังกัด</th>
                <th>ผู้ประสานงาน</th>";
                if(Auth::user()){
                  $display.="<th>เบอร์โทร</th>";
                }
              $display.="</tr>
              </thead>
              <tbody>
            ";
            $i=1;
            foreach ($exp as $key) {
              $display .= "
              <tr>
                <td>".$i++."</td>
                <td><a href='../eis/profilearea?id=".$key->id."' target='blank'>".$key->name."</a></td>
                <td>".$key->center->name.', '.$key->center->university->name."</td>
                <td>".$key->keyman."</td>";
                if(Auth::user()){
                  $display .= "<td>".$key->tel."</td>";
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

      public function getProblem()
      {
        $objuniver = University::lists('name','id');
        $objtag = Taggroup::lists('groupname','id');
        return view('report.problem',compact('objuniver','objtag'));
      }
      public function loadProblem(Request $request)
      {
      $id = $request['id'];
      $idcen = $request['idcen'];
      $idtag = $request['idtag'];

      if($id!=0 and $idcen!=0 and $idtag!=0){
        $obju = University::find($id);
        $objc = Center::find($idcen);
        $objg = Taggroup::find($idtag);

        $d = "<h4>ข้อมูลปัญหาชุมชนทั้งหมด : หน่วยงาน ".$obju->name."</h4>";
        $d .= "<h4> : ศูนย์ ".$objc->name."</h4>";
        $d .= "<h4> : กลุ่ม ".$objg->groupname."</h4>";

          $exp = Problem::leftJoin('areas','problems.area_id','=','areas.id')
          ->select('problems.*')
          ->where('areas.university_id', $id)
          ->where('areas.center_id', $idcen)
          ->where('problems.taggroup_id', $idtag)
          ->orderby('problems.title')
          ->get();
      }elseif($id!=0 and $idcen!=0){
        $obju = University::find($id);
        $objc = Center::find($idcen);
        $d = "<h4>ข้อมูลปัญหาชุมชนทั้งหมด : หน่วยงาน ".$obju->name."</h4>";
        $d .= "<h4> : ศูนย์ ".$objc->name."</h4>";
          $exp = Problem::leftJoin('areas','problems.area_id','=','areas.id')
          ->select('problems.*')
          ->where('areas.university_id', $id)
          ->where('areas.center_id', $idcen)
          ->orderby('problems.title')
          ->get();
      }elseif($id!=0 and $idtag!=0){
        $obju = University::find($id);
        $objg = Taggroup::find($idtag);
        $d = "<h4>ข้อมูลปัญหาชุมชนทั้งหมด : หน่วยงาน ".$obju->name."</h4>";
        $d .= "<h4> : กลุ่ม ".$objg->groupname."</h4>";
          $exp = Problem::leftJoin('areas','problems.area_id','=','areas.id')
          ->select('problems.*')
          ->where('areas.university_id', $id)
          ->where('problems.taggroup_id', $idtag)
          ->orderby('problems.title')
          ->get();
      }elseif($id!=0){
          $obju = University::find($id);
          $d = "<h4>ข้อมูลปัญหาชุมชนทั้งหมด : หน่วยงาน ".$obju->name."</h4>";
          $exp = Problem::leftJoin('areas','problems.area_id','=','areas.id')
          ->select('problems.*')
          ->where('areas.university_id', $id)
          ->orderby('problems.title')
          ->get();
      }elseif($idtag!=0){
        $objg = Taggroup::find($idtag);
        $d = "<h4>ข้อมูลปัญหาชุมชนทั้งหมด : กลุ่ม ".$objg->groupname."</h4>";
        $exp = Problem::where('taggroup_id', '=', $idtag)
        ->orderby('title')
        ->get();
      }else{
          $d = "<h4>ปัญหาในพื้นที่ชุมชนทั้งหมด</h4>";
          $exp = Problem::orderby('title')->get();
      }

      $display = $d;
      $display.="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th>ลำดับ</th>
          <th>หัวเรื่อง</th>
          <th>พื้นที่ชุมชน</th>
          <th>สังกัด</th>
          <th>สถานะ</th>
        </tr>
        </thead>
        <tbody>
      ";
      $i=1;
      foreach ($exp as $key) {
        $status=' ';
        $display .= "
        <tr>
          <td>".$i++."</td>
          <td><a href='../eis/profilepro?id=".$key->id."' target='blank'>".$key->title."</a></td>
          <td>".$key->area->name."</td>
          <td>".$key->area->center->name.', '.$key->area->center->university->name."</td>
          <td>";
          if($key->status=='1'){ $status="<span class='label label-danger'>รอดำเนินการ</span>";}
          else if($key->status=='2'){ $status="<span class='label label-warning'>กำลังดำเนินการ</span>";}
          else if($key->status=='3'){ $status="<span class='label label-success'>ดำเนินการแล้วเสร็จ</span>";}
          $display .= $status;
          $display .= "</td>
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
