<?php
namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\University;
use App\Center;
use App\Area;

use DB;

use App\Http\Requests\CenterRequest;

class CenterController extends Controller
{
     public function __construct()
     {
       $this->middleware('manager');
     }

    public function index()
    {
      $idc = Auth::user()->center_id;
      $objcen = Center::find($idc);
      return view('manager.center',compact('objcen'));
    }

    public function create()
    {

    }

    public function store(AreauniRequest $request)
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

    public function update(CenterRequest $request, $id)
    {
        $obj = Center::findOrFail($id);
        $obj->name = $request['name'];
        $obj->moo = $request['moo'];
        $obj->tambon = $request['tambon'];
        $obj->amphur = $request['amphur'];
        $obj->province = $request['province'];
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
