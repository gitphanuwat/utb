<?php
namespace App\Http\Controllers\Univer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Center;
use App\University;
use App\Http\Requests\CenterRequest;

class CenterController extends Controller
{
    public function __construct()
    {
        $this->middleware('university');
    }
    public function index()
    {
      $objunivs = University::lists('name','id');
      return view('univer.center',compact('objunivs'));
    }

    public function create()
    {
      $idu = Auth::user()->university_id;
      $data = Center::where('university_id',$idu)->orderby('name')->get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
        <th>ลำดับ</th>
        <th>ชื่อศูนย์</th>
        <th>สังกัด</th>
        <th>ที่อยู่</th>
        <th width='80' data-sortable='false'>ดำเนินการ</th>
        </tr>
        </thead>
        <tbody>
      ";
      $i=0;
      foreach ($data as $key) {
        $i++;
        $display .= "
        <tr>
          <td>$i</td>
          <td>$key->name</td>
          <td>".$key->university->name."</td>
          <td>$key->address</td>
          <td><a data-id='$key->id' href='#j' class='btn btn-primary btn-xs edit'>แก้ไข</a> <a data-id='$key->id' href='#' class='btn btn-danger btn-xs delete'>ลบข้อมูล</a></td>
        </tr>
        ";
      }
      $display .= "
        </tbody>
      </table>
      ";
      return $display;
    }

    public function store(CenterRequest $request)
    {
      $post = $request->all();

        $data = array(
            'name' => $post['name'],
            'university_id' => Auth::user()->university_id,
            'address' => $post['address']
        );
        $check = Center::insert($data);
        if($check>0){return 0;}else{return 1;}
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

      $data = Center::find($id);
      if($data->university_id == Auth::user()->university_id){
        header("Content-type: text/x-json");
        echo json_encode($data);
        exit();
      }
      abort(0);
    }

    public function update(CenterRequest $request, $id)
    {
      $post = $request->all();
      $Center = Center::findOrFail($id);
      $Center->name = $post['name'];
      $Center->address = $post['address'];
      $check = $Center->save();
      if($check>0){return 0;}else{return 1;}
    }

    public function destroy($id)
    {

      $data = Center::find($id);
      if($data->university_id == Auth::user()->university_id){
    		$check = $data->delete();
        if($check>0){return 0;}else{return 1;}
      }
      abort(0);
    }
}
