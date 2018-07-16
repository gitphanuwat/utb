<?php
namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

use App\Person;
use App\Http\Requests\PersonRequest;

class PersonController extends Controller
{
  public function __construct()
  {
      $this->middleware('organize');
  }

    public function index()
    {
        return view('manager.person');
    }

    public function create()
    {
      $id = Auth::user()->organize_id;
      $data = Person::where('organize_id',$id)->get();
      //$data = Person::get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th data-sortable='false'>ลำดับ</th>
          <th data-sortable='false'>ชื่อ-สกุล</th>
          <th data-sortable='false'>ตำแหน่ง</th>
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
          <td>$key->headname$key->firstname $key->lastname</td>
          <td>$key->position</td>
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

    public function store(PersonRequest $request)
    {

            if($fileobj = $request->file('picture')){
              $extension = $fileobj->getClientOriginalExtension();
              $filename = $fileobj->getFilename().'.'.$extension;
              $destinationPath = 'images/person';
              $fileobj->move($destinationPath,$filename);
            }else{
              $filename='';
            }
            $entry = new Person();
            $entry->organize_id = $request->input('organize_id');
            $entry->headname = $request->input('headname');
            $entry->firstname = $request->input('firstname');
            $entry->lastname = $request->input('lastname');
            $entry->position = $request->input('position');
            $entry->duedate = $request->input('duedate');
            $entry->tel = $request->input('tel');
            $entry->email = $request->input('email');
            $entry->picture = $filename;
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
      $data = Person::find($id);
      //return $data;
      header("Content-type: text/x-json");
      echo json_encode($data);
      exit();
    }

    public function personupdate(PersonRequest $request, $id)
    {
      if($fileobj = $request->file('picture')){
        $extension = $fileobj->getClientOriginalExtension();
        $filename = $fileobj->getFilename().'.'.$extension;
        $destinationPath = 'images/person';
        $fileobj->move($destinationPath,$filename);
        //Storage::put($filename,  File::get($fileobj));
      }else{
        $filename=$request->input('pictureold');
      }
      $entry = Person::findOrFail($id);
      $entry->headname = $request->input('headname');
      $entry->firstname = $request->input('firstname');
      $entry->lastname = $request->input('lastname');
      $entry->position = $request->input('position');
      $entry->duedate = $request->input('duedate');
      $entry->tel = $request->input('tel');
      $entry->email = $request->input('email');
      $entry->picture = $filename;
      $check = $entry->save();
      //$file = Storage::url($filename);
      //if($check>0){return 0;}else{return 1;}
      $data['file'] = $filename;
      $data['check'] = $check;
      return $data;

    }

    public function destroy($id)
    {
      $data = Person::find($id);
      Storage::delete($data->picture);
  		$check = $data->delete();
      if($check>0){return 0;}else{return 1;}
    }
}
