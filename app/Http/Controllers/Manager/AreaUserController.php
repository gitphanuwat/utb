<?php
namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\University;
use App\Center;
use App\Area;
use App\Taggroup;
use App\Problem;
use App\Areafile;

use App\Http\Requests\AreaRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class AreaUserController extends Controller
{
     public function __construct()
     {
        $this->middleware('manager');
     }

    public function index()
    {
          $objtag = Taggroup::lists('groupname','id');
          return view('manager.areauser',compact('objtag'));
    }

    public function create()
    {

        $id = Auth::user()->center_id;
        $data = Area::where('center_id',$id)->orderby('name')->get();
      $display="
      <table id='example1' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th>ลำดับ</th>
          <th>พื้นที่</th>
          <th>ศูนย์จัดการเครือข่าย</th>
          <th data-sortable='false'>มหาวิทยาลัย</th>
          <th data-sortable='false'>ปัญหาชุมชน</th>
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
          <td>$key->name</td>
          <td>".$key->Center->name."</td>
          <td>".$key->center->university->name."</td>
          <td><a data-id='$key->id' href='#' class='btn btn-warning btn-xs upprobm'>ปัญหา <span class='badge'>".$key->problem->count()."</span></a></td>
          <td><a data-id='$key->id' href='#j' class='btn btn-primary btn-xs edit'>บันทึกรายละเอียด</a>
              <a data-id='$key->id' href='#d' class='btn btn-success btn-xs report'>แสดงข้อมูล</a></td>
        </tr>
        ";
      }
      $display .= "
        </tbody>
      </table>
      ";
      return $display;
    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        $obj = Area::find($id);
        $objpro = Problem::where('area_id',$id)->get();
        if(Auth::user()->center_id == $obj->center_id){
          $display = "<h4>ชื่อชุมชน : ".$obj->name."</h4>";
          $display .= "<h4>ศูนย์จัดการเครือข่าย : ".$obj->center->university->name."</h4>";
          $display .= "<h4>สังกัด : ".$obj->center->university->name."</h4>";
          $display .= "
          <table  class='table table-bordered'>
            <tr>
              <td style='width:150px'>บริบทชุมชน</td>
              <td>".$obj->context."<br>";
                foreach ($obj->areafile as $key) {
                  if($key->filetype==1){
                    $display .= "<i class='fa fa-paperclip'></i>";
                    $display .= "<a href='".route('getfileload', $key->fullname)."' target='blank'>".$key->filename."</a>";
                    $display .= "<br>";
                  }
                }
              $display .= "</td>
            </tr>
            <tr>
              <td>จำนวนประชาการ</td>
              <td>".$obj->people."<br>";
                foreach ($obj->areafile as $key) {
                  if($key->filetype==2){
                    $display .= "<i class='fa fa-paperclip'></i>";
                    $display .= "<a href='".route('getfileload', $key->fullname)."' target='blank'>".$key->filename."</a>";
                    $display .= "<br>";
                  }
                }
              $display .= "</td>
            </tr>
            <tr>
              <td>ข้อมูลสุขภาพ</td>
              <td>".$obj->health."<br>";
                foreach ($obj->areafile as $key) {
                  if($key->filetype==3){
                    $display .= "<i class='fa fa-paperclip'></i>";
                    $display .= "<a href='".route('getfileload', $key->fullname)."' target='blank'>".$key->filename."</a>";
                    $display .= "<br>";
                  }
                }
              $display .= "</td>
            </tr>
            <tr>
              <td>สิ่งแวดล้อม</td>
              <td>".$obj->environment."<br>";
                foreach ($obj->areafile as $key) {
                  if($key->filetype==4){
                    $display .= "<i class='fa fa-paperclip'></i>";
                    $display .= "<a href='".route('getfileload', $key->fullname)."' target='blank'>".$key->filename."</a>";
                    $display .= "<br>";
                  }
                }
              $display .= "</td>
            </tr>
            <tr>
              <td>ผู้ประสานงาน</td>
              <td>".$obj->keyman."</td>
            </tr>
            <tr>
              <td>เบอร์โทรศัพท์</td>
              <td>".$obj->tel."</td>
            </tr>
            <tr>
              <td>ปัญหาในชุมชน</td>
              <td>";
              foreach ($objpro as $key) {
                $display .= "- ".$key->title."<br>";
              }
              $display .= "</td>
            </tr>
          </table>
          ";
          return $display;
        }
        abort(0);
    }

    public function edit($id)
    {
      $data = Area::find($id);
      if(Auth::user()->center_id == $data->center_id){
        $data['university_name'] = $data->center->university->name;
        $data['center_name'] = $data->center->name;

        $file1='';
        foreach ($data->areafile as $key) {
          if($key->filetype==1){
            $file1 .= "
            <div class='btn btn-default btn-xs loadfile'>
              <a href='".route('getfileload', $key->fullname)."' target='blank'>".$key->filename."</a>
              <div class='pull-right hidden-xs'>
                <a data-id='$key->id' href='#j' class='delfile'>
                  <i class='fa fa-times'></i>
                </a>
              </div>
            </div>
            ";
          }
        }
        $data['areafile1'] = $file1;

        $file2='';
        foreach ($data->areafile as $key) {
          if($key->filetype==2){
            $file2 .= "
            <div class='btn btn-default btn-xs loadfile'>
              <a href='".route('getfileload', $key->fullname)."' target='blank'>".$key->filename."</a>
              <div class='pull-right hidden-xs'>
                <a data-id='$key->id' href='#j' class='delfile'>
                  <i class='fa fa-times'></i>
                </a>
              </div>
            </div>
            ";            }
        }
        $data['areafile2'] = $file2;

        $file3='';
        foreach ($data->areafile as $key) {
          if($key->filetype==3){
            $file3 .= "
            <div class='btn btn-default btn-xs loadfile'>
              <a href='".route('getfileload', $key->fullname)."' target='blank'>".$key->filename."</a>
              <div class='pull-right hidden-xs'>
                <a data-id='$key->id' href='#j' class='delfile'>
                  <i class='fa fa-times'></i>
                </a>
              </div>
            </div>
            ";            }
        }
        $data['areafile3'] = $file3;

        $file4='';
        foreach ($data->areafile as $key) {
          if($key->filetype==4){
            $file4 .= "
            <div class='btn btn-default btn-xs loadfile'>
              <a href='".route('getfileload', $key->fullname)."' target='blank'>".$key->filename."</a>
              <div class='pull-right hidden-xs'>
                <a data-id='$key->id' href='#j' class='delfile'>
                  <i class='fa fa-times'></i>
                </a>
              </div>
            </div>
            ";            }
        }
        $data['areafile4'] = $file4;

        header("Content-type: text/x-json");
        echo json_encode($data);
        exit();
      }
      abort(0);
    }

    public function update(Request $request, $id)
    {
        $areobj = Area::find($id);
        if(Auth::user()->center_id == $areobj->center_id){
          $obj = Area::findOrFail($id);
          $obj->context = $request['context'];
          $obj->people = $request['people'];
          $obj->health = $request['health'];
          $obj->environment = $request['environment'];
          $obj->keyman = $request['keyman'];
          $obj->tel = $request['tel'];
          $check = $obj->save();
          if($check>0){return 0;}else{return 1;}
        }
        abort(0);
    }

    public function destroy1($id)
    {
      return $id;
    }
    public function destroy($id)
    {
        $areafile = Areafile::find($id);
        $data = Area::find($areafile->area_id);
            if(Auth::user()->center_id == $data->center_id){
              $data = Area::find($areafile->area_id);
              @Storage::delete($areafile->fullname);
              $check = $areafile->delete();
              $data['university_name'] = $data->center->university->name;
              $data['center_name'] = $data->center->name;

              $file1='';
              foreach ($data->areafile as $key) {
                if($key->filetype==1){
                  $file1 .= "
                  <div class='btn btn-default btn-xs loadfile'>
                    <a href='".route('getfileload', $key->fullname)."' target='blank'>".$key->filename."</a>
                    <div class='pull-right hidden-xs'>
                      <a data-id='$key->id' href='#j' class='delfile'>
                        <i class='fa fa-times'></i>
                      </a>
                    </div>
                  </div>
                  ";
                }
              }
              $data['areafile1'] = $file1;

              $file2='';
              foreach ($data->areafile as $key) {
                if($key->filetype==2){
                  $file2 .= "
                  <div class='btn btn-default btn-xs loadfile'>
                    <a href='".route('getfileload', $key->fullname)."' target='blank'>".$key->filename."</a>
                    <div class='pull-right hidden-xs'>
                      <a data-id='$key->id' href='#j' class='delfile'>
                        <i class='fa fa-times'></i>
                      </a>
                    </div>
                  </div>
                  ";
                }
              }
              $data['areafile2'] = $file2;

              $file3='';
              foreach ($data->areafile as $key) {
                if($key->filetype==3){
                  $file3 .= "
                  <div class='btn btn-default btn-xs loadfile'>
                    <a href='".route('getfileload', $key->fullname)."' target='blank'>".$key->filename."</a>
                    <div class='pull-right hidden-xs'>
                      <a data-id='$key->id' href='#j' class='delfile'>
                        <i class='fa fa-times'></i>
                      </a>
                    </div>
                  </div>
                  ";
                }
              }
              $data['areafile3'] = $file3;

              $file4='';
              foreach ($data->areafile as $key) {
                if($key->filetype==4){
                  $file4 .= "
                  <div class='btn btn-default btn-xs loadfile'>
                    <a href='".route('getfileload', $key->fullname)."' target='blank'>".$key->filename."</a>
                    <div class='pull-right hidden-xs'>
                      <a data-id='$key->id' href='#j' class='delfile'>
                        <i class='fa fa-times'></i>
                      </a>
                    </div>
                  </div>
                  ";
                }
              }
              $data['areafile4'] = $file4;

              header("Content-type: text/x-json");
              echo json_encode($data);
              exit();
            }
    }

    public function uploadFile(Request $request)
    {

      //for University
        $id = $request->input('areaf_id');
        $areobj = Area::find($id);
        if(Auth::user()->center_id == $areobj->center_id){

          $ida = $request->input('areaf_id');
          $data = Area::find($ida);

          $fileobj = $request->file('filefield');
      		$extension = $fileobj->getClientOriginalExtension();
          $filename = $fileobj->getFilename().time().'.'.$extension;
          $destinationPath = 'uploads';
          Storage::put($filename,  File::get($fileobj));
          $entry = new Areafile();
          $entry->area_id = $request->input('areaf_id');
          $entry->filetype = $request->input('filetype');
          if($request->input('filename')==''){
            $entry->filename = $fileobj->getFilename();
          }else{
            $entry->filename = $request->input('filename');
          }
          //$entry->fullname = $request->input('filename');
          $entry->fullname = $filename;

          $data['check'] = $entry->save();

          $file1='';
          foreach ($data->areafile as $key) {
            if($key->filetype==1){
              $file1 .= "
              <div class='btn btn-default btn-xs loadfile'>
                <a href='".route('getfileload', $key->fullname)."' target='blank'>".$key->filename."</a>
                <div class='pull-right hidden-xs'>
                  <a data-id='$key->id' href='#j' class='delfile'>
                    <i class='fa fa-times'></i>
                  </a>
                </div>
              </div>
              ";
            }
          }
          $data['areafile1'] = $file1;

          $file2='';
          foreach ($data->areafile as $key) {
            if($key->filetype==2){
              $file2 .= "
              <div class='btn btn-default btn-xs loadfile'>
                <a href='".route('getfileload', $key->fullname)."' target='blank'>".$key->filename."</a>
                <div class='pull-right hidden-xs'>
                  <a data-id='$key->id' href='#j' class='delfile'>
                    <i class='fa fa-times'></i>
                  </a>
                </div>
              </div>
              ";
            }
          }
          $data['areafile2'] = $file2;

          $file3='';
          foreach ($data->areafile as $key) {
            if($key->filetype==3){
              $file3 .= "
              <div class='btn btn-default btn-xs loadfile'>
                <a href='".route('getfileload', $key->fullname)."' target='blank'>".$key->filename."</a>
                <div class='pull-right hidden-xs'>
                  <a data-id='$key->id' href='#j' class='delfile'>
                    <i class='fa fa-times'></i>
                  </a>
                </div>
              </div>
              ";
            }
          }
          $data['areafile3'] = $file3;

          $file4='';
          foreach ($data->areafile as $key) {
            if($key->filetype==4){
              $file4 .= "
              <div class='btn btn-default btn-xs loadfile'>
                <a href='".route('getfileload', $key->fullname)."' target='blank'>".$key->filename."</a>
                <div class='pull-right hidden-xs'>
                  <a data-id='$key->id' href='#j' class='delfile'>
                    <i class='fa fa-times'></i>
                  </a>
                </div>
              </div>
              ";
            }
          }
          $data['areafile4'] = $file4;
            header("Content-type: text/x-json");
            echo json_encode($data);
            exit();
      }
    }



}
