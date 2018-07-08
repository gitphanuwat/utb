<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

use App\Research;
use App\Doc;
use App\Areafile;

use App\Http\Requests\DocRequest;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $id = $request['id'];
      $obj = Research::find($id);
      $data = Doc::where('research_id', $id)->get();
      $display = "<h3>เอกสารงานวิจัย : ".$obj->title_th."</h3>";
      $display .= "<h4>รายการเอกสาร</h4>";
      $display .= "
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th>ลำดับ</th>
          <th>ชื่อเอกสาร</th>
          <th>ไฟล์เอกสาร</th>
          <th>จำนวนครั้งการโหลด</th>
          <th>ดำเนินการ</th>
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
          <td><a href='".route('getfile', $key->file)."' target='blank'>$key->file</a></td>
          <td>".$key->cload."</td>
          <td>
          <a data-id='$key->id' href='#' class='btn btn-danger btn-xs deleteexp'><i class='fa fa-fw fa-trash-o'></i> ลบไฟล์</a>
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocRequest $request)
    {
      if(Auth::user()->role->slug == 'Admin'){
        $fileobj = $request->file('filefield');
    		$extension = $fileobj->getClientOriginalExtension();
        $filename = $fileobj->getFilename().time().'.'.$extension;
        $destinationPath = 'uploads';
        Storage::put($filename,  File::get($fileobj));
        $entry = new Doc();
        $entry->research_id = $request->input('research_id');
    		$entry->title = $request->input('title');
        $entry->file = $filename;
        $check = $entry->save();
        if($check>0){return 0;}else{return 1;}
      }else{
        $id = $request->input('research_id');
        $resobj = Research::find($id);
        $idu = $resobj->researcher->university_id;
        if(Auth::user()->university_id == $idu){
          $fileobj = $request->file('filefield');
      		$extension = $fileobj->getClientOriginalExtension();
          $filename = $fileobj->getFilename().time().'.'.$extension;
          $destinationPath = 'uploads';
          Storage::put($filename,  File::get($fileobj));
          $entry = new Doc();
          $entry->research_id = $request->input('research_id');
      		$entry->title = $request->input('title');
          $entry->file = $filename;
          $check = $entry->save();
          if($check>0){return 0;}else{return 1;}
        }
        abort(0);
      }
    }

    public function areaFile(Request $request)
    {
      return 'yes';
    }

/*
    public function areaFile1(Request $request)
    {
      if(Auth::user()->role->slug == 'Admin'){
        $fileobj = $request->file('filefield');
    		$extension = $fileobj->getClientOriginalExtension();
        $filename = $fileobj->getFilename().time().'.'.$extension;
        $destinationPath = 'uploads';
        Storage::put($filename,  File::get($fileobj));
        $entry = new Doc();
        $entry->research_id = $request->input('research_id');
    		$entry->title = $request->input('title');
        $entry->file = $filename;
        $check = $entry->save();
        if($check>0){return 0;}else{return 1;}
      }else{
        //$id = $request->input('area_id');
        //$resobj = Research::find($id);
        //$idu = $resobj->researcher->university_id;
        //if(Auth::user()->university_id == $idu){
        if(1){
          $fileobj = $request->file('filefield');
      		$extension = $fileobj->getClientOriginalExtension();
          $filename = $fileobj->getFilename().time().'.'.$extension;
          $destinationPath = 'uploads';
          Storage::put($filename,  File::get($fileobj));
          $entry = new Areafile();
          $entry->area_id = $request->input('area_id');
          $entry->filetype = $request->input('filetype');
      		$entry->filename = $request->input('filename');
          $entry->fullname = $filename;
          $check = $entry->save();
          if($check>0){return 0;}else{return 1;}
        }
        abort(0);
      }
    }
*/
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if(Auth::user()->role->slug == 'Admin'){
        $data = Doc::find($id);
        Storage::delete($data->file);
    		$check = $data->delete();
        if($check>0){return 0;}else{return 1;}
      }else{
        $docobj = Doc::find($id);
        $idu = $docobj->research->researcher->university_id;
        if(Auth::user()->university_id == $idu){
          $data = Doc::find($id);
          Storage::delete($data->file);
      		$check = $data->delete();
          if($check>0){return 0;}else{return 1;}
        }
        abort(0);
      }
    }

    public function getload($filename)
    {
      $file = Storage::get($filename);
  		return (new Response($file, 200))->header('Content-Type', $filename);
  	}

    public function get($filename)
    {
  		//$entry = Doc::where('file', '=', $filename)->firstOrFail();
  		//$file = Storage::get($entry->file);
      $file = Storage::get($filename);
      $docobj = Doc::where('file',$filename)->first();
      $docobj->cload = $docobj->cload+1;
      $docobj->save();

  		return (new Response($file, 200))
                //->header('Content-Type', $entry->title);
                ->header('Content-Type', $docobj->file);
  	}
}
