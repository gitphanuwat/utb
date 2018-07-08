<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;


use App\Useful;

use App\Expert;
use App\Research;
use App\Creative;
use App\Area;
use App\Problem;

use App\Areafile;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $objexp = Expert::get();
      $objres = Research::lists('title_th','id');
      $objcre = Creative::lists('title','id');
      $objare = Area::get();
      $objpro = Problem::lists('title','id');
      $objson = json_encode($objres);
      return view('test',compact('objson'));
      //dd($objres->toArray());
      //dd($objres->toJson());
      //header ('Content-type: text/html; charset=utf-8');
      //header("Content-type: application/json");
      //dd(json_encode($objres));
      //dd(iconv("tis-620","utf-8",$objon));
      //dd(json_encode($objres));
      //return view('test');
    }
    public function sendmail(Request $request)
    {
      $data='';
      $dat=$request['check_users'];
      //foreach ($dat as $key) {
        //$data .= $dat[1];
      //}
      foreach ($dat as $key => $value) {
        $data .=  $value;
      }
      return $data;
    }

    public function areafile()
    {

      $dat = Area::find(37);
      $data = '';
      foreach ($dat->areafile as $key) {
        $data .= $key->filename;
      }

      return $data;
    }


}
