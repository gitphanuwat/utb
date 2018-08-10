<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

use App\Http\Requests\ChangePasswordRequest;

//use Todstoychev\Icr\Icr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
  public function show()
  {
    return view('member.profile');
  }
  public function edit($id)
  {
    $id = Auth::user()->id;
    $data = User::find($id);
    return view('member.profile',compact('data'));
    //return $data->toArray();
  }
  public function delPicture($id)
  {
    $id = Auth::user()->id;
      if (1) {
          $user = User::find($id);
          $user->deletePicture();
          $user->save();
      }
      return redirect()->back();
  }

  public function savePicture(Request $request)
  {
    $id = Auth::user()->id;
      //$id = $request->input('id');
      $user = User::find($id);
      //$user->changeProfile($request);
          if($fileobj = $request->file('avatar')){
        		$extension = $fileobj->getClientOriginalExtension();
            $filename = $fileobj->getFilename().'.'.$extension;

            $destinationPath = 'images/avatar/large';
            $fileobj->move($destinationPath,$filename);
            //Storage::disk('local')->put($filename,  File::get($fileobj));

            //Storage::put($filename,  File::get($fileobj));

            $user->savePicture($filename);

          }
      $user->save();

      return redirect()->back();
  }

  public function putEdit(Request $request)
  {
    $id = Auth::user()->id;
    //$id = $request->input('id');
      $user = User::find($id);
      $user->changeProfile($request);
      $user->save();
      //flash()->success('Save OK.');
      return redirect()->back();
  }

  public function putChangePassword(ChangePasswordRequest $request)
  {
      if (
              Hash::check(
                      $request->input('old_password'), Auth::user()->password
              )
      ) {
          Auth::user()->password = Hash::make($request->input('new_password'));
          Auth::user()->save();
          flash()->success('รหัสผ่านแก้ไขเรียบร้อย');
          return redirect()->back();
      } else {
          flash()->error('รหัสผ่านเดิมไม่ถูกต้อง');
          return redirect()->back();
      }
  }

}
