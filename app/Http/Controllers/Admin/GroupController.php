<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Taggroup;
use App\Tagdetail;
use App\Http\Requests\GroupRequest;

class GroupController extends Controller
{
  public function __construct()
  {
      $this->middleware('admin');
      //$this->middleware('logger');
  }

    public function index()
    {
        //
        return view('admin.group');
    }

    public function create()
    {
      $data = Taggroup::orderby('groupname')->get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th data-sortable='false'>ลำดับ</th>
          <th data-sortable='false'>ชื่อกลุ่ม</th>
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
          <td>$key->groupname</td>
          <td>$key->detail</td>
          <td><a data-id='$key->id' href='#j' class='btn btn-primary btn-xs edit' > แก้ไข </a> <a data-id='$key->id' href='#' class='btn btn-danger btn-xs delete'> ลบข้อมูล </a></td>
        </tr>
        ";
      }
      $display .= "
        </tbody>
      </table>
      ";
      return $display;
    }

    public function store(GroupRequest $request)
    {
      $post = $request->all();

        $data = array(
            'groupname' => $post['groupname'],
            'detail' => $post['detail']
        );
        $check = Taggroup::insert($data);
        if($check>0){return 0;}else{return 1;}
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
      $data = Taggroup::find($id);
      return $data->toArray();
    }

    public function update(GroupRequest $request, $id)
    {
      $post = $request->all();
      $university = Taggroup::findOrFail($id);
      $university->groupname = $post['groupname'];
      $university->detail = $post['detail'];
      $check = $university->save();
      if($check>0){return 0;}else{return 1;}
    }

    public function destroy($id)
    {
      $data = Taggroup::find($id);
  		$check = $data->delete();
      if($check>0){return 0;}else{return 1;}
    }
}
