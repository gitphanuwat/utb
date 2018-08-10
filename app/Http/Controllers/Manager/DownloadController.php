<?php
namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

use App\Download;
use App\Http\Requests\DownloadRequest;

class DownloadController extends Controller
{
  public function __construct()
  {
      $this->middleware('organize');
  }

    public function index()
    {
      $id = Auth::user()->organize_id;
      $data = Download::where('organize_id',$id)->get();
      return view('manager.download',compact('data'));
    }

    public function create()
    {
      $id = Auth::user()->organize_id;
      $data = Download::where('organize_id',$id)->get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th data-sortable='false'>ลำดับ</th>
          <th data-sortable='false'>ชื่อเอกสาร</th>
          <th data-sortable='false'>ไฟล์เอกสาร</th>
          <th data-sortable='false'>ประเภท</th>
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
          <td>";
          if($key->file){
            $display .= "<i class='ion ion-android-attach'></i> <a href='../files/download/".$key->file."'>".$key->file."</a>";
          }
          $display .= "</td>
          <td>";
          if($key->type==1){$display .= "ประกาศ";}
          if($key->type==2){$display .= "กฎระเบียบ";}
          if($key->type==3){$display .= "แบบฟอร์ม";}
          if($key->type==4){$display .= "เอกสารอื่นๆ";}
            $display .= "</td>
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

    public function store(DownloadRequest $request)
    {

            if($fileobj = $request->file('file')){
              $extension = $fileobj->getClientOriginalExtension();
              $filename = $fileobj->getFilename().'.'.$extension;
              $destinationPath = 'files/download';
              $fileobj->move($destinationPath,$filename);
            }else{
              $filename='';
            }
            $entry = new Download();
            $entry->organize_id = $request->input('organize_id');
            $entry->user_id = $request->input('user_id');
            $entry->title = $request->input('title');
            $entry->detail = $request->input('detail');
            $entry->type = $request->input('type');
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
      $data = Download::find($id);
      //return $data;
      header("Content-type: text/x-json");
      echo json_encode($data);
      exit();
    }

    public function downloadupdate(DownloadRequest $request, $id)
    {
      if($fileobj = $request->file('file')){
        $extension = $fileobj->getClientOriginalExtension();
        $filename = $fileobj->getFilename().'.'.$extension;
        $destinationPath = 'files/Download';
        $fileobj->move($destinationPath,$filename);
        //Storage::put($filename,  File::get($fileobj));
      }else{
        $filename=$request->input('fileold');
      }
      $entry = Download::findOrFail($id);
      $entry->title = $request->input('title');
      $entry->detail = $request->input('detail');
      $entry->type = $request->input('type');
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
      $data = Download::find($id);
      Storage::delete($data->file);
  		$check = $data->delete();
      if($check>0){return 0;}else{return 1;}
    }
}
