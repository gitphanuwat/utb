<?php
namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Polltopic;
use App\Pollanswer;

use App\Http\Requests\PollanswerRequest;

class PollanswerController extends Controller
{
     public function __construct()
     {
       //$this->middleware('organize');
     }

    public function index()
    {

    }

    public function create()
    {

    }

    public function store(PollanswerRequest $request)
    {
        $obj = new Pollanswer();
        $obj->polltopic_id = $request['polltopic_id'];
        $obj->user_id = $request['user_id'];
        $obj->title = $request['title'];
        $obj->detail = $request['detail'];
        $check = $obj->save();
        $data['polltopic_id'] = $request['polltopic_id'];
        $data['check'] = $check;
        return $data;
        //if($check>0){return 0;}else{return 1;}
    }

    public function show($id)
    {
      //$idu = Auth::user()->organize_id;
      $topic=Polltopic::find($id);
      $data = Pollanswer::where('polltopic_id',$id)->get();
      //$data = Pollanswer::get();
      $display="<h3>แบบสำรวจ : ".$topic->title."</h3>";
      $display .="
      <table id='example2' class='table table-bordered table-striped'>
        <thead>
        <tr>
        <th width='70'>ลำดับ</th>
        <th>หัวข้อสำรวจ</th>
        <th>คะแนน</th>
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
          <td>$key->title</td>
          <td>$key->score</td>
          <td><a data-id='$key->id' href='#j' class='btn btn-primary btn-xs edittopic'>แก้ไข</a> <a data-id='$key->id' href='#' class='btn btn-danger btn-xs deletetopic'>ลบข้อมูล</a></td>
        </tr>
        ";
      }
      $display .= "
        </tbody>
      </table>
      ";
      return $display;
    }

    public function bnanswer($id)
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

      $data = Pollanswer::find($id);
      if($data->organize_id == Auth::user()->organize_id){
        header("Content-type: text/x-json");
        echo json_encode($data);
        exit();
      }
      abort(0);
    }

    public function update(PollanswerRequest $request, $id)
    {

        $obj = Pollanswer::findOrFail($id);
        $obj->title = $request['title'];
        $obj->type = $request['type'];
        $obj->detail = $request['detail'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}

    }

    public function destroy($id)
    {
      $data = Pollanswer::find($id);
      if($data->organize_id == Auth::user()->organize_id){
    		$check = $data->delete();
        if($check>0){return 0;}else{return 1;}
      }
      abort(0);
    }
}
