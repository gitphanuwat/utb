<?php
namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\University;
use App\Center;
use App\Area;

use DB;

use App\Http\Requests\AreauniRequest;

class CenterController extends Controller
{
     public function __construct()
     {
       $this->middleware('manager');
     }

    public function index()
    {
      $idc = Auth::user()->center_id;
      $objcen = Center::find($idc);
      return view('manager.center',compact('objcen'));
    }

    public function create()
    {
      $idu = Auth::user()->center_id;
      $data = Area::where('center_id',$idu)->orderby('name')->get();
      //$data = Area::get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
        <th>ลำดับ</th>
        <th>ชื่อชุมชน</th>
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
        $obj = new Area();
        $obj->university_id = Auth::user()->university_id;
        $obj->center_id = Auth::user()->center_id;
        $obj->name = $request['name'];
        $obj->tambon = $request['tambon'];
        $obj->amphur = $request['amphur'];
        $obj->province = $request['province'];
        $obj->lat = $request['lat'];
        $obj->lng = $request['lng'];
        $obj->zm = $request['zm'];
        $obj->context = $request['context'];
        $obj->people = $request['people'];
        $obj->health = $request['health'];
        $obj->environment = $request['environment'];
        $obj->keyman = $request['keyman'];
        $obj->tel = $request['tel'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}
    }

    public function show($id)
    {
        //$obj = Area::find($id);
        //dd($obj);
    }

    public function edit($id)
    {

      $data = Area::find($id);
      if($data->center_id == Auth::user()->center_id){
        header("Content-type: text/x-json");
        echo json_encode($data);
        exit();
      }
      abort(0);
    }

    public function update(AreauniRequest $request, $id)
    {
        $obj = Area::findOrFail($id);
        $obj->name = $request['name'];
        $obj->tambon = $request['tambon'];
        $obj->amphur = $request['amphur'];
        $obj->province = $request['province'];
        $obj->lat = $request['lat'];
        $obj->lng = $request['lng'];
        $obj->zm = $request['zm'];
        $obj->context = $request['context'];
        $obj->people = $request['people'];
        $obj->health = $request['health'];
        $obj->environment = $request['environment'];
        $obj->keyman = $request['keyman'];
        $obj->tel = $request['tel'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}
    }

    public function destroy($id)
    {

      $data = Area::find($id);
      if($data->center_id == Auth::user()->center_id){
    		$check = $data->delete();
        if($check>0){return 0;}else{return 1;}
      }
      abort(0);
    }
}
