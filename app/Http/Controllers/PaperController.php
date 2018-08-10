<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

use App\University;
use App\Researcher;
use App\Paper;

use App\Http\Requests\PaperRequest;

class PaperController extends Controller
{
     public function __construct()
     {
        // $this->middleware('auth');
     }

    public function index()
    {

        $objrsc = Researcher::all();
        return view('user.paper',compact('objrsc'));
    }

    public function create()
    {

      $data = Paper::get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th>ลำดับ</th>
          <th>ชื่อบทความวิชาการ</th>
          <th>ชื่อนักวิจัย</th>
          <th>เอกสาร</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
      ";
      $i=1;
      foreach ($data as $key) {
        $display .= "
        <tr>
          <td>".$i++."</td>
          <td>$key->title</td>
          <td>".$key->researcher->headname.$key->researcher->firstname." ".$key->researcher->lastname."</td>
          <td>";
          if($key->file){
            $display .= "<a href='".route('getfile', $key->file)."' target='blank' class='btn btn-warning btn-xs'>Download</a>";
          }
          $display .= "</td>
          </td>
          <td>
          <a data-id='$key->id' href='#' class='btn btn-primary btn-xs edit'><i class='fa fa-fw fa-edit'></i> EDIT</a>
          <a data-id='$key->id' href='#' class='btn btn-danger btn-xs delete'><i class='fa fa-fw fa-trash-o'></i> DELETE</a>
          </td>
        </tr>
        ";
      }
      $display .= "
        </tbody>
      </table>
      ";
      return $display;
    }

    public function store1(PaperRequest $request)
    {
      $id = $request->input('fileold');

      return $id;
    }

    public function store(PaperRequest $request)
    {
        //$id = $request->input('id');
        if($id = $request->input('id')){
          if($fileobj = $request->file('file')){
        		$extension = $fileobj->getClientOriginalExtension();
            $filename = $fileobj->getFilename().'.'.$extension;
            Storage::put($filename,  File::get($fileobj));
          }else{
            $filename=$request->input('fileold');
          }
          $entry = Paper::findOrFail($id);
        }else{
          if($fileobj = $request->file('file')){
        		$extension = $fileobj->getClientOriginalExtension();
            $filename = $fileobj->getFilename().'.'.$extension;
            Storage::put($filename,  File::get($fileobj));
          }else{
            $filename='';
          }
          $entry = new Paper();
        }

          $entry->researcher_id = $request->input('researcher_id');
          $entry->title = $request->input('title');
          $entry->keyword = $request->input('keyword');
          $entry->abstract = $request->input('abstract');
          $entry->file = $filename;
          $check = $entry->save();

          $objs = Paper::all();
          $data['objs'] = $objs->count();
          $data['check'] = $check;
          return $data;

    }

    public function show($id){}

    public function edit($id)
    {
      $data = Paper::find($id);
      return $data->toArray();
    }


    public function update(PaperRequest $request)
    {
      return "Hello";
    }

    public function destroy($id)
    {
      $data = Paper::find($id);
      Storage::delete($data->file);
      $check = $data->delete();
      $objs = Paper::all();
      $data['objs'] = $objs->count();
      $data['check'] = $check;
      return $data;
    }
}
