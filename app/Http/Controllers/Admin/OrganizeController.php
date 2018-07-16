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
          <th data-sortable='false'>ชื่อศูนย์</th>
          <th data-sortable='false'>สังกัด</th>
          <th data-sortable='false'>ที่อยู่</th>
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
          <td>".$key->amphur->name."</td>
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

    public function store(OrganizeRequest $request)
    {
      $post = $request->all();

        $data = array(
            'name' => $post['name'],
            'amphur_id' => $post['amphur_id'],
            'address' => $post['address']
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
      $Organize->name = $post['name'];
      $Organize->amphur_id = $post['amphur_id'];
      $Organize->address = $post['address'];
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
