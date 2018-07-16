<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Amphur;
use App\Organize;
use App\Village;

use App\Http\Requests\VillageRequest;

class VillageController extends Controller
{
     public function __construct()
     {
         $this->middleware('admin');
     }

    public function index()
    {
        $objamphur = Amphur::lists('name','id');
        $objorganize = Organize::lists('name','id');
        return view('admin.village',compact('objamphur','objorganize'));
    }

    public function create()
    {
      $data = Village::orderby('amphur_id')->get();
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
          <td>".$key->name."</td>
          <td>".$key->name."</td>
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

    public function store(VillageRequest $request)
    {
      $obj = new Village();
        $obj->amphur_id = $request['amphur_id'];
        $obj->organize_id = $request['organize_id'];
        $obj->name = $request['name'];
        $obj->address = $request['address'];
        $obj->lat = $request['lat'];
        $obj->lng = $request['lng'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}
    }

    public function show($id)
    {
        //
        //$obj = Village::find($id);
        //dd($obj);

    }

    public function edit($id)
    {
      //dd($obj);
      // load view
      $data = Village::find($id);
      header("Content-type: text/x-json");
      echo json_encode($data);
      exit();
    }


    public function update(VillageRequest $request, $id)
    {
      $obj = Village::findOrFail($id);
      $obj->amphur_id = $request['amphur_id'];
      $obj->organize_id = $request['organize_id'];
      $obj->name = $request['name'];
      $obj->address = $request['address'];
      $check = $obj->save();
      if($check>0){return 0;}else{return 1;}
    }

    public function destroy($id)
    {
      $data = Village::find($id);
  		$check = $data->delete();
      if($check>0){return 0;}else{return 1;}
    }
}
