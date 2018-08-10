<?php
namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

use App\Info;
use App\Http\Requests\InfoRequest;

class InfoController extends Controller
{
  public function __construct()
  {
      $this->middleware('organize');
  }

    public function index()
    {
        return view('manager.info');
    }

    public function create()
    {
      $id = Auth::user()->organize_id;
      $data = Info::where('organize_id',$id)->get();
      //$data = Info::get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th data-sortable='false'>ลำดับ</th>
          <th data-sortable='false'>ชื่อ-สกุล</th>
          <th data-sortable='false'>วันที่</th>
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
          <td width='50'>$i</td>
          <td>$key->title</td>
          <td>$key->day</td>
          <td width='150'><a data-id='$key->id' href='#j' class='btn btn-primary btn-xs edit'> แก้ไข </a> <a data-id='$key->id' href='#' class='btn btn-danger btn-xs delete'> ลบข้อมูล </a></td>
        </tr>
        ";
      }
      $display .= "
        </tbody>
      </table>
      ";
      return $display;
    }

    public function store(InfoRequest $request)
    {

            if($fileobj = $request->file('file')){
              $extension = $fileobj->getClientOriginalExtension();
              $filename = $fileobj->getFilename().'.'.$extension;
              $destinationPath = 'images/info';
              $fileobj->move($destinationPath,$filename);
            }else{
              $filename='no_image.png';
            }
            $entry = new Info();
            $entry->organize_id = $request->input('organize_id');
            $entry->user_id = $request->input('user_id');
            $entry->title = $request->input('title');
            $entry->detail = $request->input('detail');
            $entry->day = date('Y-m-d h:i:sa');
            $entry->file = $filename;
            $check = $entry->save();
        $data['file'] = $filename;
        $data['check'] = $check;
        return $data;
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
      $data = Info::find($id);
      //return $data;
      header("Content-type: text/x-json");
      echo json_encode($data);
      exit();
    }

    public function infoupdate(InfoRequest $request, $id)
    {
      if($fileobj = $request->file('file')){
        $extension = $fileobj->getClientOriginalExtension();
        $filename = $fileobj->getFilename().'.'.$extension;
        $destinationPath = 'images/info';
        $fileobj->move($destinationPath,$filename);
        //Storage::put($filename,  File::get($fileobj));
      }else{
        $filename=$request->input('fileold');
      }
      $entry = Info::findOrFail($id);
      $entry->title = $request->input('title');
      $entry->detail = $request->input('detail');
      $entry->day = date('Y-m-d h:i:sa');
      $entry->file = $filename;
      $check = $entry->save();
      //$file = Storage::url($filename);
      //if($check>0){return 0;}else{return 1;}
      $data['file'] = $filename;
      $data['check'] = $check;
      return $data;

    }

    public function destroy($id)
    {
      $data = Info::find($id);
      Storage::delete($data->file);
  		$check = $data->delete();
      if($check>0){return 0;}else{return 1;}
    }
}
