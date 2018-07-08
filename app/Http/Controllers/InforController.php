<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\ResearcherRequest;

use App\Http\Requests;
use App\University;
use App\Center;
use App\Area;
use App\Taggroup;
use App\Infor;
use App\Models\Image;

use App\Http\Requests\InforRequest;

use Illuminate\Support\Facades\Config;

class InforController extends Controller
{
     public function __construct()
     {
        // $this->middleware('auth');
     }

    public function index()
    {
        return view('user.infor');
    }

    public function create()
    {
      $data = Infor::get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th width='30'>ลำดับ</th>
          <th>ชื่อเรื่อง</th>
          <th>ผู้ส่ง</th>
          <th>วันที่</th>
          <th data-sortable='false'>ดำเนินการ</th>
        </tr>
        </thead>
        <tbody>
      ";
      $i=1;
      foreach ($data as $key) {
        $display .= "
        <tr>
          <td>".$i++."</td>
          <td>$key->title</td>
          <td>".$key->user->firstname."</td>
          <td>".$key->created_at."</td>
          <td>
          <button type='button' data-id='$key->id' class='btn btn-success btn-xs report'>แสดงข้อมูล</button>";
          if(Auth::user()->role->slug == 'Admin'){
            $display .= "<a data-id='$key->id' href='infor/".$key->id."/edit' class='btn btn-warning btn-xs'>แก้ไข</a>
            <a data-id='$key->id' href='#' class='btn btn-danger btn-xs delete'><i class='fa fa-fw fa-trash-o'></i> DELETE</a>";
          }else{
            if(Auth::user()->id == $key->user_id){
              $display .= "<a data-id='$key->id' href='infor/".$key->id."/edit' class='btn btn-warning btn-xs'>แก้ไข</a>
              <a data-id='$key->id' href='#' class='btn btn-danger btn-xs delete'><i class='fa fa-fw fa-trash-o'></i> DELETE</a>";
            }
          }
          $display .= "</td>
        </tr>
        ";
      }
      $display .= "
        </tbody>
      </table>
      ";
      return $display;
    }

    public function store(InforRequest $request)
    {
      $obj = new Infor();
      $obj->user_id = $request['user_id'];
      $obj->title = $request['title'];
      $obj->detail = $request['detail'];
      $obj->file_id = $request['file_id'];
      $check = $obj->save();
      return view('user.infor');
    }
    public function show($id){
      $data = Infor::find($id);
      $idfile = $data->file_id;
      $files = Image::where('file_id', $idfile)->get();
      return view('user.inforshow',compact('data','files'));
    }
    public function inforshow($id){
      $data = Infor::find($id);
      $idfile = $data->file_id;
      $files = Image::where('file_id', $idfile)->get();

      $display = '

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">ข้อมูลข่าวสาร&กิจกรรม</h3>
        </div>
        <div class="box-body no-padding">
          <div class="mailbox-read-info">
            <h3>'.$data->title.'</h3>
            <h5>From: '.$data->user->firstname.'
              <span class="mailbox-read-time pull-right"><i class="fa fa-clock-o"></i>'.$data->updated_at.'</span></h5>
          </div>
          <div class="mailbox-read-message">
            <p>'.$data->title.',</p>
            <p>'.$data->detail.'</p>
          </div>
        </div>
        <div class="box-footer">
          <ul class="mailbox-attachments clearfix">';

            $full_size_dir = Config::get('images.full_size');

            foreach ($files as $file) {
              $fullfile = $full_size_dir.$file->filename;
              $size = @filesize($fullfile);
              if(@is_array(getimagesize($fullfile))){
                $display .= "
                 <li>
                    <span class='mailbox-attachment-icon' >
                      <a href='".url('/files').'/'.$file->filename."' class='mailbox-attachment-name' data-toggle='lightbox' data-gallery='example-gallery'>
                        <img src='".url('/files').'/'.$file->filename."' alt='Attachment' height='100'>
                      </a>
                    </span>
                    <div class='mailbox-attachment-info'>
                      <i class='fa fa-camera'></i>".substr($file->original_name,0,15).'...'."
                      <span class='mailbox-attachment-size'>
                        ".round(($size/1000), 2)." kB
                      </span>
                    </div>
                </li>";

              } else {
                $display .= "
                <li>
                    <span class='mailbox-attachment-icon'><i class='fa fa-file-text-o' style='font-size:96px'></i></span>
                    <div class='mailbox-attachment-info'>
                      <a href='".url('/files').'/'.$file->filename."' class='mailbox-attachment-name'><i class='fa fa-paperclip'></i> ".$file->original_name."</a>
                        <span class='mailbox-attachment-size'>
                        ".round(($size/1000), 2)." kB
                          <a href='".url('/files').'/'.$file->filename."' class='btn btn-default btn-xs pull-right'><i class='fa fa-cloud-download'></i></a>
                        </span>
                    </div>
                </li>";
              }
            }

            $display .= '
          </ul>
        </div>
        <div class="box-footer">
          <div class="pull-right">
            <button type="button" class="btn btn-default btnprint"><i class="fa fa-print"></i> Print</button>
          </div>
        </div>
      </div>

      ';
      return $display;
    }

    public function edit($id)
    {
      if(Auth::user()->role->slug == 'Admin'){
        $data = Infor::find($id);
        return view('user.inforedit',compact('data'));
      }else{
        $data = Infor::find($id);
        if(Auth::user()->id == $data->user_id){
          return view('user.inforedit',compact('data'));
        }
        abort(403);
      }
    }

    public function update(InforRequest $request, $id)
    {
      $obj = Infor::findOrFail($id);
      $obj->title = $request['title'];
      $obj->detail = $request['detail'];
      $check = $obj->save();
      if($check>0){return redirect('user/infor');}else{return 1;}
    }

    public function destroy($id)
    {
      if(Auth::user()->role->slug == 'Admin'){
        $data = Infor::find($id);
        $check = $data->delete();
        $objs = Infor::all();
        $data['objs'] = $objs->count();
        $data['check'] = $check;
        return $data;
      }else{
        $data = Infor::find($id);
        if(Auth::user()->id == $data->user_id){
      		$check = $data->delete();
          $objs = Infor::all();
          $data['objs'] = $objs->count();
          $data['check'] = $check;
          return $data;
        }else{abort(403);}
      }
    }
}
