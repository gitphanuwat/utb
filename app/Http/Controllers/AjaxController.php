<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App\University;
use App\Center;
use App\Area;

class AjaxController extends Controller
{
    //for session
    public function createsession($name,$value)
    {
        session([$name => $value]);
    }

    public function loadcenterselect($id)
    {
        $centers = DB::table("centers")
                    ->where("university_id",$id)
                    ->lists("name","id");
        session(['university_id' => $id]);
        return json_encode($centers);
    }

    public function loadproblem($id)
    {
        $problem = DB::table("problems")
                    ->where("area_id",$id)
                    ->lists("title","id");
        return json_encode($problem);
    }

    public function loadarea($id)
    {
      $area = DB::table("areas")
                  ->where("center_id",$id)
                  ->lists("name","id");
      return json_encode($area);
    }
    public function loadarea_uni($id)
    {
      $area = DB::table("areas")
                  ->where("university_id",$id)
                  ->lists("name","id");
      return json_encode($area);
    }
    public function callcenter($idarea)
    {
      $area = Area::find($idarea);
      return $area->center_id;
      //return '6';
    }

    public function loadresch($id)
    {
        $data = DB::table("researchers")
                  ->where("university_id",$id)
                  ->get();
        $display ='
        <select name="researcher_id" id="researcher_id" class="form-control select2" style="width:350px">
            <option value="">--- เลือกนักวิจัย ---</option>';
            foreach ($data as $key){
                $display .='<option value="'.$key->id.'">'.$key->headname.$key->firstname.' '.$key->lastname.'</option>';
            }
          $display .='</select>';
          $display .='
          <script type="text/javascript">
              $(function(){
                $(".select2").select2();
              });
          </script>
          ';
      return $display;
    }

    public function loadroleall(Request $request)
    {
      $roleID = $request['role_id'];
      $universityID = $request['university_id'];
      $centerID = $request['center_id'];
      $areaID = $request['area_id'];

      if($roleID==1){
          $display ='
          <input type="hidden" name="university_id" id="university_id" value="0">
          <input type="hidden" name="center_id" id="center_id" value="0">
          <input type="hidden" name="area_id" id="area_id" value="0">';
      }
      if($roleID==2){
          $data = University::lists('name','id');
          $display ='
          <input type="hidden" name="center_id" id="center_id" value="0">
          <input type="hidden" name="area_id" id="area_id" value="0">';
          $display .='
          <select name="university_id" id="university_id" class="form-control" style="width:350px">
              <option value="">--- เลือกมหาวิทยาลัย ---</option>';
              foreach ($data as $key => $value){
                  $display .='<option value="'.$key.'">'.$value.'</option>';
              }
          $display .='</select>';
          $display .='<br><input type="checkbox" id="permit" name="permit" value="2"> สิทธิ์ระดับผู้บริหาร';
      }
      if($roleID==3){
        $data = University::lists('name','id');
        $datacenter = Center::where('university_id',$universityID)->get();
          $display ='
          <input type="hidden" name="area_id" id="area_id" value="0">';
          $display .='
          <select name="university_id" id="university_id" class="form-control" style="width:350px">
          <option value="" >--- เลือกมหาวิทยาลัย ---</option>';
              foreach ($data as $key => $value){
                  $display .='<option value="'.$key.'">'.$value.'</option>';
              }
          $display .='</select>';
          $display .='
          <select name="center_id" id="center_id" class="form-control" style="width:350px">
              <option value="">--- เลือกศูนย์จัดการเครือข่าย ---</option>';
              foreach ($datacenter as $key){
                  $display .='<option value="'.$key->id.'">'.$key->name.'</option>';
              }
          $display .='</select>';
      }
      if($roleID==4){
        $data = University::lists('name','id');
        $datacenter = Center::where('university_id',$universityID)->get();
        $dataarea = Area::where('center_id',$centerID)->get();
          $display ='
          <select name="university_id" id="university_id" class="form-control" style="width:350px">
              <option value="">--- เลือกมหาวิทยาลัย ---</option>';
              foreach ($data as $key => $value){
                  $display .='<option value="'.$key.'">'.$value.'</option>';
              }
          $display .='</select>';
          $display .='
          <select name="center_id" id="center_id" class="form-control" style="width:350px">
              <option value="">--- เลือกศูนย์จัดการเครือข่าย ---</option>';
              foreach ($datacenter as $key){
                  $display .='<option value="'.$key->id.'">'.$key->name.'</option>';
              }
          $display .='</select>';
          $display .='
          <select name="area_id" id="area_id" class="form-control" style="width:350px">
              <option value="">--- เลือกพื้นที่ชุมชน ---</option>';
              foreach ($dataarea as $key){
                  $display .='<option value="'.$key->id.'">'.$key->name.'</option>';
              }
          $display .='</select>';
      }
      return $display;
    }

    public function loadrole($roleID)
    {

      if($roleID==1){
          $display ='
          <input type="hidden" name="university_id" id="university_id" value="0">
          <input type="hidden" name="center_id" id="center_id" value="0">
          <input type="hidden" name="area_id" id="area_id" value="0">';
      }
      if($roleID==2){
          $data = University::lists('name','id');
          $display ='
          <input type="hidden" name="center_id" id="center_id" value="0">
          <input type="hidden" name="area_id" id="area_id" value="0">';
          $display .='
          <select name="university_id" id="university_id" class="form-control" style="width:350px">
              <option value="">--- เลือกมหาวิทยาลัย ---</option>';
              foreach ($data as $key => $value){
                  $display .='<option value="'.$key.'">'.$value.'</option>';
              }
          $display .='</select>';
          $display .='<br><input type="checkbox" id="permit" name="permit" value="2"> สิทธิ์ระดับผู้บริหาร';
      }
      if($roleID==3){
          $data = University::lists('name','id');
          $display ='
          <input type="hidden" name="area_id" id="area_id" value="0">';
          $display .='
          <select name="university_id" id="university_id" class="form-control" style="width:350px">
              <option value="">--- เลือกมหาวิทยาลัย ---</option>';
              foreach ($data as $key => $value){
                  $display .='<option value="'.$key.'">'.$value.'</option>';
              }
          $display .='</select>';
          $display .='
          <select name="center_id" id="center_id" class="form-control" style="width:350px">
              <option value="">--- เลือกศูนย์จัดการเครือข่าย ---</option>';
          $display .='</select>';
      }
      if($roleID==4){
          $data = University::lists('name','id');
          $display ='
          <select name="university_id" id="university_id" class="form-control" style="width:350px">
              <option value="">--- เลือกมหาวิทยาลัย ---</option>';
              foreach ($data as $key => $value){
                  $display .='<option value="'.$key.'">'.$value.'</option>';
              }
          $display .='</select>';
          $display .='
          <select name="center_id" id="center_id" class="form-control" style="width:350px">
              <option value="">--- เลือกศูนย์จัดการเครือข่าย ---</option>';
          $display .='</select>';
          $display .='
          <select name="area_id" id="area_id" class="form-control" style="width:350px">
              <option value="">--- เลือกพื้นที่ชุมชน ---</option>';
          $display .='</select>';
      }
      return $display;
    }

    public function loadroleuni(Request $request, $roleID)
    {
      $centerID = $request['center_id'];

      if($roleID==2){
          $display ='
          <input type="hidden" name="center_id" id="center_id" value="0">
          <input type="hidden" name="area_id" id="area_id" value="0">';
          $display .='
          <select name="university_id" id="university_id" class="form-control" style="width:350px">
          <option value="'.Auth::user()->university_id.'">'.Auth::user()->university->name.'</option>
          </select>';
          $display .='<br><input type="checkbox" id="permit" name="permit" value="2"> สิทธิ์ระดับผู้บริหาร';
      }
      if($roleID==3){
        $idu = Auth::user()->university_id;
        $display ='<input type="hidden" name="university_id" id="university_id" value="'.$idu.'">';
        $display .='<input type="hidden" name="area_id" id="area_id" value="0">';
        $idu = Auth::user()->university_id;
        $data = Center::where('university_id',$idu)->lists('name','id');
        $display .='
        <select name="center_id" id="center_id" class="form-control" style="width:350px">
            <option value="">--- เลือกศูนย์จัดการเครือข่าย ---</option>';
            foreach ($data as $key => $value){
                $display .='<option value="'.$key.'">'.$value.'</option>';
            }
        $display .='</select>';

      }
      if($roleID==4){
        $idu = Auth::user()->university_id;
        $ida = Auth::user()->center_id;
        $data = Center::where('university_id',$idu)->lists('name','id');
        $dataarea = Area::where('center_id',$centerID)->lists('name','id');
        $display ='<input type="hidden" name="university_id" id="university_id" value="'.$idu.'">';
          $display .='
          <select name="center_id" id="center_id" class="form-control" style="width:350px">
              <option value="">--- เลือกศูนย์จัดการเครือข่าย ---</option>';
              foreach ($data as $key => $value){
                  $display .='<option value="'.$key.'">'.$value.'</option>';
              }
          $display .='</select>';

          $display .='
          <select name="area_id" id="area_id" class="form-control" style="width:350px">
              <option value="">--- เลือกพื้นที่ชุมชน ---</option>';
              foreach ($dataarea as $key => $value){
                  $display .='<option value="'.$key.'">'.$value.'</option>';
              }
          $display .='</select>';
      }
      return $display;
    }

    public function loadrolemng(Request $request, $roleID)
    {
      $universityID = Auth::user()->university_id;
      $centerID = Auth::user()->center_id;

      if($roleID==3){
        $display ='<input type="hidden" name="university_id" id="university_id" value="'.$universityID.'">';
        $display .='<input type="hidden" name="center_id" id="center_id" value="'.$centerID.'">';
        $display .= '<h4>ศูนย์จัดการเครือข่าย : '.Auth::user()->center->name.'</h4>';
        $display .='<input type="hidden" name="area_id" id="area_id" value="0">';
      }
      if($roleID==4){
        $display ='<input type="hidden" name="university_id" id="university_id" value="'.$universityID.'">';
        $display .='<input type="hidden" name="center_id" id="center_id" value="'.$centerID.'">';
        $display .= '<h4>ศูนย์จัดการเครือข่าย : '.Auth::user()->center->name.'</h4>';
        $dataarea = Area::where('center_id',$centerID)->lists('name','id');
          $display .='
          <select name="area_id" id="area_id" class="form-control" style="width:350px">
              <option value="">--- เลือกพื้นที่ชุมชน ---</option>';
              foreach ($dataarea as $key => $value){
                  $display .='<option value="'.$key.'">'.$value.'</option>';
              }
          $display .='</select>';
      }
      return $display;
    }

    public function loaddata($id)
    {
        $datacent = Center::find($id);
        $arrayName = array(
          'id' => $datacent->id,
          'univ'=>$datacent->university->name,
          'cent'=>$datacent->name,
        );
        return json_encode($arrayName);
    }
    public function loadcentercur($id)
    {
        $centers = DB::table("centers")
                    ->where("university_id",$id)
                    ->lists("name","id");
        return json_encode($centers);
    }
    public function loadcenterlist($id)
    {
        $centers = DB::table("centers")
                    ->where("university_id",$id)
                    ->lists("id","name");
        return json_encode($centers);
    }


    public function loadmap(Request $request)
    {
      $id = $request['id'];
      $idcen = $request['idcen'];
      if($idcen==0){
          if($id==0){
            $objarea = Area::get();
          }else{
            $objarea = Area::where('university_id','=',$id)->get();
          }
      }else{
          $objarea = Area::where('center_id','=',$idcen)->get();
      }

      $data = "
      <script>
              $('#world-map-markers').vectorMap({
                map: 'th_mill',
                normalizeFunction: 'polynomial',
                hoverOpacity: 0.7,
                hoverColor: false,
                backgroundColor: 'transparent',
                regionStyle: {
                  initial: {
                    fill: 'rgba(210, 214, 222, 1)',
                    'fill-opacity': 1,
                    stroke: 'none',
                    'stroke-width': 0,
                    'stroke-opacity': 1
                  },
                  hover: {
                    'fill-opacity': 0.7,
                    cursor: 'pointer'
                  },
                  selected: {
                    fill: 'yellow'
                  },
                  selectedHover: {}
                },
                markerStyle: {
                  initial: {
                    fill: '#00a65a',
                    stroke: '#111'
                  }
                },
                markers: [";
                  foreach ($objarea as $key) {
                  $data .= "{latLng: [".$key->latitude.", ".$key->longitude."], name: '".$key->name."'},";
                }

              $data .= "]
              });";
      $data .= "</script>";
      return $data;
    }

}
