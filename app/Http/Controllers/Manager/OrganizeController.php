<?php
namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Organize;
//use App\Area;

use App\Http\Requests\OrganizeRequest;

class OrganizeController extends Controller
{
     public function __construct()
     {
       $this->middleware('organize');
     }

    public function index()
    {
      $idc = Auth::user()->organize_id;
      $objorg = Organize::find($idc);
      return view('manager.organize',compact('objorg'));
    }

    public function create()
    {

    }

    public function store(OrganizeRequest $request)
    {

    }

    public function show($id)
    {
        //$obj = Area::find($id);
        //dd($obj);
    }

    public function edit($id)
    {
      $data = Organize::findOrFail($id);
      if($data->id == Auth::user()->organize_id){
        header("Content-type: text/x-json");
        echo json_encode($data);
        exit();
      }
      abort(0);
    }

    public function update(OrganizeRequest $request, $id)
    {
      if($fileobj = $request->file('icon')){
        $extension = $fileobj->getClientOriginalExtension();
        $filename = $fileobj->getFilename().'.'.$extension;
        $destinationPath = 'images/organize';
        $fileobj->move($destinationPath,$filename);
      }else{
        $filename=$request->input('iconold');
      }
        $obj = Organize::findOrFail($id);
        $obj->title = $request['title'];
        $obj->name = $request['name'];
        $obj->type = $request['type'];
        $obj->address = $request['address'];
        $obj->website = $request['website'];
        $obj->facebook = $request['facebook'];
        $obj->tel = $request['tel'];
        $obj->lat = $request['lat'];
        $obj->lng = $request['lng'];
        $obj->zm = $request['zm'];
        $obj->icon = $filename;
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}
    }

    public function updatevision(Request $request, $id)
    {
        $obj = Organize::findOrFail($id);
        $obj->vision = $request['vision'];
        $obj->basic = $request['basic'];
        $obj->history = $request['history'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}
    }

    public function destroy($id)
    {


    }
}
