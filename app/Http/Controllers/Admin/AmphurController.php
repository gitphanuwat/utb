<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Amphur;
use App\Http\Requests\AmphurRequest;

class AmphurController extends Controller
{
  public function __construct()
  {
      $this->middleware('admin');
  }

    public function index()
    {
        //
        return view('admin.amphur');
    }

    public function create()
    {
      $data = Amphur::get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th data-sortable='false'>ลำดับ</th>
          <th data-sortable='false'>ชื่ออำเภอ</th>
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

    public function store(AmphurRequest $request)
    {
      $post = $request->all();

        $data = array(
          'name' => $post['name'],
          'shortname' => $post['shortname'],
            'detail' => $post['detail']
        );
        $check = Amphur::insert($data);
        if($check>0){return 0;}else{return 1;}
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
      $data = Amphur::find($id);
      //return $data;
      header("Content-type: text/x-json");
      echo json_encode($data);
      exit();
    }

    public function update(AmphurRequest $request, $id)
    {
      $post = $request->all();
      $amphur = Amphur::findOrFail($id);
      $amphur->name = $post['name'];
      $amphur->shortname = $post['shortname'];
      $amphur->detail = $post['detail'];
      $check = $amphur->save();
      if($check>0){return 0;}else{return 1;}
    }

    public function destroy($id)
    {
      $data = Amphur::find($id);
  		$check = $data->delete();
      if($check>0){return 0;}else{return 1;}
    }
}
