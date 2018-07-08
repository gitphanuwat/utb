<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\University;
use App\Center;
use App\Area;

use App\Http\Requests\AreaRequest;

class AreaController extends Controller
{
     public function __construct()
     {
         $this->middleware('admin');
     }

    public function index()
    {
        $objuniver = University::lists('name','id');
        $objcenter = Center::lists('name','id');
        return view('admin.area',compact('objuniver','objcenter'));
    }

    public function create()
    {
      $data = Area::orderby('university_id')->get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th data-sortable='false'>ลำดับ</th>
          <th data-sortable='false'>ชื่อชุมชน</th>
          <th data-sortable='false'>ศูนย์จัดการ</th>
          <th data-sortable='false'>สังกัด</th>
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
          <td>".$key->center->university->name."</td>
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

    public function store(AreaRequest $request)
    {
      $obj = new Area();
        $obj->university_id = $request['university_id'];
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

    public function show($id)
    {
        //
        //$obj = Area::find($id);
        //dd($obj);

    }

    public function edit($id)
    {
      //dd($obj);
      // load view
      $data = Area::find($id);
      header("Content-type: text/x-json");
      echo json_encode($data);
      exit();
    }


    public function update(AreaRequest $request, $id)
    {
      $obj = Area::findOrFail($id);
      $obj->university_id = $request['university_id'];
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

    public function destroy($id)
    {
      $data = Area::find($id);
  		$check = $data->delete();
      if($check>0){return 0;}else{return 1;}
    }
}
