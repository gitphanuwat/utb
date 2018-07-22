<?php
namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Organize;
use App\Village;


use App\Http\Requests\VillageRequest;

class VillageController extends Controller
{
     public function __construct()
     {
       //$this->middleware('organize');
     }

    public function index()
    {
      $idu = Auth::user()->organize_id;
      $data = Village::where('organize_id',$idu)->get();
      return view('manager.village',compact('data'));
    }

    public function create()
    {
      $idu = Auth::user()->organize_id;
      $data = Village::where('organize_id',$idu)->get();
      //$data = Village::get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
        <th width='70'>ลำดับ</th>
        <th>ชื่อชุมชน</th>
        <th>ที่อยู่</th>
        <th width='130' data-sortable='false'>ดำเนินการ</th>
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
          <td> ".$key->address."</td>
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
        $obj->organize_id = Auth::user()->organize_id;
        $obj->name = $request['name'];
        $obj->address = $request['address'];
        $obj->lat = $request['lat'];
        $obj->lng = $request['lng'];
        $obj->zm = $request['zm'];
        $obj->people = $request['people'];
        $obj->leader = $request['leader'];
        $obj->tel = $request['tel'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}
    }

    public function show($id)
    {
        //$obj = Village::find($id);
        //dd($obj);
    }

    public function edit($id)
    {

      $data = Village::find($id);
      if($data->organize_id == Auth::user()->organize_id){
        header("Content-type: text/x-json");
        echo json_encode($data);
        exit();
      }
      abort(0);
    }

    public function update(VillageRequest $request, $id)
    {

        $obj = Village::findOrFail($id);
        $obj->name = $request['name'];
        $obj->address = $request['address'];
        $obj->lat = $request['lat'];
        $obj->lng = $request['lng'];
        $obj->zm = $request['zm'];
        $obj->people = $request['people'];
        $obj->leader = $request['leader'];
        $obj->tel = $request['tel'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}

        //return 0;

    }

    public function destroy($id)
    {
      $data = Village::find($id);
      if($data->organize_id == Auth::user()->organize_id){
    		$check = $data->delete();
        if($check>0){return 0;}else{return 1;}
      }
      abort(0);
    }
}
