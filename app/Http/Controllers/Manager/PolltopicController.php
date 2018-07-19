<?php
namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Polltopic;
use App\Pollanswer;

use App\Http\Requests\PolltopicRequest;

class PolltopicController extends Controller
{
     public function __construct()
     {
       //$this->middleware('organize');
     }

    public function index()
    {
      $ido = Auth::user()->organize_id;
      $data = Polltopic::where('organize_id',$ido)->get();
      //$data = Polltopic::where('organize_id',$ido)->get();
      return view('manager.polltopic',compact('data'));
    }

    public function create()
    {
      $idu = Auth::user()->organize_id;
      $data = Polltopic::where('organize_id',$idu)->get();
      //$data = Polltopic::get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
        <th width='70'>ลำดับ</th>
        <th>ชื่อแบบสำรวจ</th>
        <th>หมวดหมู่</th>
        <th width='130'>หัวข้อคำถาม</th>
        <th width='130' data-sortable='false'>ดำเนินการ</th>
        </tr>
        </thead>
        <tbody>
      ";
      $i=0;
      foreach ($data as $key) {
          $ans = Pollanswer::where('polltopic_id',$key->id)->get();
        $i++;
        $display .= "
        <tr>
          <td>$i</td>
          <td>$key->title</td>
          <td>";
          if($key->type==1){$display .= "ด้านการพัฒนาและส่งเสริม";}
          if($key->type==2){$display .= "การดูแลและป้องกัน";}
          if($key->type==3){$display .= "ด้านการให้บริการ";}
          if($key->type==4){$display .= "ด้านอื่นๆ";}
            $display .= "</td>
            <td><a data-id='$key->id' href='#k' class='btn btn-success btn-xs bntopic'>".count($ans)." หัวข้อ</a></td>
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

    public function store(PolltopicRequest $request)
    {
        $obj = new Polltopic();
        $obj->organize_id = Auth::user()->organize_id;
        $obj->title = $request['title'];
        $obj->type = $request['type'];
        $obj->detail = $request['detail'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}
    }

    public function show($id)
    {
        //$obj = Polltopic::find($id);
        //dd($obj);
    }

    public function bntopic($id)
    {
      $data = Pollanswer::find($id);
      if($data->organize_id == Auth::user()->organize_id){
        header("Content-type: text/x-json");
        echo json_encode($data);
        exit();
      }
      abort(0);
    }

    public function edit($id)
    {

      $data = Polltopic::find($id);
      if($data->organize_id == Auth::user()->organize_id){
        header("Content-type: text/x-json");
        echo json_encode($data);
        exit();
      }
      abort(0);
    }

    public function update(PolltopicRequest $request, $id)
    {

        $obj = Polltopic::findOrFail($id);
        $obj->title = $request['title'];
        $obj->type = $request['type'];
        $obj->detail = $request['detail'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}

    }

    public function destroy($id)
    {
      $data = Polltopic::find($id);
      if($data->organize_id == Auth::user()->organize_id){
    		$check = $data->delete();
        if($check>0){return 0;}else{return 1;}
      }
      abort(0);
    }
}
