<?php
namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Organize;
use App\Problem;



use App\Http\Requests\ProblemRequest;

class ProblemController extends Controller
{
     public function __construct()
     {
       //$this->middleware('organize');
     }

    public function index()
    {
      $ido = Auth::user()->organize_id;
      $data = Problem::where('organize_id',$ido)->get();
      return view('manager.Problem',compact('data'));
    }

    public function create()
    {
      $idu = Auth::user()->organize_id;
      $data = Problem::where('organize_id',$idu)->orderby('name')->get();
      //$data = Problem::get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
        <th width='70'>ลำดับ</th>
        <th>ปัญหาชุมชน</th>
        <th>พื้นที่ชุมชน</th>
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

    public function store(ProblemRequest $request)
    {
        $obj = new Problem();
        $obj->organize_id = Auth::user()->organize_id;
        $obj->name = $request['name'];
        $obj->type = $request['type'];
        $obj->detail = $request['detail'];
        $obj->address = $request['address'];
        $obj->status = $request['status'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}
    }

    public function show($id)
    {
        //$obj = Problem::find($id);
        //dd($obj);
    }

    public function edit($id)
    {

      $data = Problem::find($id);
      if($data->organize_id == Auth::user()->organize_id){
        header("Content-type: text/x-json");
        echo json_encode($data);
        exit();
      }
      abort(0);
    }

    public function update(ProblemRequest $request, $id)
    {

        $obj = Problem::findOrFail($id);
        $obj->name = $request['name'];
        $obj->type = $request['type'];
        $obj->detail = $request['detail'];
        $obj->address = $request['address'];
        $obj->status = $request['status'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}

    }

    public function destroy($id)
    {
      $data = Problem::find($id);
      if($data->organize_id == Auth::user()->organize_id){
    		$check = $data->delete();
        if($check>0){return 0;}else{return 1;}
      }
      abort(0);
    }
}
