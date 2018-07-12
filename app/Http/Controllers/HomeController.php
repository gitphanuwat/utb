<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\University;

use App\Researcher;
use App\Expert;
use App\Research;
use App\Creative;
use App\Area;
use App\Infor;
use App\Counter;
use App\Log;

use App\Center;

use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //$this->middleware('auth');
      //$this->middleware('logger');
    }
    public function index()
    {
      $locations = DB::table('locations')->get();
      $objinfor = Infor::limit(2)->orderBy('id', 'desc')->get();
      $objcenter = Center::limit(2)->get();
      //return view('home',compact('objinfor','objcenter'));
      return view('home',compact('objinfor','locations'));
    }

    public function maps()
    {
      $objarea = Area::get();
      $objunivs = University::lists('name','id');
      return view('eis/maps',compact('objarea','objunivs'));
    }
    public function stat()
    {
      $objcou = Counter::get();
      //$objunivs = University::lists('name','id');
      return view('stat',compact('$objcou'));
    }
    public function loadstat1(Request $request){
      echo "test";
    }
    public function loadstat(Request $request){
      $startdate = $request['startdate'];
      $enddate = $request['enddate'];

      //$objcounter = Counter::where('day','like','%2016%')->get();
      //$nowdate = date("Y-m-d");
      //$date=date("Y-m-d",strtotime("-30 days",strtotime($nowdate)));
      //$date=date("Y-m-d",strtotime("oct 2017"));
      //$end_date = date("Y-m-d");
      //$end_date = date("Y-m-d",strtotime("+1 month",strtotime($date)));
      $date=date("Y-m-d",strtotime("$startdate"));
      $end_date = date("Y-m-d",strtotime("$enddate"));

          $data = "<script>";
          $data .= "var line = new Morris.Line({";
          $data .= "element: 'line-chart',";
          $data .= "resize: true,";
          $data .= "data: [";
          //foreach ($objcounter as $obj) {
            //$data .= "{y: '$obj->day', item1: ".$obj->total."},";
          //}
          while (strtotime($date) <= strtotime($end_date)) {
            $objc = Counter::where('day','=',$date)->first();
            if($objc){
              $counts = $objc->total;
            }else{
              $counts=0;
            }
            $data .= "{y: '$date', item1: ".$counts."},";
            $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
          }
          $data .= "],";
          $data .= "xkey: 'y',";
          $data .= "ykeys: ['item1'],";
          $data .= "labels: ['Stat'],";
          $data .= "lineColors: ['#3c8dbc'],";
          $data .= "hideHover: 'auto',";
        $data .= "});";
      //$data .= "counterread()";
      $data .= "</script>";
      echo $data;
    }
    public function counterhit()
    {
      $today = date("Y-m-d");
      $objcounter = Counter::where('day','=',$today)->first();
      if ($objcounter){
        $counttotal = $objcounter->total+1;

        global $COUNTER_USE_COOKIES;
        $cookie_name = 'HIT_COUNTER_' . $today;
       	if(!isset($_COOKIE[$cookie_name])) {

          $cookie_name = 'HIT_COUNTER_' . $today;
          setcookie($cookie_name, 'TRUE', time() + 360);

          $objcounter->day = $today;
          $objcounter->total = $counttotal;
          $objcounter->save();
        }
      }else{
          $counttotal = 1;
          $objcounter = new Counter();
          $objcounter->day = $today;
          $objcounter->total = $counttotal;
          $objcounter->save();
      }
      return $today.' '.$counttotal;
    }

    public function gmaps()
    {
      $locations = DB::table('locations')->get();
      return view('gmaps',compact('locations'));
    }
    public function gmaps1()
    {
      $locations = DB::table('locations')->get();
      return view('gmaps1',compact('locations'));
    }
    public function gmaps2()
    {
      $locations = DB::table('locations')->get();
      return view('gmaps2',compact('locations'));
    }
    public function gmaps5()
    {
      $locations = DB::table('locations')->get();
      return view('gmaps5',compact('locations'));
    }
}
