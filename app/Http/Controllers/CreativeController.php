<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

use App\University;
use App\Researcher;
use App\Taggroup;
use App\Creative;

use App\Http\Requests\CreativeRequest;

class CreativeController extends Controller
{
     public function __construct()
     {
        // $this->middleware('auth');
     }

    public function index()
    {
      $idu = Auth::user()->university_id;
      $objresch = Researcher::where('university_id',$idu)
      ->get();

      $objrsc = Researcher::get();
      $objuniver = University::lists('name','id');
      $objtag = Taggroup::lists('groupname','id');
      return view('user.creative',compact('objrsc','objtag','objuniver','objresch'));
    }

    public function create()
    {
      $idu = Auth::user()->university_id;
      if(Auth::user()->role->slug == 'Admin'){
        $data = Creative::orderby('title')->get();
      }else{
        $data = Creative::leftjoin('researchers','creatives.researcher_id','=','researchers.id')
        ->select('creatives.*')
        ->where('researchers.university_id',$idu)
        ->orderby('title')
        ->get();
      }
    //  $creobj = Creative::find(2);
      //$idu = $creobj->researcher->university_id;
      //$idu = '555';
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th>ลำดับ</th>
          <th>ชื่อผลงานสร้างสรรค์</th>
          <th>ชื่อนักวิจัย</th>
          <th>เอกสาร</th>
          <th data-sortable='false'>ดำเนินการ</th>
        </tr>
        </thead>
        <tbody>
      ";
      $i=1;
      foreach ($data as $key) {
        $display .= "
        <tr>
          <td>".$i++."</td>
          <td>$key->title ($key->createyear)</td>
          <td>".$key->researcher->headname.$key->researcher->firstname." ".$key->researcher->lastname."</td>
          <td>";
          if($key->file){
            $display .= "<a href='".route('getfile', $key->file)."' target='blank' class='btn btn-warning btn-xs'>Download</a>";
          }
          $display .= "</td>
          </td>
          <td>
          <a data-id='$key->id' href='#j' class='btn btn-primary btn-xs edit'><i class='fa fa-fw fa-edit'></i> แก้ไข</a>
          <a data-id='$key->id' href='#' class='btn btn-danger btn-xs delete'><i class='fa fa-fw fa-trash-o'></i> ลบข้อมูล</a>
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


    public function store(CreativeRequest $request)
    {
      if(Auth::user()->role->slug == 'Admin'){
        if($id = $request->input('id')){
          if($fileobj = $request->file('file')){
        		$extension = $fileobj->getClientOriginalExtension();
            $filename = $fileobj->getFilename().'.'.$extension;
            Storage::put($filename,  File::get($fileobj));
          }else{
            $filename=$request->input('fileold');
          }
          $entry = Creative::findOrFail($id);
        }else{
          if($fileobj = $request->file('file')){
        		$extension = $fileobj->getClientOriginalExtension();
            $filename = $fileobj->getFilename().'.'.$extension;
            Storage::put($filename,  File::get($fileobj));
          }else{
            $filename='';
          }
          $entry = new Creative();
        }
        $entry->taggroup_id = $request->input('taggroup_id');
        $entry->isced_id = $request->input('isced_id');
        $entry->researcher_id = $request->input('researcher_id');
          $entry->title = $request->input('title');
          $entry->keyword = $request->input('keyword');
          $entry->abstract = $request->input('abstract');
          $entry->file = $filename;
          $entry->contribute = $request->input('contribute');
          $entry->createyear = $request->input('createyear');
          $check = $entry->save();
        $objs = Creative::get();
        $data['objs'] = $objs->count();
        $data['check'] = $check;
        return $data;
      }else{
        $idres = $request->input('researcher_id');
        $creobj = Researcher::find($idres);
        $idu = $creobj->university_id;
        if(Auth::user()->university_id == $idu){
          if($id = $request->input('id')){
            if($fileobj = $request->file('file')){
          		$extension = $fileobj->getClientOriginalExtension();
              $filename = $fileobj->getFilename().'.'.$extension;
              Storage::put($filename,  File::get($fileobj));
            }else{
              $filename=$request->input('fileold');
            }
            $entry = Creative::findOrFail($id);
          }else{
            if($fileobj = $request->file('file')){
          		$extension = $fileobj->getClientOriginalExtension();
              $filename = $fileobj->getFilename().'.'.$extension;
              Storage::put($filename,  File::get($fileobj));
            }else{
              $filename='';
            }
            $entry = new Creative();
          }
          $entry->taggroup_id = $request->input('taggroup_id');
          $entry->isced_id = $request->input('isced_id');
          $entry->researcher_id = $request->input('researcher_id');
            $entry->title = $request->input('title');
            $entry->keyword = $request->input('keyword');
            $entry->abstract = $request->input('abstract');
            $entry->file = $filename;
            $entry->contribute = $request->input('contribute');
            $entry->createyear = $request->input('createyear');
            $check = $entry->save();

            $idu = Auth::user()->university_id;
              $objs = Creative::leftjoin('researchers','creatives.researcher_id','=','researchers.id')
              ->select('creatives.*')
              ->where('researchers.university_id',$idu)
              ->get();
            $data['objs'] = $objs->count();
            $data['check'] = $check;
            return $data;
        }
        abort(0);
      }
    }

    public function show($id){}

    public function edit($id)
    {
      $data = Creative::leftjoin('researchers','creatives.researcher_id','=','researchers.id')
              ->select('creatives.*','researchers.university_id','researchers.headname','researchers.firstname','researchers.lastname')
              ->find($id);
      return $data->toArray();
    }

    public function update(CreativeRequest $request)
    {
      return "Hello";
    }

    public function destroy($id)
    {
      if(Auth::user()->role->slug == 'Admin'){
        $data = Creative::find($id);
        Storage::delete($data->file);
        $check = $data->delete();
        $objs = Creative::all();
        $data['objs'] = $objs->count();
        $data['check'] = $check;
        return $data;
      }else{
        $creobj = Creative::find($id);
        $idu = $creobj->researcher->university_id;
        if(Auth::user()->university_id == $idu){
          $data = Creative::find($id);
          Storage::delete($data->file);
          $check = $data->delete();
          $idu = Auth::user()->university_id;
            $objs = Creative::leftjoin('researchers','creatives.researcher_id','=','researchers.id')
            ->select('creatives.*')
            ->where('researchers.university_id',$idu)
            ->get();
          $data['objs'] = $objs->count();
          $data['check'] = $check;
          return $data;
        }
        abort(0);
      }
    }
}
