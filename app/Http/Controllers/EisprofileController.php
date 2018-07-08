<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Researcher;
use App\Expert;
use App\Expertlist;
use App\Research;
use App\Creative;
use App\Area;
use App\Problem;

use App\University;
use App\Taggroup;
use App\Useful;

class EisprofileController extends Controller
{
  public function showProfile(Request $request)
  {
    $id = $request['id'];
    $objresch = Researcher::find($id);
    $objexp = Expertlist::where('researcher_id', $id)->get();
    $objres = Research::where('researcher_id', $id)->get();

    $contributor = array();
    $objrescon = Research::get();
    foreach ($objrescon as $keyres) {
        $string = $keyres->contributor;
        $arrcon = explode(",", $string);
        foreach ($arrcon as $key) {
          if(is_numeric($key) and $key>0 and $key==$id){
            $obj = Research::find($keyres->id);
            @$contributor[$obj->id] = $obj->title_th;
          }
        }
    }

    //$objres_con = Research::where('contributor', $id)->get();
    $objcre = Creative::where('researcher_id', $id)->get();
    $objuse = Useful::leftjoin('researchs','usefuls.research_id','=','researchs.id')
    ->leftjoin('areas','areas.id','=','usefuls.area_id')
    ->select('usefuls.id','usefuls.title','usefuls.area_id','areas.name','usefuls.research_id','researchs.title_th')
    ->where('researchs.researcher_id',$id)
    ->get();
    return view('eis.profile',compact('objresch','objexp','objres','objcre','objuse','contributor'));
  }

  public function showProfileexp(Request $request)
  {
    $id = $request['id'];
    $objexptor = Expert::find($id);
    $objexp = Expertlist::where('expert_id', $id)->get();
    $objuse = Useful::leftjoin('experts','usefuls.expert_id','=','experts.id')
    ->leftjoin('areas','areas.id','=','usefuls.area_id')
    ->select('usefuls.area_id','areas.name','usefuls.id','usefuls.title')
    ->where('usefuls.expert_id',$id)
    ->get();
    return view('eis.profileexp',compact('objexptor','objexp','objuse'));
  }

  public function showProfilearea(Request $request)
  {
    $id = $request['id'];
    $objare = Area::find($id);
    $objuse = Useful::leftjoin('areas','usefuls.area_id','=','areas.id')
    ->select('usefuls.id','usefuls.title')
    ->where('usefuls.area_id',$id)
    ->get();
    return view('eis.profilearea',compact('objare','objuse'));
  }

  public function showProfileuseful(Request $request)
  {
    $id = $request['id'];
    $objuse = Useful::find($id);
    return view('eis.profileuseful',compact('objuse'));
  }

  public function showProfilecreative(Request $request)
  {
    $id = $request['id'];
    $objcre = Creative::find($id);
    $objuse = Useful::leftjoin('areas','usefuls.area_id','=','areas.id')
    ->select('usefuls.area_id','areas.name','usefuls.id','usefuls.title')
    ->where('usefuls.creative_id',$id)
    ->get();
    return view('eis.profilecreative',compact('objcre','objuse'));
  }

  public function showProfileresearch(Request $request)
  {
    $id = $request['id'];
    $objres = Research::find($id);
    $objresh = Researcher::get();
    $objexp = Expert::get();
    $objuse = Useful::leftjoin('areas','usefuls.area_id','=','areas.id')
    ->select('usefuls.area_id','areas.name','usefuls.id','usefuls.title')
    ->where('usefuls.research_id',$id)
    ->get();
    return view('eis.profileresearch',compact('objres','objuse','objresh','objexp'));
  }

  public function showProfilepro(Request $request)
  {
    $id = $request['id'];
    $objpro = Problem::find($id);
    return view('eis.profilepro',compact('objpro'));
  }

}
