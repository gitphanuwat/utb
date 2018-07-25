<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Organize;
use App\Amphur;
use App\Http\Requests\OrganizeRequest;

class OrganizeController extends Controller
{
  public function __construct()
  {
      $this->middleware('admin');
  }

    public function index()
    {
      $objunivs = Amphur::lists('name','id');
  		//dd($articles);
  		//return view('articles.index',compact('articles'));
        return view('admin.organize',compact('objunivs'));
    }

    public function create()
    {
      $data = Organize::orderby('amphur_id')->get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th data-sortable='false'>ลำดับ</th>
          <th data-sortable='false'>ชื่อหน่วยงาน</th>
          <th data-sortable='false'>รูปแบบองค์กร</th>
          <th data-sortable='false'>เขตอำเภอ</th>
          <th width='130' data-sortable='false'>ดำเนินการ</th>
        </tr>
        </thead>
        <tbody>
      ";
      $i=0;
      $arrtype=array('','องค์การบริหารส่วนจังหวัด','เทศบาลเมือง','เทศบาลตำบล','องค์การบริหารส่วนตำบล','การปกครองพิเศษ','อื่นๆ');
      foreach ($data as $key) {
        $i++;
        $display .= "
        <tr>
          <td>$i</td>
          <td>$key->name($key->title)</td>
          <td>".$arrtype[$key->type]."</td>
          <td>".$key->amphur->name."</td>
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

    public function store(OrganizeRequest $request)
    {
      $post = $request->all();
        $data = array(
          'amphur_id' => $post['amphur_id'],
          'title' => $post['title'],
          'name' => $post['name'],
          'type' => $post['type'],
            'address' => $post['address'],
            'lat' => $post['lat'],
            'lng' => $post['lng']
        );
        $check = Organize::insert($data);
        if($check>0){return 0;}else{return 1;}
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
      $data = Organize::find($id);
      //return $data;
      header("Content-type: text/x-json");
      echo json_encode($data);
      exit();
    }

    public function update(OrganizeRequest $request, $id)
    {
      $post = $request->all();
      $Organize = Organize::findOrFail($id);
      $Organize->title = $post['title'];
      $Organize->name = $post['name'];
      $Organize->type = $post['type'];
      $Organize->amphur_id = $post['amphur_id'];
      $Organize->address = $post['address'];
      $Organize->lat = $post['lat'];
      $Organize->lng = $post['lng'];
      $check = $Organize->save();
      if($check>0){return 0;}else{return 1;}
    }

    public function destroy($id)
    {
      $data = Organize::find($id);
  		$check = $data->delete();
      if($check>0){return 0;}else{return 1;}
    }
}
