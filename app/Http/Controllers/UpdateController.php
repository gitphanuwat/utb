<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Update;
use App\Http\Requests\UpdateRequest;

use Auth;

class UpdateController extends Controller
{
  public function __construct()
  {
      //$this->middleware('auth');
      //$this->middleware('logger');
  }

    public function index()
    {
      return view('about.update');
    }

    public function updatelast()
    {
      $data = Update::orderBy('id','desc')->get();
      $display = '
      <div class="box-footer box-comments">
      <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr><th>การอัพเดทระบบล่าสุด</th><th width="100"></th></tr>
      </thead>
      <tbody>';
      foreach ($data as $key) {
        $display .= '
        <tr><td>
          <div class="box-comment">
            <img class="img-circle img-sm" src="'.url("images/avatar/large/").'/'.$key->user->picture.'">
            <div class="comment-text">
                  <span class="username">'.
                  $key->user->headname.$key->user->firstname.' '.$key->user->lastname;
                  $display .= $key->detail
            .'</div>
          </div>
          </td>
          <td>
            ';
            if(Auth::user()){
            $display .= '<span class="text-muted pull-right">
                <a href="#" data-id="'.$key->id.'" class="delete"> [ลบ] </a>
              </span>
              ';
            }
            $display .='
            <span class="text-muted pull-right">'.$key->timeup.'</span>
          </td>
          </tr>';
      }
      $display .= '</tbody>
      </table>
      </div>';

      return $display;
    }

    public function store(UpdateRequest $request)
    {
      $post = $request->all();
        $data = array(
            'detail' => $post['detail'],
            'timeup' => date('Y-m-d H:i:s'),
            'user_id' => Auth::user()->id
        );
        $check = Update::insert($data);
        if($check>0){return 0;}else{return 1;}
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
    }

    public function update(GroupRequest $request, $id)
    {
    }

    public function destroy($id)
    {
      $data = Update::find($id);
  		$check = $data->delete();
      if($check>0){return 0;}else{return 1;}
    }
}
