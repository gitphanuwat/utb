<?php
namespace App\Http\Controllers\Univer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\University;
use App\Center;
use App\Area;

use App\Http\Requests\AreauniRequest;

class AreaController extends Controller
{
     public function __construct()
     {
         $this->middleware('university');
     }

    public function index()
    {
        $idu = Auth::user()->university_id;
        $objcenter = Center::where('university_id',$idu)->lists('name','id');
        return view('univer.area',compact('objcenter'));
    }

    public function create()
    {
      $idu = Auth::user()->university_id;
      $data = Area::where('university_id',$idu)->orderby('name')->get();
      //$data = Area::get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
        <th>ลำดับ</th>
        <th>ชื่อชุมชน</th>
        <th>ศูนย์จัดการ</th>
        <th>ที่อยู่</th>
        <th width='80' data-sortable='false'>ดำเนินการ</th>
        </tr>
        </thead>
        <tbody>
      ";
      $i=0;
      foreach ($data as $key) {
        $i++;
        $display .= "
        <tr>
          <td>$i</td>
          <td>$key->name</td>
          <td>".$key->Center->name."</td>
          <td> ต.".$key->tambon." อ.".$key->amphur." จ.".$key->province."</td>
          <td><a data-id='$key->id' href='#j' class='btn btn-primary btn-xs edit'>แก้ไข</a> <a data-id='$key->id' href='#' class='btn btn-danger btn-xs delete'>ลบข้อมูล</a></td>
        </tr>
        ";
      }
      $display .= "
        </tbody>
      </table>
      ";
      return $display;
    }

    public function store(AreauniRequest $request)
    {
      $centerID = $request['center_id'];
      $scen = Center::find($centerID);
      if($scen->university_id == Auth::user()->university_id){
        $obj = new Area();
        $obj->university_id = Auth::user()->university_id;
        $obj->center_id = $request['center_id'];
        $obj->name = $request['name'];
        $obj->tambon = $request['tambon'];
        $obj->amphur = $request['amphur'];
        $obj->province = $request['province'];
        $obj->latitude = $request['latitude'];
        $obj->longitude = $request['longitude'];
        $obj->context = $request['context'];
        $obj->people = $request['people'];
        $obj->health = $request['health'];
        $obj->environment = $request['environment'];
        $obj->keyman = $request['keyman'];
        $obj->tel = $request['tel'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}
      }
    }

    public function show($id)
    {
        $obj = Area::find($id);
        dd($obj);
    }

    public function edit($id)
    {
      $data = Area::find($id);
      if($data->university_id == Auth::user()->university_id){
        header("Content-type: text/x-json");
        echo json_encode($data);
        exit();
      }
      abort(0);
    }


    public function update(AreauniRequest $request, $id)
    {
      $centerID = $request['center_id'];
      $scen = Center::find($centerID);
      if($scen->university_id == Auth::user()->university_id){
        $obj = Area::findOrFail($id);
        //$obj->university_id = Auth::user()->university_id;
        $obj->center_id = $request['center_id'];
        $obj->name = $request['name'];
        $obj->tambon = $request['tambon'];
        $obj->amphur = $request['amphur'];
        $obj->province = $request['province'];
        $obj->latitude = $request['latitude'];
        $obj->longitude = $request['longitude'];
        $obj->context = $request['context'];
        $obj->people = $request['people'];
        $obj->health = $request['health'];
        $obj->environment = $request['environment'];
        $obj->keyman = $request['keyman'];
        $obj->tel = $request['tel'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}
      }
      abort(403);
    }

    public function destroy($id)
    {
      $data = Area::find($id);
      if($data->university_id == Auth::user()->university_id){
    		$check = $data->delete();
        if($check>0){return 0;}else{return 1;}
      }
      abort();
    }
}
