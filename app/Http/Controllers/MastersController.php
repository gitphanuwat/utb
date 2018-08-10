<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MastersController extends Controller
{

  public function catadd(Request $request){
    if ($request->hasFile('logo')) {
        //
         $file = $request->file('logo');
        return $file->getFilename();
        //return $request->all();
        //return $request->input('name');

    }
    /*
      if (Input::hasFile('logo'))
      {
         return "file present";
      }
      else{
          return "file not present";
      }
      */
      return 'NOT file';
      //echo dd(Input::all());
  }

}
