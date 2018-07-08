<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\University;
use App\Taggroup;
use App\Researcher;
use App\Research;

use App\Http\Requests\ResearchRequest;

class ResearchController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth');
     }

    public function index()
    {
      $idu = Auth::user()->university_id;
      $objresch = Researcher::where('university_id',$idu)->get();
        $objrsc = Researcher::get();
        $objuniver = University::lists('name','id');
        $objtag = Taggroup::lists('groupname','id');
        return view('user.research',compact('objrsc','objtag','objuniver','objresch'));
    }

    public function create()
    {
      $idu = Auth::user()->university_id;
      if(Auth::user()->role->slug == 'Admin'){
        $data = Research::orderby('title_th')->get();
      }else{
        $data = Research::leftjoin('researchers','researchs.researcher_id','=','researchers.id')
        ->select('researchs.*')
        ->where('researchers.university_id',$idu)
        ->orderby('title_th')
        ->get();
      }

      //$data = Research::get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th>ลำดับ</th>
          <th>ชื่องานวิจัย</th>
          <th style='width:200px'>ชื่อนักวิจัย</th>
          <th>เอกสาร</th>
          <th data-sortable='false' style='width:120px'>ดำเนินการ</th>
        </tr>
        </thead>
        <tbody>
      ";
      $i=1;
      foreach ($data as $key) {
        $display .= "
        <tr>
          <td>".$i++."</td>
          <td>$key->title_th ($key->createyear)</td>
          <td>".$key->researcher->headname.$key->researcher->firstname." ".$key->researcher->lastname."</td>
          <td><a data-id='$key->id' href='#' class='btn btn-warning btn-xs upexpert'>Documents <span class='badge'>".count($key->doc)."</span></a>
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

    public function store(ResearchRequest $request)
    {
      if(Auth::user()->role->slug == 'Admin'){
        $obj = new Research();
        $obj->taggroup_id = $request['taggroup_id'];
        $obj->isced_id = $request['isced_id'];
        $obj->researcher_id = $request['researcher_id'];
        $obj->title_th = $request['title_th'];
        $obj->title_eng = $request['title_eng'];
        $obj->propose = $request['propose'];
        $obj->keyword = $request['keyword'];
        $obj->abstract = $request['abstract'];
        $obj->contributor = $request['contributor'];
        $obj->expert = $request['expert'];
        $obj->createyear = $request['createyear'];
        $check = $obj->save();
      }else{
        $id = $request['researcher_id'];
        $researcherobj = Researcher::find($id);
        if(Auth::user()->university_id == $researcherobj->university_id){

          $obj = new Research();
          $obj->taggroup_id = $request['taggroup_id'];
          $obj->isced_id = $request['isced_id'];
          $obj->researcher_id = $request['researcher_id'];
          $obj->title_th = $request['title_th'];
          $obj->title_eng = $request['title_eng'];
          $obj->propose = $request['propose'];
          $obj->keyword = $request['keyword'];
          $obj->abstract = $request['abstract'];
          $obj->contributor = $request['contributor'];
          $obj->expert = $request['expert'];
          $obj->createyear = $request['createyear'];
          $check = $obj->save();
        }
      }

      $idu = Auth::user()->university_id;
      if(Auth::user()->role->slug == 'Admin'){
        $objs = Research::get();
      }else{
        $objs = Research::leftjoin('researchers','researchs.researcher_id','=','researchers.id')
        ->select('researchs.*')
        ->where('researchers.university_id',$idu)
        ->get();
      }
      //$objs = Research::all();
      $data['objs'] = $objs->count();
      $data['check'] = $check;
      return $data;
    }

    public function show($id){}

    public function edit($id)
    {
      $data = Research::leftjoin('researchers','researchs.researcher_id','=','researchers.id')
              ->select('researchs.*','researchers.university_id','researchers.headname','researchers.firstname','researchers.lastname')
              ->find($id);
      return $data->toArray();
    }


    public function update(ResearchRequest $request, $id)
    {
      //dd($request['contributor']);
      if(Auth::user()->role->slug == 'Admin'){
        $obj = Research::findOrFail($id);
        $obj->taggroup_id = $request['taggroup_id'];
        $obj->isced_id = $request['isced_id'];
        //$obj->researcher_id = $request['researcher_id'];
        $obj->title_th = $request['title_th'];
        $obj->title_eng = $request['title_eng'];
        $obj->propose = $request['propose'];
        $obj->keyword = $request['keyword'];
        $obj->abstract = $request['abstract'];
        $obj->contributor = $request['contributor'];
        $obj->expert = $request['expert'];
        $obj->createyear = $request['createyear'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}
      }else{
        $research = Research::find($id);
        $idu = $research->researcher->university_id;
        if(Auth::user()->university_id == $idu){
          $obj = Research::findOrFail($id);
          $obj->taggroup_id = $request['taggroup_id'];
          $obj->isced_id = $request['isced_id'];
          //$obj->researcher_id = $request['researcher_id'];
          $obj->title_th = $request['title_th'];
          $obj->title_eng = $request['title_eng'];
          $obj->propose = $request['propose'];
          $obj->keyword = $request['keyword'];
          $obj->abstract = $request['abstract'];
          $obj->contributor = $request['contributor'];
          $obj->expert = $request['expert'];
          $obj->createyear = $request['createyear'];
          $check = $obj->save();
          if($check>0){return 0;}else{return 1;}
        }
        abort(0);
      }
    }

    public function destroy($id)
    {
      if(Auth::user()->role->slug == 'Admin'){
        $data = Research::find($id);
    		$check = $data->delete();
            $objs = Research::all();
            $data['objs'] = $objs->count();
            $data['check'] = $check;
            return $data;
      }else{
        $research = Research::find($id);
        $idu = $research->researcher->university_id;
        if(Auth::user()->university_id == $idu){
          $data = Research::find($id);
      		$check = $data->delete();
              $objs = Research::leftjoin('researchers','researchs.researcher_id','=','researchers.id')
              ->where('researchers.university_id',Auth::user()->university_id)
              ->select('researchs.*')
              ->get();
              $data['objs'] = $objs->count();
              $data['check'] = $check;
              return $data;
        }
        abort(0);
      }
    }

}
