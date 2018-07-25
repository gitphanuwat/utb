<?php
namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Organize;
use App\Tourist;


use App\Http\Requests\TouristRequest;

class TouristController extends Controller
{
     public function __construct()
     {
       //$this->middleware('organize');
     }

    public function index()
    {
      $ido = Auth::user()->organize_id;
      $data = Tourist::where('organize_id',$ido)->get();
      return view('manager.tourist',compact('data'));
    }

    public function create()
    {
      $idu = Auth::user()->organize_id;
      $data = Tourist::where('organize_id',$idu)->orderby('name')->get();
      //$data = Tourist::get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
        <th width='70'>ลำดับ</th>
        <th>แหล่งท่องเที่ยว</th>
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

    public function store(TouristRequest $request)
    {
      if($fileobj = $request->file('picture')){
        $extension = $fileobj->getClientOriginalExtension();
        $filename = $fileobj->getFilename().'.'.$extension;
        $destinationPath = 'images/tourist';
        $fileobj->move($destinationPath,$filename);
      }else{
        $filename='no_image.png';
      }
        $obj = new Tourist();
        $obj->organize_id = Auth::user()->organize_id;
        $obj->name = $request['name'];
        $obj->detail = $request['detail'];
        $obj->address = $request['address'];
        $obj->picture = $filename;
        $obj->lat = $request['lat'];
        $obj->lng = $request['lng'];
        $obj->zm = $request['zm'];
        $obj->website = $request['website'];
        $obj->contact = $request['contact'];
        $check = $obj->save();
        $data['file'] = $filename;
        $data['check'] = $check;
        return $data;
    }

    public function show($id)
    {
        //$obj = Tourist::find($id);
        //dd($obj);
    }

    public function edit($id)
    {

      $data = Tourist::find($id);
      if($data->organize_id == Auth::user()->organize_id){
        header("Content-type: text/x-json");
        echo json_encode($data);
        exit();
      }
      abort(0);
    }
    public function update($id)
    {
    }

    public function touristupdate(TouristRequest $request, $id)
    {
      if($fileobj = $request->file('picture')){
        $extension = $fileobj->getClientOriginalExtension();
        $filename = $fileobj->getFilename().'.'.$extension;
        $destinationPath = 'images/tourist';
        $fileobj->move($destinationPath,$filename);
        //Storage::put($filename,  File::get($fileobj));
      }else{
        $filename=$request->input('pictureold');
      }
        $obj = Tourist::findOrFail($id);
        $obj->name = $request['name'];
        $obj->detail = $request['detail'];
        $obj->address = $request['address'];
        $obj->picture = $filename;
        $obj->lat = $request['lat'];
        $obj->lng = $request['lng'];
        $obj->zm = $request['zm'];
        $obj->website = $request['website'];
        $obj->contact = $request['contact'];
        $check = $obj->save();
        $data['file'] = $filename;
        $data['check'] = $check;
        return $data;
    }

    public function destroy($id)
    {
      $data = Tourist::find($id);
      if($data->organize_id == Auth::user()->organize_id){
    		$check = $data->delete();
        if($check>0){return 0;}else{return 1;}
      }
      abort(0);
    }
}
