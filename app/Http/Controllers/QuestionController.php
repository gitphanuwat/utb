<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\QuestRequest;

use App\Http\Requests;

use App\Question;
use App\Researcher;
use App\University;
use App\Taggroup;


class QuestionController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth');
     }

    public function index()
    {
      $objuniver = University::lists('name','id');
      return view('user.question',compact('objuniver'));
    }

    public function create()
    {
      $data = Question::get();
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
          <td>$key->topic</td>
          <td>".$key->sender."</td>
          <td>".$key->timeup."</td>
          <td>
          <button type='button' data-id='$key->id' class='btn btn-success btn-xs report'>แสดงข้อมูล</button>";
          if(Auth::user()->role->slug == 'Admin'){
            $display .= "<a data-id='$key->id' href='#' class='btn btn-danger btn-xs delete'><i class='fa fa-fw fa-trash-o'></i> ลบข้อมูล</a>";
          }else{
            if(Auth::user()->id == $key->user_id){
              $display .= "<a data-id='$key->id' href='#' class='btn btn-danger btn-xs delete'><i class='fa fa-fw fa-trash-o'></i> ลบข้อมูล</a>";
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
      //return $display;

      $dataarr['cobj'] = $data->count();
      $dataarr['display'] = $display;
      return $dataarr;
    }

    public function store(QuestRequest $request)
    {
      $post = $request->all();
      $users = $request['check_users'];
      $allreceiver = '';
      foreach ($users as $key => $value) {
        $allreceiver .= $value.'|';
      }
      $data = array(
        'topic' => $post['topic'],
        'detail' => $post['detail'],
        'address' => $post['address'],
        'tel' => $post['tel'],
        'email' => $post['email'],
        'sender' => $post['sender'],
        'receiver' => $allreceiver,
        'status' => '1',
        'timeup' => date("Y-m-d H:i:s"),
        'user_id' => $post['user_id']
      );
      $check = Question::insert($data);
      if($check>0){return 0;}else{return 1;}
    }

    public function show($id){
      $data = Question::find($id);
      $muser = explode('|',$data->receiver);
      $display = '
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">ข้อมูลการสื่อสาร</h3>
        </div>
        <div class="box-body no-padding">
          <div class="mailbox-read-info">
            <h3>'.$data->topic.'</h3>
            <h5>From: '.$data->sender.'<br>
            <span class="mailbox-read-time pull-left">'.$data->address.'</span>
            <span class="mailbox-read-time pull-left">'.$data->email.','.$data->tel.'</span>
            <span class="mailbox-read-time pull-right"><i class="fa fa-clock-o"></i>'.$data->timeup.'</span></h5><br>
          </div>

          <div class="mailbox-read-message">
            <p>'.$data->topic.',</p>
            <p>'.$data->detail.'</p>
          </div>
          <div class="mailbox-read-info">
            ผู้รับข้อความ :
            <p>';
            foreach ($muser as $key => $value) {
              $display .= $value.'<br>';
            }
            $display .= '</p>
          </div>
        </div>
      </div>
      ';
      return $display;
    }


    public function getresearcher(Request $request)
    {
      //$data = Researcher::get();
      //echo 'researcher all users';
        $iduni = $request['university_id'];
        if($iduni=='*'){
          $researchers = Researcher::get();
        }else{
          $researchers = Researcher::Where('university_id','=',$iduni)->get();
        }

        $display="
        <table id='example2' class='table table-bordered table-striped'>
        <thead>
        <tr>
          <th data-sortable='false'>
          <input type='checkbox' id='toggle' onClick='do_this()'></th>
          <th data-sortable='false'>นักวิจัย</th>
        </tr>
        </thead>
        <tbody>
        ";
        $cu=0;
        $arr_user = array();
        foreach ($researchers as $key) {
          $cu++;
          $name = $key->headname.$key->firstname.' '.$key->lastname;
          $display .= "
          <tr>
            <td width='30'>
                <input type='checkbox' name='check_users[]' value='".$key->email.','.$name."'>
            </td>
            <td><b>".$name.''.'</b> email: '.$key->email.'<br>'.
            '<b>ความเชี่ยวชาญ : </b>';
            foreach ($key->expertlist as $exp) {
              $display .= "<br> - ".$exp->title_th;
            }
            $display .= "</td>
          </tr>
          ";
        }
        $display .= "
          </tbody>
        </table>
        ";
        if($cu!=0){
          echo $display;
        }else{
          echo ' - ไม่พบข้อมูลผู้วิจัยและผู้เชี่ยวชาญ - ';
        }
    }

    public function update(InforRequest $request, $id)
    {
    }

    public function destroy($id)
    {
      if(Auth::user()->role->slug == 'Admin'){
        $data = Question::find($id);
    		$check = $data->delete();
        $objs = Question::all();
        $data['objs'] = $objs->count();
        $data['check'] = $check;
        return $data;
      }else{
        $data = Question::find($id);
        if(Auth::user()->id == $data->user_id){
          $check = $data->delete();
          $objs = Question::all();
          $data['objs'] = $objs->count();
          $data['check'] = $check;
          return $data;

        }
      }
    }
}
