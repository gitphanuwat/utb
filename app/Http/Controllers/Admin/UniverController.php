<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\University;
use App\Http\Requests\UniverRequest;

class UniverController extends Controller
{
  public function __construct()
  {
      $this->middleware('admin');
  }

    public function index()
    {
        //
        return view('admin.university');
    }

    public function create()
    {
      $data = University::get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th data-sortable='false'>ลำดับ</th>
          <th data-sortable='false'>ชื่อมหาวิทยาลัย</th>
          <th data-sortable='false'>รายละเอียด</th>
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
          <td>$key->name ($key->shortname)</td>
          <td>$key->detail</td>
          <td><a data-id='$key->id' href='#j' class='btn btn-primary btn-xs edit'> แก้ไข </a> <a data-id='$key->id' href='#' class='btn btn-danger btn-xs delete'> ลบข้อมูล </a></td>
        </tr>
        ";
      }
      $display .= "
        </tbody>
      </table>
      ";
      return $display;
    }

    public function store(UniverRequest $request)
    {
      $post = $request->all();

        $data = array(
          'name' => $post['name'],
          'shortname' => $post['shortname'],
            'detail' => $post['detail']
        );
        $check = University::insert($data);
        if($check>0){return 0;}else{return 1;}
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
      $data = University::find($id);
      //return $data;
      header("Content-type: text/x-json");
      echo json_encode($data);
      exit();
    }

    public function update(UniverRequest $request, $id)
    {
      $post = $request->all();
      $university = University::findOrFail($id);
      $university->name = $post['name'];
      $university->shortname = $post['shortname'];
      $university->detail = $post['detail'];
      $check = $university->save();
      if($check>0){return 0;}else{return 1;}
    }

    public function destroy($id)
    {
      $data = University::find($id);
  		$check = $data->delete();
      if($check>0){return 0;}else{return 1;}
    }
}
