<?php
namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Organize;
//use App\Area;

use DB;

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

    }

    public function update(OrganizeRequest $request, $id)
    {
        $obj = Organize::findOrFail($id);
        $obj->name = $request['name'];
        $obj->address = $request['address'];
        $obj->lat = $request['lat'];
        $obj->lng = $request['lng'];
        $obj->zm = $request['zm'];
        $obj->tel = $request['tel'];
        $check = $obj->save();
        if($check>0){return 0;}else{return 1;}
    }

    public function destroy($id)
    {


    }
}
