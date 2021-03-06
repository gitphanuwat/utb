<?php
namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Organize;
use App\Activity;


use App\Http\Requests\ActivityRequest;

class ActivityController extends Controller
{
     public function __construct()
     {
       //$this->middleware('organize');
     }

    public function index()
    {
      $ido = Auth::user()->organize_id;
      $data = Activity::where('organize_id',$ido)->get();
      return view('manager.activity',compact('data'));
    }

    public function create()
    {
      $idu = Auth::user()->organize_id;
      $data = Activity::where('organize_id',$idu)->orderby('name')->get();
      //$data = Activity::get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
        <th width='70'>ลำดับ</th>
        <th>เรื่องเด่น</th>
        <th>กลุ่ม</th>
        <th>ที่อยู่</th>
        <th width='130' data-sortable='false'>ดำเนินการ</th>
        </tr>
        </thead>
        <tbody>
      ";
      $i=0;
      $arrtype=array('','โครงการเด่น','สถานที่สำคัญ','ผลิตภัณฑ์ชุมชน','เรื่องอื่นๆ');
      foreach ($data as $key) {
        $i++;
        $display .= "
        <tr>
          <td>$i</td>
          <td>$key->name</td>
          <td>".$arrtype[$key->type]."</td>
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

    public function store(ActivityRequest $request)
    {
        $obj = new Activity();
        $obj->organize_id = Auth::user()->organize_id;
        $obj->name = $request['name'];
        $obj->type = $request['type'];
        $obj->detail = $request['detail'];
        $obj->address = $request['address'];
        $obj->leader = $request['leader'];
        $obj->picture = $request['picture'];
        $obj->tel = $request['tel'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}
    }

    public function show($id)
    {
        //$obj = Activity::find($id);
        //dd($obj);
    }

    public function edit($id)
    {

      $data = Activity::find($id);
      if($data->organize_id == Auth::user()->organize_id){
        header("Content-type: text/x-json");
        echo json_encode($data);
        exit();
      }
      abort(0);
    }

    public function update(ActivityRequest $request, $id)
    {

        $obj = Activity::findOrFail($id);
        $obj->name = $request['name'];
        $obj->type = $request['type'];
        $obj->detail = $request['detail'];
        $obj->address = $request['address'];
        $obj->leader = $request['leader'];
        $obj->picture = $request['picture'];
        $obj->tel = $request['tel'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}

        //return 0;

    }

    public function destroy($id)
    {
      $data = Activity::find($id);
      if($data->organize_id == Auth::user()->organize_id){
    		$check = $data->delete();
        if($check>0){return 0;}else{return 1;}
      }
      abort(0);
    }
}
