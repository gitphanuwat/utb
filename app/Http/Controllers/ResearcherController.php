<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\University;
use App\Taggroup;
use App\Researcher;
use App\Expertlist;

use App\Http\Requests\ResearcherRequest;

class ResearcherController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth');
     }

    public function index()
    {
        $objuniver = University::lists('name','id');
        $objtag = Taggroup::lists('groupname','id');
        return view('user.researcher',compact('objuniver','objtag'));
    }

    public function create()
    {
      $idu = Auth::user()->university_id;
      if(Auth::user()->role->slug == 'Admin'){
        $data = Researcher::orderby('firstname')->get();
      }else{
        $data = Researcher::where('university_id',$idu)->orderby('firstname')->get();
      }

      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th>ลำดับ</th>
          <th>ชื่อนักวิจัย</th>
          <th>สังกัด</th>
          <th>ความเชี่ยวชาญ</th>
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
          <td>$key->headname$key->firstname $key->lastname</td>
          <td>".$key->university->name."</td>
          <td><a data-id='$key->id' href='#' class='btn btn-warning btn-xs upexpert'>EXPERT <span class='badge'>".count($key->expertlist)."</span></a>
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


    public function store(ResearcherRequest $request)
    {
      $obj = new Researcher();
      $obj->university_id = $request['university_id'];
      $obj->headname = $request['headname'];
      $obj->firstname = $request['firstname'];
      $obj->lastname = $request['lastname'];
      $obj->address = $request['address'];
      $obj->tel = $request['tel'];
      $obj->email = $request['email'];
      $check = $obj->save();
      //if($check>0){return 0;}else{return 1;}
      $idu = Auth::user()->university_id;
      if(Auth::user()->role->slug == 'Admin'){
        $objs = Researcher::get();
      }else{
        $objs = Researcher::where('university_id',$idu)->get();
      }

      $data['objs'] = $objs->count();
      $data['check'] = $check;
      return $data;


    }

    public function show($id){}

    public function edit($id)
    {
      if(Auth::user()->role->slug == 'Admin'){
        $data = Researcher::find($id);
        return $data->toArray();
      }else{
        $data = Researcher::find($id);
        if(Auth::user()->university_id == $data->university_id){
          return $data->toArray();
        }
        abort(0);
      }
    }

    public function update(ResearcherRequest $request, $id)
    {
      if(Auth::user()->role->slug == 'Admin'){
        $obj = Researcher::findOrFail($id);
          $obj->university_id = $request['university_id'];
          $obj->headname = $request['headname'];
          $obj->firstname = $request['firstname'];
          $obj->lastname = $request['lastname'];
          $obj->address = $request['address'];
          $obj->tel = $request['tel'];
          $obj->email = $request['email'];
          $check = $obj->save();
          if($check>0){return 0;}else{return 1;}
      }else{
        $obj = Researcher::findOrFail($id);
        if(Auth::user()->university_id == $obj->university_id){
          //$obj->university_id = $request['university_id'];
          $obj->headname = $request['headname'];
          $obj->firstname = $request['firstname'];
          $obj->lastname = $request['lastname'];
          $obj->address = $request['address'];
          $obj->tel = $request['tel'];
          $obj->email = $request['email'];
          $check = $obj->save();
          if($check>0){return 0;}else{return 1;}
        }
        abort(0);
      }
    }

    public function destroy($id)
    {
      if(Auth::user()->role->slug == 'Admin'){
        $data = Researcher::find($id);
            $data2 = Expertlist::where('researcher_id', $id);
            $check = $data->delete();
            $check2 = $data2->delete();
              $objs = Researcher::all();
              $data['objs'] = $objs->count();
              $data['check'] = $check;
            return $data;
      }else{
          $data = Researcher::find($id);
          if(Auth::user()->university_id == $data->university_id){
              $data2 = Expertlist::where('researcher_id', $id);
          		$check = $data->delete();
              $check2 = $data2->delete();
                $objs = Researcher::all();
                $data['objs'] = $objs->count();
                $data['check'] = $check;
              return $data;
          }
          abort(0);
      }
    }
}
