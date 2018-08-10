<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use App\Useful;
use App\Taggroup;

class DssController extends Controller
{
  public function getTopic(Request $request)
  {
    $search = $request->input('search');
    $results = User::where('firstname','LIKE',"%$search%")->get();
    $data = [
        'results' => $results,
        'search' => $search,
        'uri' => 'admin/users',
        'all' => User::count(),
        'delete_message' => 'users.delete_message',
    ];
    return view('dss/topic', $data);
  }


  public function postTopic(Request $request)
  {
      return $this->getTopic($request);
  }

  public function getUseful()
  {

    $objuseful = Useful::get();
    //$objuseful->toArray();
    return view('dss/useful',compact('objuseful'));
  }

  public function getSystem()
  {
    $objtaggroup = Taggroup::get();
    //$objuseful->toArray();
    return view('dss/system',compact('objtaggroup'));
  }

}
