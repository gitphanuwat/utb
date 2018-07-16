<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App\Amphur;
use App\Organize;
use App\Village;

class AjaxController extends Controller
{
    //for session
    public function createsession($name,$value)
    {
        session([$name => $value]);
    }

    public function loadorganizeselect($id)
    {
        $organizes = DB::table("organizes")
                    ->where("amphur_id",$id)
                    ->lists("name","id");
        session(['amphur_id' => $id]);
        return json_encode($organizes);
    }

    public function loadproblem($id)
    {
        $problem = DB::table("problems")
                    ->where("village_id",$id)
                    ->lists("title","id");
        return json_encode($problem);
    }

    public function loadvillage($id)
    {
      $village = DB::table("villages")
                  ->where("organize_id",$id)
                  ->lists("name","id");
      return json_encode($village);
    }
    public function loadvillage_uni($id)
    {
      $village = DB::table("villages")
                  ->where("amphur_id",$id)
                  ->lists("name","id");
      return json_encode($village);
    }
    public function callorganize($idvillage)
    {
      $village = Village::find($idvillage);
      return $village->organize_id;
      //return '6';
    }

    public function loadresch($id)
    {
        $data = DB::table("researchers")
                  ->where("amphur_id",$id)
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
      $amphurID = $request['amphur_id'];
      $organizeID = $request['organize_id'];
      $villageID = $request['village_id'];

      if($roleID==1){
          $display ='
          <input type="hidden" name="amphur_id" id="amphur_id" value="0">
          <input type="hidden" name="organize_id" id="organize_id" value="0">
          <input type="hidden" name="village_id" id="village_id" value="0">';
      }
      if($roleID==2){
          $data = Amphur::lists('name','id');
          $display ='
          <input type="hidden" name="organize_id" id="organize_id" value="0">
          <input type="hidden" name="village_id" id="village_id" value="0">';
          $display .='
          <select name="amphur_id" id="amphur_id" class="form-control" style="width:350px">
              <option value="">--- เลือกเขตอำเภอ ---</option>';
              foreach ($data as $key => $value){
                  $display .='<option value="'.$key.'">'.$value.'</option>';
              }
          $display .='</select>';
          $display .='<br><input type="checkbox" id="permit" name="permit" value="2"> สิทธิ์ระดับผู้บริหาร';
      }
      if($roleID==3){
        $data = Amphur::lists('name','id');
        $dataorganize = Organize::where('amphur_id',$amphurID)->get();
          $display ='
          <input type="hidden" name="village_id" id="village_id" value="0">';
          $display .='
          <select name="amphur_id" id="amphur_id" class="form-control" style="width:350px">
          <option value="" >--- เลือกเขตอำเภอ ---</option>';
              foreach ($data as $key => $value){
                  $display .='<option value="'.$key.'">'.$value.'</option>';
              }
          $display .='</select>';
          $display .='
          <select name="organize_id" id="organize_id" class="form-control" style="width:350px">
              <option value="">--- เลือกหน่วยงาน ---</option>';
              foreach ($dataorganize as $key){
                  $display .='<option value="'.$key->id.'">'.$key->name.'</option>';
              }
          $display .='</select>';
      }
      if($roleID==4){
        $data = Amphur::lists('name','id');
        $dataorganize = Organize::where('amphur_id',$amphurID)->get();
        $datavillage = Village::where('organize_id',$organizeID)->get();
          $display ='
          <select name="amphur_id" id="amphur_id" class="form-control" style="width:350px">
              <option value="">--- เลือกเขตอำเภอ ---</option>';
              foreach ($data as $key => $value){
                  $display .='<option value="'.$key.'">'.$value.'</option>';
              }
          $display .='</select>';
          $display .='
          <select name="organize_id" id="organize_id" class="form-control" style="width:350px">
              <option value="">--- เลือกหน่วยงาน4 ---</option>';
              foreach ($dataorganize as $key){
                  $display .='<option value="'.$key->id.'">'.$key->name.'</option>';
              }
          $display .='</select>';
          $display .='
          <select name="village_id" id="village_id" class="form-control" style="width:350px">
              <option value="">--- เลือกพื้นที่ชุมชน ---</option>';
              foreach ($datavillage as $key){
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
          <input type="hidden" name="amphur_id" id="amphur_id" value="0">
          <input type="hidden" name="organize_id" id="organize_id" value="0">
          <input type="hidden" name="village_id" id="village_id" value="0">';
      }
      if($roleID==2){
          $data = Amphur::lists('name','id');
          $display ='
          <input type="hidden" name="organize_id" id="organize_id" value="0">
          <input type="hidden" name="village_id" id="village_id" value="0">';
          $display .='
          <select name="amphur_id" id="amphur_id" class="form-control" style="width:350px">
              <option value="">--- เลือกเขตอำเภอ ---</option>';
              foreach ($data as $key => $value){
                  $display .='<option value="'.$key.'">'.$value.'</option>';
              }
          $display .='</select>';
          $display .='<br><input type="checkbox" id="permit" name="permit" value="2"> สิทธิ์ระดับผู้บริหาร';
      }
      if($roleID==3){
          $data = Amphur::lists('name','id');
          $display ='
          <input type="hidden" name="village_id" id="village_id" value="0">';
          $display .='
          <select name="amphur_id" id="amphur_id" class="form-control" style="width:350px">
              <option value="">--- เลือกเขตอำเภอ ---</option>';
              foreach ($data as $key => $value){
                  $display .='<option value="'.$key.'">'.$value.'</option>';
              }
          $display .='</select>';
          $display .='
          <select name="organize_id" id="organize_id" class="form-control" style="width:350px">
              <option value="">--- เลือกหน่วยงาน ---</option>';
          $display .='</select>';
      }
      if($roleID==4){
          $data = Amphur::lists('name','id');
          $display ='
          <select name="amphur_id" id="amphur_id" class="form-control" style="width:350px">
              <option value="">--- เลือกเขตอำเภอ ---</option>';
              foreach ($data as $key => $value){
                  $display .='<option value="'.$key.'">'.$value.'</option>';
              }
          $display .='</select>';
          $display .='
          <select name="organize_id" id="organize_id" class="form-control" style="width:350px">
              <option value="">--- เลือกหน่วยงาน ---</option>';
          $display .='</select>';
          $display .='
          <select name="village_id" id="village_id" class="form-control" style="width:350px">
              <option value="">--- เลือกพื้นที่ชุมชน ---</option>';
          $display .='</select>';
      }
      return $display;
    }

    public function loadroleuni(Request $request, $roleID)
    {
      $organizeID = $request['organize_id'];

      if($roleID==2){
          $display ='
          <input type="hidden" name="organize_id" id="organize_id" value="0">
          <input type="hidden" name="village_id" id="village_id" value="0">';
          $display .='
          <select name="amphur_id" id="amphur_id" class="form-control" style="width:350px">
          <option value="'.Auth::user()->amphur_id.'">'.Auth::user()->amphur->name.'</option>
          </select>';
          $display .='<br><input type="checkbox" id="permit" name="permit" value="2"> สิทธิ์ระดับผู้บริหาร';
      }
      if($roleID==3){
        $idu = Auth::user()->amphur_id;
        $display ='<input type="hidden" name="amphur_id" id="amphur_id" value="'.$idu.'">';
        $display .='<input type="hidden" name="village_id" id="village_id" value="0">';
        $idu = Auth::user()->amphur_id;
        $data = Organize::where('amphur_id',$idu)->lists('name','id');
        $display .='
        <select name="organize_id" id="organize_id" class="form-control" style="width:350px">
            <option value="">--- เลือกหน่วยงาน ---</option>';
            foreach ($data as $key => $value){
                $display .='<option value="'.$key.'">'.$value.'</option>';
            }
        $display .='</select>';

      }
      if($roleID==4){
        $idu = Auth::user()->amphur_id;
        $ida = Auth::user()->organize_id;
        $data = Organize::where('amphur_id',$idu)->lists('name','id');
        $datavillage = Vilage::where('organize_id',$organizeID)->lists('name','id');
        $display ='<input type="hidden" name="amphur_id" id="amphur_id" value="'.$idu.'">';
          $display .='
          <select name="organize_id" id="organize_id" class="form-control" style="width:350px">
              <option value="">--- เลือกหน่วยงาน ---</option>';
              foreach ($data as $key => $value){
                  $display .='<option value="'.$key.'">'.$value.'</option>';
              }
          $display .='</select>';

          $display .='
          <select name="village_id" id="village_id" class="form-control" style="width:350px">
              <option value="">--- เลือกพื้นที่ชุมชน ---</option>';
              foreach ($datavillage as $key => $value){
                  $display .='<option value="'.$key.'">'.$value.'</option>';
              }
          $display .='</select>';
      }
      return $display;
    }

    public function loadrolemng(Request $request, $roleID)
    {
      $amphurID = Auth::user()->amphur_id;
      $organizeID = Auth::user()->organize_id;

      if($roleID==3){
        $display ='<input type="hidden" name="amphur_id" id="amphur_id" value="'.$amphurID.'">';
        $display .='<input type="hidden" name="organize_id" id="organize_id" value="'.$organizeID.'">';
        $display .= '<h4>หน่วยงาน : '.Auth::user()->organize->name.'</h4>';
        $display .='<input type="hidden" name="village_id" id="village_id" value="0">';
      }
      if($roleID==4){
        $display ='<input type="hidden" name="amphur_id" id="amphur_id" value="'.$amphurID.'">';
        $display .='<input type="hidden" name="organize_id" id="organize_id" value="'.$organizeID.'">';
        $display .= '<h4>หน่วยงาน : '.Auth::user()->organize->name.'</h4>';
        $datavillage = Village::where('organize_id',$organizeID)->lists('name','id');
          $display .='
          <select name="village_id" id="village_id" class="form-control" style="width:350px">
              <option value="">--- เลือกพื้นที่ชุมชน ---</option>';
              foreach ($datavillage as $key => $value){
                  $display .='<option value="'.$key.'">'.$value.'</option>';
              }
          $display .='</select>';
      }
      return $display;
    }

    public function loaddata($id)
    {
        $datacent = Organize::find($id);
        $arrayName = array(
          'id' => $datacent->id,
          'univ'=>$datacent->amphur->name,
          'cent'=>$datacent->name,
        );
        return json_encode($arrayName);
    }
    public function loadorganizecur($id)
    {
        $organizes = DB::table("organizes")
                    ->where("amphur_id",$id)
                    ->lists("name","id");
        return json_encode($organizes);
    }
    public function loadorganizelist($id)
    {
        $organizes = DB::table("organizes")
                    ->where("amphur_id",$id)
                    ->lists("id","name");
        return json_encode($organizes);
    }


    public function loadmap(Request $request)
    {
      $id = $request['id'];
      $idcen = $request['idcen'];
      if($idcen==0){
          if($id==0){
            $objvillage = Village::get();
          }else{
            $objvillage = Village::where('amphur_id','=',$id)->get();
          }
      }else{
          $objvillage = Village::where('organize_id','=',$idcen)->get();
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
                  foreach ($objvillage as $key) {
                  $data .= "{latLng: [".$key->latitude.", ".$key->longitude."], name: '".$key->name."'},";
                }

              $data .= "]
              });";
      $data .= "</script>";
      return $data;
    }

}
