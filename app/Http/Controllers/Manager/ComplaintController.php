<?php
namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Organize;
use App\Complaint;



use App\Http\Requests\ComplaintRequest;

class ComplaintController extends Controller
{
     public function __construct()
     {
       //$this->middleware('organize');
     }

    public function index()
    {
      $ido = Auth::user()->organize_id;
      $data = Complaint::where('organize_id',$ido)->get();
      return view('manager.complaint',compact('data'));
    }

    public function create()
    {
      $idu = Auth::user()->organize_id;
      $data = Complaint::where('organize_id',$idu)->orderby('name')->get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
        <th width='70'>ลำดับ</th>
        <th>เรื่องร้องเรียน</th>
        <th>ผู้ส่งข้อมูล</th>
        <th>สถานะ</th>
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
          <td> ".$key->sender."</td>
          <td>";
          if($key->status==1){$display .= "นำเข้าระบบ";}
          if($key->status==2){$display .= "กำลังดำเนินการ";}
          if($key->status==3){$display .= "ดำเนินการแล้วเสร็จ";}
            $display .= "</td>
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

    public function store(ComplaintRequest $request)
    {
        $obj = new Complaint();
        $obj->organize_id = Auth::user()->organize_id;
        $obj->name = $request['name'];
        $obj->type = $request['type'];
        $obj->detail = $request['detail'];
        $obj->sender = $request['sender'];
        $obj->contact = $request['contact'];
        $obj->status = $request['status'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}
    }

    public function show($id)
    {
    }

    public function edit($id)
    {

      $data = Complaint::find($id);
      if($data->organize_id == Auth::user()->organize_id){
        header("Content-type: text/x-json");
        echo json_encode($data);
        exit();
      }
      abort(0);
    }

    public function update(ComplaintRequest $request, $id)
    {

        $obj = Complaint::findOrFail($id);
        $obj->name = $request['name'];
        $obj->type = $request['type'];
        $obj->detail = $request['detail'];
        $obj->sender = $request['sender'];
        $obj->contact = $request['contact'];
        $obj->status = $request['status'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}

    }

    public function destroy($id)
    {
      $data = Complaint::find($id);
      if($data->organize_id == Auth::user()->organize_id){
    		$check = $data->delete();
        if($check>0){return 0;}else{return 1;}
      }
      abort(0);
    }
}
