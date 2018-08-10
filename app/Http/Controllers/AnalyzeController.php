<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Http\Response;

use App\University;
use App\Center;
use App\Expert;
use App\Expertlist;
use App\Researcher;
use App\Research;
use App\Creative;
use App\Area;
use App\Problem;
use App\Log;

use DB;

class AnalyzeController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth');
     }
//struct
     public function struct()
     {
         $objuni = University::all();
         return view('user.struct',compact('objuni'));
     }
     public function getcenter(Request $request)
     {
       $iduni = $request['iduni'];
       $objuni = University::find($iduni);
       $objcen = Center::where('university_id',$iduni)->get();
       echo "<h4>".$objuni->name."</h4>";
       echo "<table class='table table-bordered'>";
       echo "<thead>";
       echo "<tr>";
       echo "<th width='60'>ลำดับ</th>";
       echo "<th width='250'>ศูนย์จัดการเครือข่าย</th>";
       echo "<th>พื้นที่ชุมชน</th>";
       echo "</tr>";
       echo "</thead>";
       $i=0;
       foreach ($objcen as $key) {
         echo "<tr>";
           echo "<td class='small-col'>".++$i."</td>";
           echo "<td><a data-id=".$key->id." href='#are' class='btnarea'>".$key->name."</a></td>";
           echo "<td>".count($key->area)."</td>";
         echo "</tr>";
       }
       echo "</table>";
     }
     public function getarea(Request $request)
     {
       $idcen = $request['idcen'];
       $objcen = Center::find($idcen);
       $objare = Area::where('center_id',$idcen)->get();
       echo "<h4>".$objcen->name."</h4>";
       echo "<table class='table table-bordered'>";
       echo "<thead>";
       echo "<tr>";
       echo "<th width='60'>ลำดับ</th>";
       echo "<th width='250'>พื้นที่ชุมชน</th>";
       echo "<th>ปัญหาชุมชน</th>";
       echo "</tr>";
       echo "</thead>";
       $i=0;
       foreach ($objare as $key) {
         echo "<tr>";
           echo "<td class='small-col'>".++$i."</td>";
           echo "<td><a href='../eis/profilearea?id=$key->id' target='_blank'>".$key->name."</a></td>";
           echo "<td>".count($key->problem)."</td>";
         echo "</tr>";
       }
       echo "</table>";
     }

//recheck
     public function recheck()
     {
         $objuni = University::all();
         return view('user.recheck',compact('objuni'));
     }
     public function getexp(Request $request)
     {
      $iduni = $request['iduni'];
      $objexp = Expert::where('university_id',$iduni)->get();
      echo "<table class='table table-bordered table-striped'>";
      echo "<thead>";
      echo "<tr>";
      echo "<th width='60'>ลำดับ</th>";
      echo "<th width='20%'>ชื่อ-สกุล</th>";
      echo "<th>ความเชี่ยวชาญ</th>";
      echo "</tr>";
      echo "</thead>";
      $i=0;
      foreach ($objexp as $key) {
        echo "<tr>";
          echo "<td class='small-col'>".++$i."</td>";
          echo "<td><a href='../eis/profileexp?id=$key->id' target='_blank'>".$key->headname.$key->firstname." ".$key->lastname."</a></td>";
          echo "<td>";
          foreach($key->expertlist as $obj){echo $obj->title_th.', ';}
          echo "</td>";
        echo "</tr>";
      }
      echo "</table>";
     }
     public function getrech(Request $request)
     {
      $iduni = $request['iduni'];
      $objrech = Researcher::where('university_id',$iduni)->get();
      echo "<table class='table table-bordered table-striped'>";
      echo "<thead>";
      echo "<tr>";
      echo "<th width='60'>ลำดับ</th>";
      echo "<th width='20%'>ชื่อ-สกุล</th>";
      echo "<th>ความเชี่ยวชาญ</th>";
      echo "</tr>";
      echo "</thead>";
      $i=0;
      foreach ($objrech as $key) {
        echo "<tr>";
          echo "<td class='small-col'>".++$i."</td>";
          echo "<td><a href='../eis/profileexp?id=$key->id' target='_blank'>".$key->headname.$key->firstname." ".$key->lastname."</a></td>";
          echo "<td>";
          foreach($key->expertlist as $obj){echo $obj->title_th.', ';}
          echo "</td>";
        echo "</tr>";
      }
      echo "</table>";
     }
     public function getres(Request $request)
     {
      $iduni = $request['iduni'];
      $objres = Research::leftjoin('researchers','researchs.researcher_id','=','researchers.id')
      ->where('researchers.university_id',$iduni)
      ->select('researchs.*')
      ->get();
      echo "<table class='table table-bordered table-striped'>";
      echo "<thead>";
      echo "<tr>";
      echo "<th width='60'>ลำดับ</th>";
      echo "<th width='20%'>ชื่องานวิจัย</th>";
      echo "<th>เอกสารงานวิจัย</th>";
      echo "</tr>";
      echo "</thead>";
      $i=0;
      foreach ($objres as $key) {
        echo "<tr>";
          echo "<td class='small-col'>".++$i."</td>";
          echo "<td><a href='../eis/profileresearch?id=$key->id' target='_blank'>".$key->title_th."</a></td>";
          echo "<td>";
          foreach($key->doc as $obj){echo $obj->title.', ';}
          echo "</td>";
        echo "</tr>";
      }
      echo "</table>";
     }
     public function getcre(Request $request)
     {
      $iduni = $request['iduni'];
      $objcre = Creative::leftjoin('researchers','creatives.researcher_id','=','researchers.id')
      ->where('researchers.university_id',$iduni)
      ->select('creatives.*')
      ->get();
      echo "<table class='table table-bordered table-striped'>";
      echo "<thead>";
      echo "<tr>";
      echo "<th width='60'>ลำดับ</th>";
      echo "<th width='20%'>ชื่อผลงานสร้างสรรค์</th>";
      echo "<th>เอกสาร</th>";
      echo "</tr>";
      echo "</thead>";
      $i=0;
      foreach ($objcre as $key) {
        echo "<tr>";
          echo "<td class='small-col'>".++$i."</td>";
          echo "<td><a href='../eis/profilecreative?id=$key->id' target='_blank'>".$key->title."</a></td>";
          echo "<td>";
          echo $key->file;
          echo "</td>";
        echo "</tr>";
      }
      echo "</table>";
     }
     public function getare(Request $request)
     {
      $iduni = $request['iduni'];
      $objare = Area::where('university_id',$iduni)->get();
      echo "<table class='table table-bordered table-striped'>";
      echo "<thead>";
      echo "<tr>";
      echo "<th width='60'>ลำดับ</th>";
      echo "<th width='20%'>ชื่อชุมชน</th>";
      echo "<th>ข้อมูลพื้นฐาน</th>";
      echo "</tr>";
      echo "</thead>";
      $i=0;
      foreach ($objare as $key) {
        echo "<tr>";
          echo "<td class='small-col'>".++$i."</td>";
          echo "<td><a href='../eis/profilearea?id=$key->id' target='_blank'>".$key->name."</a></td>";
          echo "<td>";
          echo $key->context;
          echo "</td>";
        echo "</tr>";
      }
      echo "</table>";
     }
     public function getpro(Request $request)
     {
      $iduni = $request['iduni'];
      $objpro = Problem::leftjoin('areas','problems.area_id','=','areas.id')
      ->where('areas.university_id',$iduni)
      ->select('problems.*')
      ->get();
      echo "<table class='table table-bordered table-striped'>";
      echo "<thead>";
      echo "<tr>";
      echo "<th width='60'>ลำดับ</th>";
      echo "<th width='20%'>ปัญหาชุมชน</th>";
      echo "<th>สถานะ</th>";
      echo "</tr>";
      echo "</thead>";
      $i=0;
      foreach ($objpro as $key) {
        echo "<tr>";
          echo "<td class='small-col'>".++$i."</td>";
          echo "<td><a href='../eis/profilepro?id=$key->id' target='_blank'>".$key->title."</a></td>";
          echo "<td>";
          echo $key->status;
          echo "</td>";
        echo "</tr>";
      }
      echo "</table>";
     }
//user log
     public function userlog()
     {
         return view('user.userlog');
     }
     public function getLatest(Request $request)
     {
       $startdate = $request['startdate'];
       $enddate = $request['enddate'];
       $start_date=date("Y-m-d",strtotime("$startdate"));
       //$end_date = date("Y-m-d",strtotime("$enddate"));
       $end_date=date("Y-m-d",strtotime("+1 days",strtotime($enddate)));

       $objlog = Log::whereBetween('timeuser', [$start_date, $end_date])
                ->take(500)
                 ->orderby('timeuser', 'desc')->get();
          echo "แสดงข้อมูลล่าสุด 500 รายการ";
      		echo "<table id='example1' class='table table-bordered table-striped'>";
          echo "<thead>";
          echo "<tr>";
          echo "<th class='small-col'></th>";
          echo "<th>ชื่อ - สกุล</th>";
          echo "<th>วันเวลา Login</th>";
          echo "<th class='time'>การใช้งาน</th>";
          echo "</tr>";
          echo "</thead>";

          foreach ($objlog as $key) {
     				echo "<tr>";
     					echo "<td class='small-col'><i class='glyphicon glyphicon-time'></i></td>";
              //echo "<td><a href='#' class='btn btn-primary btn-xs btnuserlog'>".$key->user->firstname.' '.$key->user->lastname."</a></td>";
     					//echo "<td><a href='#' target='_blank'>".$key->user->firstname.' '.$key->user->lastname."</a></td>";
              echo "<td><a data-id=".$key->user_id." href='#' class='btnuserlog'>".$key->user->firstname.' '.$key->user->lastname."</a></td>";
     					echo "<td>$key->timeuser</td>";
     					echo "<td class='time'>$key->module</td>";
     				echo "</tr>";
     			}
          echo "</table>";
   	}

    public function getuserlog(Request $request)
    {
      $startdate = $request['startdate'];
      $enddate = $request['enddate'];
      $iduser = $request['iduser'];
      $start_date=date("Y-m-d",strtotime("$startdate"));
      //$end_date = date("Y-m-d",strtotime("$enddate"));
      $end_date=date("Y-m-d",strtotime("+1 days",strtotime($enddate)));

      $objlog = Log::whereBetween('timeuser', [$start_date, $end_date])
                ->where('user_id',$iduser)
                ->orderby('timeuser', 'desc')->get();

         echo "<table id='example1' class='table table-bordered table-striped'>";
         echo "<thead>";
         echo "<tr>";
         echo "<th class='small-col'></th>";
         echo "<th>ชื่อ - สกุล</th>";
         echo "<th>วันเวลา Login</th>";
         echo "<th class='time'>การใช้งาน</th>";
         echo "</tr>";
         echo "</thead>";

         foreach ($objlog as $key) {
           echo "<tr>";
             echo "<td class='small-col'><i class='glyphicon glyphicon-time'></i></td>";
             echo "<td>".$key->user->firstname.' '.$key->user->lastname."</td>";
             echo "<td>$key->timeuser</td>";
             echo "<td class='time'>$key->module</td>";
           echo "</tr>";
         }
         echo "</table>";
    }

    public function deletestat(Request $request)
    {
      $startdate = $request['startdate'];
      $enddate = $request['enddate'];
      $iduser = $request['iduser'];
      $start_date=date("Y-m-d",strtotime("$startdate"));
      //$end_date = date("Y-m-d",strtotime("$enddate"));
      $end_date=date("Y-m-d",strtotime("+1 days",strtotime($enddate)));

      //$objlog = Log::whereBetween('timeuser', [$start_date, $end_date])
        //        ->where('user_id',$iduser)
          //      ->get();
      //$objlog->delete();
      $deleted = DB::statement("delete from logs where timeuser between '".$start_date."' and '".$end_date."'");
    }

}
